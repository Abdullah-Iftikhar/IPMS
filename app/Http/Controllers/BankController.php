<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function list()
    {
        $returnArr['banks'] = Bank::where(function ($query) {
            if (isset($_GET['name']) && $_GET['name'] != '') {
                $query->where('name', 'LIKE', '%' . trim($_GET['name']) . '%');
            }
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.banks.list', $returnArr);
    }

    public function save(Request $request)
    {
        $request->validate([
            'bank_name' => 'required | unique:banks,name'
        ]);

        $bank = new Bank();
        $bank->name = $request['bank_name'];
        $bank->save();

        return redirect()->back()->with('success', 'Bank added successfully.');
    }

    public function destroy($id)
    {
        $bank = Bank::find($id);
        if ($bank) {
            $bank->delete();
            return redirect()->back()->with('success', 'Bank deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Bank not found.');
        }
    }

    public function amountList()
    {
        $returnArr['banks'] = Bank::get();
        $returnArr['accounts'] = BankAccount::where(function ($query) {
            if (isset($_GET['bank']) && $_GET['bank'] != '') {
                $query->where('bank_id', 'LIKE', '%' . trim($_GET['bank']) . '%');
            }
            })
            ->where(function ($query) {
                if (isset($_GET['account_title']) && $_GET['account_title'] != '') {
                    $query->where('acc_title',trim($_GET['account_title']));
                }
            })
            ->where(function ($query) {
                if (isset($_GET['account_number']) && $_GET['account_number'] != '') {
                    $query->where('acc_number', trim($_GET['account_number']));
                }
            })
            ->where(function ($query) {
                if (isset($_GET['amount']) && $_GET['amount'] != '') {
                    $query->where('amount', 'LIKE', '%' . trim($_GET['amount']) . '%');
                }
            })
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.banks.account.list', $returnArr);

    }

    public function amountSave(Request $request)
    {
        $exist = BankAccount::where('bank_id', $request['bank'])
            ->where('acc_number', $request['account_number'])
            ->first();
        if ($exist) {
            return redirect()->back()->with('error', 'This account is already exist.');
        }
        $request->validate([
            'bank' => 'required',
            'account_title' => 'required',
            'account_number' => 'required',
            'amount' => 'required',
        ]);

        $bank = new BankAccount();
        $bank->user_id = Auth::user()->id;
        $bank->bank_id = $request['bank'];
        $bank->acc_title = $request['account_title'];
        $bank->acc_number = $request['account_number'];
        $bank->amount = $request['amount'];
        $bank->save();

        return redirect()->back()->with('success', 'Bank account added successfully.');
    }

    public function amountDestroy($id)
    {
        $account = BankAccount::find($id);
        if ($account) {
            $account->delete();
            return redirect()->back()->with('success', 'Bank account deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Account not found.');
        }
    }

    public function accTransaction($id) {
        $returnArr['transactions'] = BankAccount::where('acc_number', $id)
            ->where(function ($query) {
                if (isset($_GET['amount']) && $_GET['amount'] != '') {
                    $query->where('amount', 'LIKE', '%' . trim($_GET['amount']) . '%');
                }
            })
            ->orderBy('created_at', 'asc')
            ->get();
        return view('admin.banks.account.transactions', $returnArr);
    }
}
