<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function employeeList()
    {
        $returnArr['employees'] = Employee::where(function ($query) {
            if (isset($_GET['name']) && $_GET['name'] != '') {
                $query->where('name', trim($_GET['name']));
            }
        })
            ->orWhere(function ($query) {
                if (isset($_GET['number']) && $_GET['number'] != '') {
                    $query->where('number', trim($_GET['number']));
                }
            })
            ->orWhere(function ($query) {
                if (isset($_GET['cnic']) && $_GET['cnic'] != '') {
                    $query->where('cnic', trim($_GET['cnic']));
                }
            })->orWhere(function ($query) {
                if (isset($_GET['address']) && $_GET['address'] != '') {
                    $query->where('address', trim($_GET['address']));
                }
            })->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.employee.list', $returnArr);
    }

    public function addEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'cnic' => 'required',
            'address' => 'required',
        ]);
        $employee = new Employee();
        $employee->user_id = Auth::user()->id;
        $employee->name = $request['name'];
        $employee->number = $request['number'];
        $employee->cnic = $request['cnic'];
        $employee->address = $request['address'];
        $employee->save();
        return redirect()->route('admin.employee.list')->with('success', 'Employee added successfully.');
    }

    public function destroy($id)
    {
        $user = Employee::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.employee.list')->with('success', 'Employee deleted successfully.');
        }
        return redirect()->back()->with('error', 'Employee not found.');
    }
}
