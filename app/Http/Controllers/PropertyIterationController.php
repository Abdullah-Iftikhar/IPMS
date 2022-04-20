<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\PropertyIteration;
use App\Models\SoldProperty;
use App\Models\SoldPropertyIteration;
use Illuminate\Http\Request;

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

    public function getPropertyIteration($id)
    {
        $soldProperty = SoldProperty::findOrFail($id);
        $iterations = PropertyIteration::get();
        $banks = Bank::get();

        $soldAmount = $soldProperty->amount;
        $iterationAmount = 0;

        if ($soldProperty) {
            if (count($soldProperty->getSoldIteration)) {
                $iterationAmount = $soldProperty->getSoldIteration->sum('amount');
            }
        }
        $remainingAmount = $soldAmount - $iterationAmount;
        if($remainingAmount <= 0) {
            $soldProperty->status = 1;
            $soldProperty->save();
            return redirect()->back()->with('error', 'Your property is iteration completed.');
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
        return redirect()->route('admin.sold.property.detail', $id)->with('success', 'Iteration added successfully.');
    }
}
