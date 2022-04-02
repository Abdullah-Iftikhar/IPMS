<?php

namespace App\Http\Controllers;

use App\Models\ConstructionMaterial;
use App\Models\ConstructProperty;
use App\Models\Material;
use App\Models\Property;
use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    public function constructionList()
    {
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
                if (isset($_GET['marla']) && $_GET['marla'] != '') {
                    $query->where('marla', trim($_GET['marla']));
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
            ->where('status', 'construct')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        $returnArr['propertiesCounter'] = Property::where('status',  'construct')->count();
        return view('admin.property.construct.list', $returnArr);
    }

    public function constructionMaterialList() {
        $returnArr['materials'] = Material::where(function ($query) {
            if (isset($_GET['name']) && $_GET['name'] != '') {
                $query->where('name', 'LIKE', '%'.trim($_GET['name']).'%');
            }
        })->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.property.construct.material_list', $returnArr);
    }

    public function saveMaterial(Request $request) {
        $request->validate([
            'material_name' => 'required | unique:materials,name'
        ]);

        $material = new Material();
        $material->name = $request['material_name'];
        $material->save();

        return redirect()->back()->with('success', 'Material added successfully.');
    }

    public function destroy($id) {
        $material = Material::find($id);
        if($material) {
            $constructExist = ConstructionMaterial::where('material_id', $material->id)->get();
            if(count($constructExist) > 0) {
                return redirect()->back()->with('error', 'This material is exist in construction property.');
            }
            else {
                $material->delete();
                return redirect()->back()->with('success', 'Material deleted successfully.');
            }
        }
        else {
            return redirect()->back()->with('error', 'Material not found.');
        }
    }

    public function addPropertyMaterial($id) {
        $property = Property::find($id);
        if($property && $property->getConstructionDetail) {
            $construction = $property->getConstructionDetail;
            $materials = Material::orderBy('name')->get();
           return view('admin.property.construct.construct_form', compact('property', 'construction', 'materials'));
        }
        else {
            return redirect()->back()->with('error', 'Please move this property to construction section from property list.');
        }
    }


    public function postPropertyMaterial(Request $request) {
        $request->validate([
            'material' => 'required',
            'description' => 'required',
            'account' => 'required'
        ]);
        $property = Property::find($request['property_id']);
        if($property) {
            $construction = ConstructProperty::find($request['construction_id']);
            if($construction) {
                $material = new ConstructionMaterial();
                $material->construct_property_id = $construction->id;
                $material->material_id = $request['material'];
                $material->price = $request['account'];
                $material->desc = $request['description'];
                $material->save();
                return redirect()->route('admin.property.construction')->with('success', 'Material added in this property.');
            }
            else  {
                return redirect()->route('admin.property.construction')->with('error', 'Mark property under construction.');
            }
        }
        else  {
            return redirect()->route('admin.property.construction')->with('error', 'Property not exist.');
        }
    }

    public function constructionCompleted($id) {
        $property = Property::find($id);
        if($property && $property->getConstructionDetail) {
            $construct = ConstructProperty::where('property_id', $property->id)->first();
            $construct->status = "completed";
            $construct->save();
            return redirect()->back()->with('success', 'Property construction mark completed successfully.');
        }
        else {
            return redirect()->back()->with('error', 'Please move this property to construction section from property list.');
        }
    }

    public function constructionDetail($id) {
        $returnArr['property'] = Property::find($id);
        if ($returnArr['property']) {
            $returnArr['materials'] = Material::get();
            $constructProperty = ConstructProperty::where('property_id', $returnArr['property']->id)->first();
            if($constructProperty) {
                if (isset($_GET['material']) && $_GET['material'] != '') {
                    $returnArr['searchMaterials'] = ConstructionMaterial::where('construct_property_id', $constructProperty->id)
                        ->where('material_id',trim($_GET['material']))
                        ->get();
                }
                else {
                    $returnArr['searchMaterials'] = ConstructionMaterial::where('construct_property_id', $constructProperty->id)
                        ->get();
                }
            }
            return view('admin.property.construct.detail', $returnArr);
        }
        return redirect()->back()->with('error', 'property not found.');
    }

}
