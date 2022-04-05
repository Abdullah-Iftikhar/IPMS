<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\SoldProperty;
use Illuminate\Http\Request;

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
        $property = Property::find($id);
        if ($property) {
            return view('admin.property.sold.detail', compact('property'));
        }
        return redirect()->back()->with('error', 'property not found.');
    }
}
