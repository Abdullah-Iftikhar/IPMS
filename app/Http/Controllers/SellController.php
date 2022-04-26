<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Property;
use App\Models\PropertyIteration;
use App\Models\SoldProperty;
use App\Models\SoldPropertyIteration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{
    public function soldList()
    {
        $returnArr['soldProperties'] = Property::where(function ($query) {
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
            ->where('status', 'sold')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $returnArr['soldPropertiesCounter'] = SoldProperty::count();

        return view('admin.property.sold.list', $returnArr);
    }

    public function propertyDetail($id)
    {
        $property = Property::where('id', $id)->with('getSoldDetail.getSoldIteration')->first();
        if ($property) {

            return view('admin.property.sold.detail', compact('property'));
        }
        return redirect()->back()->with('error', 'property not found.');
    }


    public function getPropertyIteration($id)
    {
        $soldProperty = SoldProperty::findOrFail($id);
        $iterations = PropertyIteration::get();
        $soldIteration = SoldPropertyIteration::where('sold_property_id', $soldProperty->id)->orderBy('created_at', 'desc')->first();
        $banks = BankAccount::where('status', 'active')->get();
        $remainingAmount = $soldIteration->remaining;
        if($remainingAmount <= 0) {
            $soldProperty->status = 1;
            $soldProperty->save();
            return redirect()->back()->with('error', 'Your property iteration are completed.');
        }


        if ($soldProperty) {
            return view('admin.property.sold.iteration', compact('soldProperty', 'iterations', 'remainingAmount', 'banks'));
        }
        return redirect()->back()->with('error', 'property not found.');
    }

    public function postPropertyIteration(Request $request, $id)
    {
        $soldProperty = SoldProperty::findOrFail($id);

        $soldAmount = $soldProperty->amount;
        $iterationAmount = 0;

        if ($soldProperty) {
            if (count($soldProperty->getSoldIteration)) {
                $iterationAmount = $soldProperty->getSoldIteration->sum('amount');
            }
        }
        $remainingAmount = $soldAmount - ($iterationAmount+$request['amount']);

        $request->validate([
            'iteration' => 'required',
            'start_date' => 'required',
            'next_date' => 'nullable|after:start_date',
            'amount' => 'required',
        ]);

        $iteration = new SoldPropertyIteration();
        $iteration->sold_property_id = $soldProperty->id;
        $iteration->type = $request['iteration'];
        $iteration->start_date = $request['start_date'];
        $iteration->next_date = $request['next_date'];
        $iteration->amount = $request['amount'];
        $iteration->description = $request['description'];
        $iteration->bank_id = $request['bank'];
        $iteration->remaining = $remainingAmount;
        $iteration->save();


        if ($request['bank']) {
            $bankAcc = BankAccount::find($request['bank']);
            if ($bankAcc) {
                $amount = $bankAcc->amount + $request['amount'];
                $newRec = new BankAccount();
                $newRec->user_id = Auth::user()->id;
                $newRec->bank_id = $bankAcc->bank_id;
                $newRec->acc_title = $bankAcc->acc_title;
                $newRec->acc_number = $bankAcc->acc_number;
                $newRec->amount = $amount;
                $newRec->transaction = $request['amount'];
                $newRec->property_id = $soldProperty->property_id;
                $newRec->save();

                $bankAcc->status = "inactive";
                $bankAcc->save();
            }
        }


        return redirect()->route('admin.sold.property.detail', $id)->with('success', 'Iteration added successfully.');
    }

    public function deleteSoldProIteration($id) {
        $iterations = SoldPropertyIteration::findOrFail($id);
        $iterations->delete();
        return redirect()->back()->with('success', 'Iteration deleted successfully.');
    }
}
