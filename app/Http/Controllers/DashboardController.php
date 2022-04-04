<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Caliber;
use App\Models\Category;
use App\Models\FeedInfo;
use App\Models\Grain;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Property;
use App\Models\ShellLength;
use App\Models\ShotSize;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function dashboard() {
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
        return view('panel_partial.dashboard', $returnArr);
    }

    public function profile() {
        return view('panel_partial.profile');
    }

    public function updateProfile(Request $request) {
        $auth = Auth::user();
        $request->validate([
            'name'=>'required | min:5',
            'email'=>'required | email',
        ]);

        if($request['password']) {
            $request->validate([
                'password' => 'required | min:5'
            ]);
            $auth->password = Hash::make($request['password']);
        }
        $auth->name = $request['name'];
        $auth->email = $request['email'];
        $auth->save();
        return redirect()->back()->with('success','Profile updated successfully.');
    }
}
