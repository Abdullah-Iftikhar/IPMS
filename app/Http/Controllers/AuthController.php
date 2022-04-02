<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function adminLogin(Request $request) {

        $request->validate([
            'email'=>'required | email',
            'password'=>'required',
        ]);
//        $user = User::where('email',$request['email'])->first();

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password']
        ];
        $auth = Auth::attempt($credentials);
        if($auth) {
            return redirect()->route('admin.dashboard');
        }

        else {
            return redirect()->back()->with('error', 'Email or Password is incorrect.');
        }
    }

    public function customerLoginReg(){

        return view('front.login-register');
    }

    public function customerRegistration(Request $request){
       $validation = $request->validate([
            'name_for_register'=>'required',
            'email_for_register'=>'required |unique:users,email',
            'password_for_register'=>'required',
            'confirm_password_for_register'=>'required | same:password_for_register'
        ]);
        $customer = new User();
        $customer->name = $request->name_for_register;
        $customer->email = $request->email_for_register;
        $customer->password = Hash::make($request->password_for_register);
        $customer->role = 2;
        $customer->save();

        Auth::login($customer);

        return redirect()->route('front.home');

    }

    public function forgetPassword(){
        return view('forget-password');
    }

    public function forgetPasswordEmail(Request $request){
            $emailExist = User::whereEmail(trim($request['email']))->first();
            if($emailExist) {
                $code = rand(000000,999999);
                $emailExist->password = Hash::make($code);
                $emailExist->save();

                $data = [
                    'subject' => "New Password Received",
                    'to' => $emailExist->email,
                    'content' => 'Your new password is ' . $code
                ];
                try {
                    Mail::send([], $data, function ($message) use ($data) {
                        $message->to($data['to'])
                            ->subject($data['subject'])
                            ->setbody($data['content'], 'text/html');
                    });
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }


                return redirect()->route('login')->with('success','Password has been sent on your email successfully');
            }
            return redirect()->back()->with('error', 'Email not found in record.');

    }

    public function usersList() {
        $returnArr['users'] = User::where('role', '!=', 'admin')
            ->where(function ($query) {
                if (isset($_GET['name']) && $_GET['name'] != '') {
                    $query->where('name', trim($_GET['name']));
                }
            })
            ->where(function ($query) {
                if (isset($_GET['email']) && $_GET['email'] != '') {
                    $query->where('email', trim($_GET['email']));
                }
            })->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.users.list', $returnArr);
    }

    public function addUser(Request $request) {
        $request->validate([
            'name'=>'required | min:5',
            'email'=>'required | email | unique:users',
        ]);
        $password = rand(99999, 00000);
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($password);
        $loginRoute = route('login');
        $login = "<a href='$loginRoute'>Login</a>";
        $data = [
            'subject' => "Congrats! Account Created. Check your password.",
            'to' => $request['email'],
            'content' => 'Your password is ' . $password.". ".$login
        ];

        $user->save();

        try {
            Mail::send([], $data, function ($message) use ($data) {
                $message->to($data['to'])
                    ->subject($data['subject'])
                    ->setbody($data['content'], 'text/html');
            });
        } catch (\Exception $e) {
            $user->delete();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.users.list')->with('success','User Added. Password automatically send to user email successfully.');
    }

    public function destroy($id) {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users.list')->with('success', 'User deleted successfully.');
        }
        return redirect()->back()->with('error', 'property not found.');
    }
}
