<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\ConstructProperty;
use App\Models\Property;
use App\Models\RentProperty;
use App\Models\RentPropertyImage;
use App\Models\SoldProperty;
use App\Models\SoldPropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function propertyList()
    {
        $returnArr['totalProperties'] = Property::count();
        $returnArr['activeProperties'] = Property::where('status', 'active')->count();
        $returnArr['soldProperties'] = Property::where('status', 'sold')->count();
        $returnArr['rentProperties'] = Property::where('status', 'rent')->count();
        $returnArr['constructProperties'] = Property::where('status', 'construct')->count();
        $returnArr['totalPropertiesPrice'] = Property::sum('rate');
        $returnArr['activePropertiesPrice'] = Property::where('status', 'active')->sum('rate');
        $returnArr['soldPropertiesPrice'] = Property::where('status', 'sold')->sum('rate');
        $returnArr['rentPropertiesPrice'] = Property::where('status', 'rent')->sum('rate');
        $returnArr['constructPropertiesPrice'] = Property::where('status', 'construct')->sum('rate');

        $returnArr['properties'] = Property::where(function ($query) {
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
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.property.list', $returnArr);
    }

    public function propertyAdd()
    {
        return view('admin.property.add_edit');
    }

    public function propertyPost(Request $request)
    {
        $request->validate([
            'society_name' => 'required',
            'plot_type' => 'required',
            'property_type' => 'required',
            'area' => 'required',
            'area_size' => 'required',
            'amount' => 'required',
            'property_for' => 'required',
        ]);

        if ($request['owner_name'] || $request['mobile_number'] || $request['mobile_number']) {
            $request->validate([
                'owner_name' => 'required',
                'mobile_number' => 'required',
                'id_card' => 'required'
            ]);
        }

        $property = new Property();
        $property->user_id = Auth::user()->id;
        $property->society = $request['society_name'];
        $property->plot_no = $request['plot_number'];
        $property->block = $request['block'];
        $property->phase = $request['phase'];
        $property->plot_type = $request['plot_type'];
        $property->property_type = $request['property_type'];
        $property->area = $request['area'];
        $property->area_size = $request['area_size'];
        $property->rate = $request['amount'];
        $property->property_for = $request['property_for'];
        $property->owner_name = $request['owner_name'];
        $property->owner_number = $request['mobile_number'];
        $property->id_card = $request['id_card'];
        $property->save();
        return redirect()->route('admin.property.list')->with('success', 'Property added successfully.');
    }

    public function propertyDetail($id)
    {
        $property = Property::find($id);
        if ($property) {
            return view('admin.property.detail', compact('property'));
        }
        return redirect()->back()->with('error', 'property not found.');
    }

    public function propertyEdit($id)
    {
        $property = Property::find($id);
        if ($property) {
            return view('admin.property.add_edit', compact('property'));
        }
        return redirect()->back()->with('error', 'property not found.');
    }

    public function propertyUpdate(Request $request, $id)
    {
        $property = Property::find($id);
        if ($property) {
            $request->validate([
                'society_name' => 'required',
                'plot_type' => 'required',
                'property_type' => 'required',
                'area' => 'required',
                'area_size' => 'required',
                'amount' => 'required',
                'property_for' => 'required',
            ]);

            if ($request['owner_name'] || $request['mobile_number'] || $request['id_card']) {
                $request->validate([
                    'owner_name' => 'required',
                    'mobile_number' => 'required',
                    'id_card' => 'required'
                ]);
            }

            $property->society = $request['society_name'];
            $property->plot_no = $request['plot_number'];
            $property->block = $request['block'];
            $property->phase = $request['phase'];
            $property->plot_type = $request['plot_type'];
            $property->property_type = $request['property_type'];
            $property->area = $request['area'];
            $property->area_size = $request['area_size'];
            $property->rate = $request['amount'];
            $property->property_for = $request['property_for'];
            $property->owner_name = $request['owner_name'];
            $property->owner_number = $request['mobile_number'];
            $property->id_card = $request['id_card'];
            $property->save();
            return redirect()->route('admin.property.list')->with('success', 'Property updated successfully.');
        }
    }

    public function destroy($id)
    {
        $property = Property::find($id);
        if ($property) {
            $property->delete();
            return redirect()->route('admin.property.list')->with('success', 'Property deleted successfully.');
        }
        return redirect()->back()->with('error', 'property not found.');
    }

    public function propertyTypeAct($type, $id)
    {
        $returnArr['property'] = Property::find($id);
        if ($returnArr['property']) {
            $returnArr['id'] = $id;
            $returnArr['accounts'] = BankAccount::where('status', 'active')->get();
            if ($type === 'sell') {
                return view('admin.property.sold.sold_form', $returnArr);
            }

            if ($type === 'rent') {
                return view('admin.property.rented.rented_form', $returnArr);
            }

            if ($type === 'construct') {
                $returnArr['property']->status = "construct";
                $returnArr['property']->save();

                $conPro = new ConstructProperty();
                $conPro->user_id = Auth::user()->id;
                $conPro->property_id = $returnArr['property']->id;
                $conPro->save();
                return redirect()->back()->with('success', 'Property added in construction section.');
            }
        }
        return redirect()->back()->with('error', 'property not found.');
    }

    public function propertySoldDetail(Request $request, $id)
    {
        $property = Property::find($id);
        if ($property) {
            $request->validate([
                'name' => 'required',
                'id_card' => 'required',
                'phone_number' => 'required',
                'amount' => 'required',
            ]);

            if ($request['images']) {
                $request->validate([
                    'images' => 'array',
                    'images.*' => 'required | image | mimes:jpeg,png,jpg,gif,svg',
                ]);
            }
            $soldProperty = new SoldProperty();
            $soldProperty->user_id = Auth::user()->id;
            $soldProperty->property_id = $property->id;
            $soldProperty->name = $request['name'];
            $soldProperty->id_card = $request['id_card'];
            $soldProperty->phone_number = $request['phone_number'];
            $soldProperty->amount = $request['amount'];
            $soldProperty->commission = $request['commission'];
            $soldProperty->save();

            if ($request['images']) {
                foreach ($request['images'] as $key => $image) {
                    $imgObj = new SoldPropertyImage();
                    $mainName = time() . $key . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/sold_property', $mainName);
                    $imgObj->sold_property_id = $soldProperty->id;
                    $imgObj->image = $mainName;
                    $imgObj->save();
                }
            }

            $property->status = "sold";
            $property->save();

            if ($request['bank_account']) {
                $bankAcc = BankAccount::find($request['bank_account']);
                if ($bankAcc) {
                    $amount = $bankAcc->amount + $soldProperty->amount;
                    $newRec = new BankAccount();
                    $newRec->user_id = Auth::user()->id;
                    $newRec->bank_id = $bankAcc->bank_id;
                    $newRec->acc_title = $bankAcc->acc_title;
                    $newRec->acc_number = $bankAcc->acc_number;
                    $newRec->amount = $amount;
                    $newRec->transaction = $soldProperty->amount;
                    $newRec->property_id = $property->id;
                    $newRec->save();

                    $bankAcc->status = "inactive";
                    $bankAcc->save();
                }
            }

            //Bank Detail
            return redirect()->route('admin.property.list')->with('success', 'property successfully added in sold list.');
        } else {
            return redirect()->back()->with('error', 'property not found.');
        }
    }

    public function propertyRentedDetail(Request $request, $id)
    {
        $property = Property::find($id);
        if ($property) {
            $request->validate([
                'name' => 'required',
                'id_card' => 'required',
                'phone_number' => 'required',
                'security' => 'required',
                'monthly_rent' => 'required',
                'commission' => 'required',
            ]);
            if ($request['images']) {
                $request->validate([
                    'images' => 'array',
                    'images.*' => 'required | image | mimes:jpeg,png,jpg,gif,svg',
                ]);
            }
            $rentedProperty = new RentProperty();
            $rentedProperty->user_id = Auth::user()->id;
            $rentedProperty->property_id = $property->id;
            $rentedProperty->name = $request['name'];
            $rentedProperty->id_card = $request['id_card'];
            $rentedProperty->phone_number = $request['phone_number'];
            $rentedProperty->advance_amount = $request['security'];
            $rentedProperty->monthly_rent = $request['monthly_rent'];
            $rentedProperty->commission = $request['commission'];
            $rentedProperty->remarks = $request['remarks'];
            $rentedProperty->save();

            if ($request['images']) {
                foreach ($request['images'] as $key => $image) {
                    $imgObj = new RentPropertyImage();
                    $mainName = time() . $key . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/rent_property', $mainName);
                    $imgObj->rent_property_id = $rentedProperty->id;
                    $imgObj->image = $mainName;
                    $imgObj->save();
                }
            }

            $property->status = "rent";
            $property->save();

            if ($request['bank_account']) {
                $bankAcc = BankAccount::find($request['bank_account']);
                if ($bankAcc) {
                    $amount = $bankAcc->amount + $rentedProperty->advance_amount;
                    $newRec = new BankAccount();
                    $newRec->user_id = Auth::user()->id;
                    $newRec->bank_id = $bankAcc->bank_id;
                    $newRec->acc_title = $bankAcc->acc_title;
                    $newRec->acc_number = $bankAcc->acc_number;
                    $newRec->amount = $amount;
                    $newRec->transaction = $rentedProperty->advance_amount;
                    $newRec->property_id = $property->id;
                    $newRec->save();

                    $bankAcc->status = "inactive";
                    $bankAcc->save();
                }
            }

            return redirect()->route('admin.property.list')->with('success', 'property successfully added in rent list.');
        } else {
            return redirect()->back()->with('error', 'property not found.');
        }
    }
}
