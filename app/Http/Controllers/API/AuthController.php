<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\country;
use App\Models\order_detail;
use App\CPU\Helpers;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    public function sendotp(Request $request)
    {
        $country = country::where('country_id',$request->country_id)->first();
        Helpers::otpweb($request->mobile,$request->otp,$country->country_code);
        return response()->json(['success' => 'true','message' => 'Otp send successfully.'], 200);
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^[0-9]+$/u',
        ]);

        if($validator->fails()){
            return response()->json(['success' => 'false','error' => $validator->errors()], 200);     
        }

        if(User::where('mobile',$request->mobile)->where('country_id',$request->country_id)->exists())
        {
            return response()->json(['success' => 'true','message' => 'Mobile No. Already Exist.'], 200);
        } 
        else
        { 
            $country = country::where('country_id',$request->country_id)->first();
            Helpers::otpweb($request->mobile,$request->otp,$country->country_code);

            return response()->json(['success' => 'false','message' => 'Mobile No. Not Registered.'], 200);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^[0-9]+$/u|unique:users,mobile',
            'device_id' => 'required',
        ]);
   
        if($validator->fails()){
            return response()->json(['success' => 'false','errors' => $validator->errors()], 200);       
        }

        $data = $request->all();

        $ins=array(
            'country_id'=>$data['country_id'] ? $data['country_id'] : '1',
            'name'=>$data['name'] ? $data['name'] : 'N/A',
            'email'=>'N/A',
            'mobile'=>$data['mobile'] ? $data['mobile'] : 'N/A',
            'device_id'=>$data['device_id'] ? $data['device_id'] : 'N/A',
            'gps_address'=>$data['gps_address'] ? $data['gps_address'] : 'N/A',
            'gps_lat'=>$data['gps_lat'] ? $data['gps_lat'] : '0',
            'gps_lng'=>$data['gps_lng'] ? $data['gps_lng'] : '0',
            'image'=>'N/A',
        );
        $ins['password'] = bcrypt('1234567890');
        $user = User::create($ins);
        $token =  $user->createToken('MyAuthApp')->plainTextToken;
        $list = User::where('id',$user->id)->first();

        return response()->json(['success' => 'true','token' => $token,'data' => $list,'message' => 'User registered successfully.'], 200);
    }

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^[0-9]+$/u',
            'device_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['success' => 'false','message' => 'Mobile no. is required'], 200);      
        }

        if(User::where('mobile',$request->mobile)->where('country_id',$request->country_id)->exists())
        {
            if(Auth::attempt(['mobile' => $request->mobile ,'country_id' => $request->country_id , 'password' => '1234567890' ,'status'=>'1']))
            { 
                // if(Auth::attempt(['mobile' => $request->mobile])){ 
                $authUser = Auth::user(); 

                User::where('id',auth()->user()->id)->update(['device_id'=>$request->device_id]);

                $token = $authUser->createToken('MyAuthApp')->plainTextToken; 
                $list = User::where('id',auth()->user()->id)->first();

                return response()->json(['success' => 'true','token' => $token,'data' => $list,'message' => 'User logged in'], 200);
            }
            else
            { 
                return response()->json(['success' => 'false','message' => 'Account has been suspended.'], 200);
            }
        }
        else
        { 
            return response()->json(['success' => 'false','token' => 'N/A','data' => 'N/A','message' => 'User not found.'], 200);
        }
    }

    public function updateprofile(Request $request)
    {
        $input = $request->all();
   
        $id=auth()->user()->id;
        $user = User::find($id);
        $user->update($input);
        
        return response()->json(['success' => 'true','message' => 'Profile updated successfully.'], 200);
    }

    public function user_detail()
    {
        if (User::where('id',auth()->user()->id)->exists()) 
        {
            $detail = User::leftjoin('countries','countries.country_id','users.country_id')->where('id',auth()->user()->id)->first();
            if (order_detail::where('user_id',auth()->user()->id)->exists()) 
            {
                $order_detail = order_detail::where('user_id',auth()->user()->id)->orderby('o_id','DESC')->first();
                $detail['pincode'] = $order_detail->pincode;
                $detail['house_flat_no'] = $order_detail->house_flat_no;
                $detail['road_area_name'] = $order_detail->road_area_name;
            }
            else
            {
                $detail['pincode'] = 'N/A';
                $detail['house_flat_no'] = 'N/A';
                $detail['road_area_name'] = 'N/A';
            }

            return response()->json(['success' => 'true','data' => $detail,'message' => 'Details fetched.'], 200);
        }
        else
        {
            return response()->json(['success' => 'false','data' => 'N/A','message' => 'Details not found.'], 200);
        }
        
    }
}
