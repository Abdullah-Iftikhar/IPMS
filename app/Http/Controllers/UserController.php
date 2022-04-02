<?php

namespace App\Http\Controllers;

use App\Models\FeedInfo;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        return view('admin.users.list');
    }

    public function getPageResult(Request $request)
    {
        $totalData = User::where('role', '!=', 1)->count();
        $totalFiltered = $totalData;
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'role',
            4 => 'status',
            5 => 'action',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $start = $start ? $start / $limit : 0;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = User::where('role', '!=', 1)->orderBy($order, $dir)
                ->paginate($limit, ['*'], 'page', $start + 1);
            $totalFiltered = $totalData;
        } else {
            $search = $request->input('search.value');
            $users = User::where('role','!=',1)
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere(function ($query) use ($search){
                    $query->orWhere('email', 'LIKE', "%{$search}%")
                        ->where('role','!=',1);
                })
                ->orWhere(function ($query) use ($search){
                    $query->orWhere('role', 'LIKE', "%{$search}%")
                        ->where('role','!=',1);
                })
                ->orWhere(function ($query) use ($search){
                    $query->orWhere('status', 'LIKE', "%{$search}%")
                        ->where('role','!=',1);
                })
                ->orderBy($order, $dir)
                ->paginate($limit, ['*'], 'page', $start + 1);
            $totalFiltered = $users->count();
        }

        $data = array();
        if (!empty($users)) {
            foreach ($users as $key => $user) {
                $numId = ($start * $limit) + $key + 1;
                $nestedData['id'] = $numId;
                $nestedData['email'] = $user->email;
                if ($user->role == 2) {
                    $nestedData['role'] = "<span class='text-dark'>Customer</span>";
                    $nestedData['name'] = $user->name;
                } elseif ($user->role == 3) {
                    $nestedData['role'] = "<span class='text-info'>Retailer</span>";
                    $feedRoute = route('get.retailer.feeds', $user->id);
                    $nestedData['name'] = "<a href='$feedRoute' target='_blank'>$user->name</a>";

                }

                if ($user->status == 1) {
                    $nestedData['status'] = "<span class='text-success'>Active</span>";
                } else {
                    $nestedData['status'] = "<span class='text-danger'>Inactive</span>";
                }
                $adminUserList = true;
                $status = route('user.status', encrypt($user->id));
                $delete = route('user.drop', encrypt($user->id));
                $exist = $user;
                $nestedData['action'] = view('panel_partial.action', compact('exist', 'status', 'delete', 'adminUserList'))->render();
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return json_encode($json_data);
    }


    public function userStatus(Request $request, $id)
    {
        try {
            $record = User::find(decrypt($id));
            if ($record) {
                $record->status = $request['status'];
                $record->save();
                if ($request['status'] == 1) {
                    if($record->role == 3) {
                        $inactiveFeed = FeedInfo::with('getFeedProduct')
                            ->where('user_id', decrypt($id))
                            ->update(['status'=>1]);
                        $inactiveProduct = Product::whereHas('getFeed', function ($query) use ($id){
                            $query->where('user_id', decrypt($id));
                        })
                            ->update(['status'=>1]);
                    }
                    return redirect()->back()->with('success', 'User active successfully.');
                } else {
                    if($record->role == 3) {

                        $inactiveProduct = Product::whereHas('getFeed', function ($query) use ($id){
                            $query->where('user_id', decrypt($id));
                        })
                         ->update(['status'=>0]);
                        $inactiveFeed = FeedInfo::with('getFeedProduct')
                            ->where('user_id', decrypt($id))
                            ->update(['status'=>0]);

//                        dd('users going to inactive',$inactiveFeed->toArray(),$inactiveProduct->toArray());
                    }
                    return redirect()->back()->with('success', 'User inactive successfully.');
                }
            } else {
                return redirect()->back()->with('error', 'wrong access.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $record = User::find(decrypt($id));
        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'User successfully deleted.');
        } else {
            return redirect()->back()->with('error', 'Invalid record!');
        }
    }
}
