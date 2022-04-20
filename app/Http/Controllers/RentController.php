<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Property;
use App\Models\RentProperty;
use App\Models\RentPropertyIteration;
use App\Models\SoldProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function rentedList()
    {
        $returnArr['rentProperties'] = Property::where(function ($query) {
            if (isset($_GET['society']) && $_GET['society'] != '') {
                $query->where('society', trim($_GET['society']));
            }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['plot_number']) && $_GET['plot_number'] != '') {
                    $query->where('plot_no', trim($_GET['plot_number']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['block']) && $_GET['block'] != '') {
                    $query->where('block', trim($_GET['block']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['phase']) && $_GET['phase'] != '') {
                    $query->where('phase', trim($_GET['phase']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['plot_type']) && $_GET['plot_type'] != '') {
                    $query->where('plot_type', trim($_GET['plot_type']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['property_type']) && $_GET['property_type'] != '') {
                    $query->where('property_type', trim($_GET['property_type']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['area']) && $_GET['area'] != '') {
                    $query->where('area', trim($_GET['area']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['area_size']) && $_GET['area_size'] != '') {
                    $query->where('area_size', trim($_GET['area_size']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['rate']) && $_GET['rate'] != '') {
                    $query->where('rate', trim($_GET['rate']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['property_for']) && $_GET['property_for'] != '') {
                    $query->where('property_for', trim($_GET['property_for']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['owner_name']) && $_GET['owner_name'] != '') {
                    $query->where('owner_name', trim($_GET['owner_name']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['owner_number']) && $_GET['owner_number'] != '') {
                    $query->where('owner_number', trim($_GET['owner_number']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['id_card']) && $_GET['id_card'] != '') {
                    $query->where('id_card', trim($_GET['id_card']));
                }
            })
            ->where('status', 'rent')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $returnArr['rentPropertiesCounter'] = RentProperty::count();

        return view('admin.property.rented.list', $returnArr);
    }

    public function propertyDetail($id)
    {
        $property = Property::find($id);
        $banks = Bank::get();
        if ($property) {
            return view('admin.property.rented.detail', compact('property'));
        }
        return redirect()->back()->with('error', 'property not found.');
    }

    public function moveToActive($id) {
        $property = Property::find($id);
        if ($property) {
            RentProperty::where('property_id', $property->id)->delete();
            $property->status = 'active';
            $property->save();
            return redirect()->route('admin.property.list')->with('success','Product move from rent to active successfully.');
        }
        return redirect()->back()->with('error', 'property not found.');
    }

    public function rentIteration($id) {
        $rentProperty = RentProperty::findOrFail($id);
        $banks = BankAccount::where('status', 'active')->get();
        return view('admin.property.rented.iteration', compact('banks', 'rentProperty'));
    }

    public function postRentIteration(Request $request, $id) {
        $rentProperty = RentProperty::findOrFail($id);
        $request->validate([
            'receiving_date'=>'required',
            'rent_amount'=>'required',
            'description'=>'required',
        ]);

        $iteration = new RentPropertyIteration();
        $iteration->rent_property_id = $rentProperty->id;
        $iteration->bank_id = $request['bank'];
        $iteration->date = $request['receiving_date'];
        $iteration->amount = $request['rent_amount'];
        $iteration->description = $request['description'];
        $iteration->save();

        if ($request['bank']) {
            $bankAcc = BankAccount::findOrFail($request['bank']);
            if ($bankAcc) {
                $amount = $bankAcc->amount + $request['rent_amount'];
                $newRec = new BankAccount();
                $newRec->user_id = Auth::user()->id;
                $newRec->bank_id = $bankAcc->bank_id;
                $newRec->acc_title = $bankAcc->acc_title;
                $newRec->acc_number = $bankAcc->acc_number;
                $newRec->amount = $amount;
                $newRec->transaction = $request['rent_amount'];
                $newRec->property_id = $rentProperty->property_id;
                $newRec->save();

                $bankAcc->status = "inactive";
                $bankAcc->save();
            }
        }

        return redirect()->route('admin.rented.property.detail',$rentProperty->property_id)->with('success', 'Rent added successfully.');
    }
}
