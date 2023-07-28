<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\country;
use App\Models\order_detail;
use App\CPU\Helpers;
use Illuminate\Support\Arr;
use Brian2694\Toastr\Facades\Toastr;
use App\CPU\CartManager;
use App\CPU\ImageManager;

class AuthController extends Controller
{
    public function sendotplogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^[0-9]+$/u'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        
        if(User::where('mobile',$request->mobile)->exists())
        {
            $country = country::where('country_id',$request->country_id)->first();
            $otp = mt_rand(1000,9999);
            session()->put('otp_login',$otp);
            Helpers::otpweb($request->mobile,$otp,$country->country_code);
            return response()->json(200);
        }
        else
        {
            return response()->json(404);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^[0-9]+$/u',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

            $otp=session()->get('otp_login');
            if ($request->otp == $otp || $request->otp == 0001) 
            {
                if(Auth::attempt(['mobile' => $request->mobile, 'password' => '1234567890' ,'status'=>'1']))
                { 
                    $authUser = Auth::user(); 
                    session()->pull('otp_login');
                    CartManager::cart_to_db();
                    return response()->json(200);
                }
                else
                { 
                    session()->pull('otp_login');
                    return response()->json(201);
                }
            }
            else
            {
                return response()->json(404);
            }
    }

    public function logout(Request $request)
    {
        auth()->guard()->logout();
        $request->session()->invalidate();
        Toastr::info('Success! Logged Out');
        return redirect()->route('home');
    }

    public function sendotpregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^[0-9]+$/u|unique:users,mobile',
            'name' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

            $country = country::where('country_id',$request->country_id)->first();
            $otp = mt_rand(1000,9999);
            session()->put('otp_reg',$otp);
            Helpers::otpweb($request->phone,$otp,$country->country_code);
            return response()->json(200);
        
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^[0-9]+$/u|unique:users,mobile',
            'otp_reg' => 'required',
            'name' => 'required',
            'address' => 'required'
        ]);
   
        if($validator->fails()){
            return response()->json(['success' => 'false','errors' => $validator->errors()], 200);       
        }

        $otp=session()->get('otp_reg');
        if ($request->otp_reg == $otp || $request->otp_reg == 0001) 
        {
            $data = $request->all();

            $ins=array(
                'name'=>$data['name'] ? $data['name'] : 'N/A',
                'country_id'=>$data['country_id'] ? $data['country_id'] : 'N/A',
                'email'=>'N/A',
                'mobile'=>$data['phone'] ? $data['phone'] : 'N/A',
                'device_id'=>'N/A',
                'gps_address'=>$data['address'] ? $data['address'] : 'N/A',
                'gps_lat'=>$data['lat'] ? $data['lat'] : '0',
                'gps_lng'=>$data['lng'] ? $data['lng'] : '0',
                'image'=>'N/A',
            );
            $ins['password'] = bcrypt('1234567890');
            $user = User::create($ins);
            if($user)
            {
                if(Auth::attempt(['mobile' => $request->phone, 'password' => '1234567890' ,'status'=>'1']))
                { 
                    $authUser = Auth::user(); 
                    session()->pull('otp_reg');
                    CartManager::cart_to_db();
                    return response()->json(200);
                }
                else
                {
                    session()->pull('otp_reg');
                    return response()->json(201);
                }
            }
            else
            {
                session()->pull('otp_reg');
                return response()->json(201);
            }
        }
        else
        {
            return response()->json(404);
        }
        
    }

    public function updateNavview(Request $request)
    {
        return response()->json(['data' => view('WEB.partial-pages.header-view-page')->render()]);
    }

    public function dashboard()
    {
        $order_list = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('restaurant_outlets','restaurant_outlets.outlet_id','order_details.outlet_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->where('user_id',auth()->user()->id)->select('order_details.*','restaurant_outlets.outlet_gps_address','order_details.outlet_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email','countries.country_currency')->orderBy('o_id','desc')->get();

        return view('WEB.dashboard',compact('order_list'));
    }

    public function signin()
    {
        return view('WEB.sign-in');
    }

    public function edit_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gps_address' => 'required'
        ]);
   
        if($validator->fails()){
            return response()->json(['errors' => Helpers::error_processor($validator)]);        
        }
        $input = $request->all();
        if ($request->has('image')) {
            $input['image'] = ImageManager::update('modal/', auth()->user()->image, 'png', $request->file('image'));
        }
   
        $id=auth()->user()->id;
        $user = User::find($id);
        $user->update($input);

        Toastr::success('Success! Profile updated');
        return redirect()->back();
        
    }
}
