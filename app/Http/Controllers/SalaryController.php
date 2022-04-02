<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    public function salariesList() {
        $returnArr['employees'] = Employee::get();
        $returnArr['salaries'] = Salary::where(function ($query) {
            if (isset($_GET['salary']) && $_GET['salary'] != '') {
                $query->where('salary','LIKE', '%'. trim($_GET['salary'] . '%'));
            }
            })
            ->whereHas('getEmployee', function ($query) {
                if (isset($_GET['employee']) && $_GET['employee'] != '') {
                    $query->where('id',trim($_GET['employee']));
                }
                if (isset($_GET['cnic']) && $_GET['cnic'] != '') {
                    $query->where('cnic',trim($_GET['cnic']));
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.employee.salary.list', $returnArr);
    }

    public function addSalaries(Request $request) {
        $request->validate([
            'employee' => 'required',
            'salary' => 'required',
        ]);
        $salary = new Salary();
        $salary->user_id = Auth::user()->id;
        $salary->employee_id = $request['employee'];
        $salary->salary = $request['salary'];
        $salary->save();
        return redirect()->route('admin.salaries.list')->with('success', 'Salary added successfully.');
    }

    public function destroy($id) {
        $user = Salary::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.salaries.list')->with('success', 'Salary record deleted successfully.');
        }
        return redirect()->back()->with('error', 'Salary not found.');
    }
}
