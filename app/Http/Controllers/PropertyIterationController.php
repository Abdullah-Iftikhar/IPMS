<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\PropertyIteration;
use App\Models\SoldProperty;
use App\Models\SoldPropertyIteration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyIterationController extends Controller
{
    public function index()
    {
        $returnArr['iterations'] = PropertyIteration::where(function ($query) {
            if (isset($_GET['name']) && $_GET['name'] != '') {
                $query->where('name', 'like', '%' . $_GET['name'] . '%');
            }
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.property.iteration.list', $returnArr);
    }

    public function add()
    {
        return view('admin.property.iteration.add_edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:property_iterations',
        ]);
        $iteration = new PropertyIteration();
        $iteration->name = $request['name'];
        $iteration->save();
        return redirect()->route('admin.property.iteration.list')->with('success', 'Property iteration added successfully.');
    }

    public function edit($id)
    {
        $iteration = PropertyIteration::find($id);
        if ($iteration) {
            return view('admin.property.iteration.add_edit', compact('iteration'));
        }
        return redirect()->back()->with('error', 'iteration not found.');
    }

    public function update(Request $request, $id)
    {
        $iteration = PropertyIteration::find($id);
        if ($iteration) {
            $request->validate([
                'name' => 'required|unique:property_iterations,name,' . $id . ',id',
            ]);
            $iteration->name = $request['name'];
            $iteration->save();
            return redirect()->route('admin.property.iteration.list')->with('success', 'Property iteration updated successfully.');
        }
    }

    public function destroy($id)
    {
        $iteration = PropertyIteration::find($id);
        if ($iteration) {
            $iteration->delete();
            return redirect()->route('admin.property.iteration.list')->with('success', 'Iteration deleted successfully.');
        }
        return redirect()->back()->with('error', 'Iteration not found.');
    }
}
