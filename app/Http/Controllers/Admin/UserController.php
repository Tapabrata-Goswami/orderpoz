<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    public function user_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $user = User::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('users.name', 'like', "%{$value}%")->orwhere('users.mobile', 'like', "%{$value}%")->orwhere('users.email', 'like', "%{$value}%");
                }
            })->orderBy('id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $user = User::orderBy('users.id', 'desc');
        }
        $user = $user->paginate(config('default_pagination'))->appends($query_param);

        return view('Admin.user-list', compact('user','search'));
    }

    public function update_user_status($id,$status)
    {
        $data = User::find($id);
        $data-> status = $status;
        $data -> save();

        Toastr::success('Success! Status updated');
        return back();
    }

    public function point_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $lp = lp_point::leftjoin('users','users.id','lp_points.lp_user_id')->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('users.name', 'like', "%{$value}%")->orwhere('users.mobile', 'like', "%{$value}%")->orwhere('users.email', 'like', "%{$value}%")->orwhere('lp_points.lp_point', 'like', "%{$value}%");
                }
            })->orderBy('lp_points.lp_point', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $lp = lp_point::leftjoin('users','users.id','lp_points.lp_user_id')->orderBy('lp_points.lp_point', 'desc');
        }
        $lp = $lp->paginate(config('default_pagination'))->appends($query_param);

        return view('Admin.lp-point-list', compact('lp','search'));
    }
}
