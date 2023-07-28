<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use Brian2694\Toastr\Facades\Toastr;

class BusinessSettingsController extends Controller
{
    public function change_password()
    {
        return view('Admin.Change_password');
    }

    public function Update_password(Request $request)
    {
        if($request['confirm_password'] == $request['password'])
        {
            $user = admin::find(auth('admin')->user()->id);
            $user->password = bcrypt($request['confirm_password']);
            $user->save();
            Toastr::success('Success! password updated!');
            return back();
        }
        else
        { 
            Toastr::error('Error! Passwod and confirm password not same !');
            return back();
        }
        
    }

    public function Update_profile(Request $request)
    {
        $user = admin::find(auth('admin')->user()->id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        Toastr::success('Success! profile updated!');
        return back();
    }
}
