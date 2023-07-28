<?php

namespace App\Http\Controllers\API_RESTAURANT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Arr;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use Illuminate\Support\Str;
use App\Models\restaurant;
use App\Models\restaurant_category;
use App\Models\restaurant_outlet;
use App\Models\restaurant_time_slot;
use App\Models\book_table;
use Hash;

class AuthController extends Controller
{
    public function sendotp(Request $request)
    {
        if(restaurant::where('restaurant_mobile',$request->restaurant_mobile)->orWhere('restaurant_email',$request->restaurant_email)->exists())
        {
            return response()->json(['success' => 'false','message' => 'Mobile No./Email Id already exists.'], 200);
        } 
        else
        { 
            Helpers::otp($request->restaurant_mobile, $request->otp);
            return response()->json(['success' => 'true','message' => 'Otp send successfully.'], 200);
        } 
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^[0-9]+$/u',
        ]);

        if($validator->fails()){
            return response()->json(['success' => 'false','error' => $validator->errors()], 200);     
        }

        if(restaurant::where('restaurant_mobile',$request->mobile)->exists())
        {
            Helpers::otp($request->mobile, $request->otp);
            return response()->json(['success' => 'true','message' => 'OTP Send To Your Registered Mobile No.'], 200);
        } 
        else
        { 
            return response()->json(['success' => 'false','message' => 'Mobile No. Not Registered.'], 200);
        } 
    }

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'restaurant_device_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['success' => 'false','errors' => $validator->errors()], 400);    
        }

        if(is_numeric($request->get('email')))
        {
            $data = [
                'restaurant_mobile' => $request->get('email'),
                'password' => $request->get('password'),
            ];

            $restaurant = restaurant::where(['restaurant_mobile' => $request['email']])->first();
        }
        else if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) 
        {
            $data = [
                'restaurant_email' => $request->get('email'),
                'password' => $request->get('password'),
            ];

            $restaurant = restaurant::where(['restaurant_email' => $request['email']])->first();
        }
        else
        {
            return response()->json(['success' => 'false','token'=>'Invalid','data'=>'N/A','message'=>'Invalid credencial'],200);
        }

        if(auth('restaurant')->attempt($data)) 
        {
            if (isset($restaurant) && $restaurant['restaurant_status'] == '1' && auth('restaurant')->attempt($data)) 
            {
                $token = Str::random(50);
                restaurant::where(['restaurant_id' => auth('restaurant')->id()])->update(['auth_token' => $token,'restaurant_device_id'=>$request->restaurant_device_id]);

                $restaurant = restaurant::where('restaurant_id',auth('restaurant')->user()->restaurant_id)->first();

                // Helpers::otp($request->mobile, $request->otp);
                return response()->json(['success' => 'true','token'=>$token,'data'=>$restaurant,'message'=>'Logged In'],200);
            }
            else
            {
                return response()->json(['success' => 'false','token'=>'Deactivated','data'=>'N/A','message'=>'Account has been suspended'],200);
            }
        } 
        else
        { 
            return response()->json(['success' => 'false','token'=>'Invalid','data'=>'N/A','message'=>'Invalid credencial'],200);
        } 
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_mobile' => 'required|regex:/^[0-9]+$/u|unique:restaurants,restaurant_mobile',
            'restaurant_device_id' => 'required',
            'restaurant_email' => 'required|unique:restaurants,restaurant_email',
        ]);
   
        if($validator->fails()){
            return response()->json(['success' => 'false','errors' => $validator->errors()], 200);       
        }

        $data = $request->all();
        $token = Str::random(50);
        $ins=array(
            'country_id'=>$data['country_id'] ? $data['country_id'] : '1',
            'restaurant_name'=>$data['restaurant_name'] ? $data['restaurant_name'] : 'N/A',
            'restaurant_mobile'=>$data['restaurant_mobile'] ? $data['restaurant_mobile'] : 'N/A',
            'restaurant_email'=>$data['restaurant_email'] ? $data['restaurant_email'] : 'N/A',
            'password'=>bcrypt($data['password']),
            'restaurant_device_id'=>$data['restaurant_device_id'] ? $data['restaurant_device_id'] : 'N/A',
            'restaurant_image'=>$data['restaurant_image'] ? $data['restaurant_image'] : 'N/A',
            'restaurant_gps_address'=>$data['restaurant_gps_address'] ? $data['restaurant_gps_address'] : 'N/A',
            'restaurant_gps_lat'=>$data['restaurant_gps_lat'] ? $data['restaurant_gps_lat'] : 'N/A',
            'restaurant_gps_lng'=>$data['restaurant_gps_lng'] ? $data['restaurant_gps_lng'] : 'N/A',
            'restaurant_about'=>$data['restaurant_about'] ? $data['restaurant_about'] : 'N/A',
            'shipping_charge'=>$data['shipping_charge'] ? $data['shipping_charge'] : 'N/A',
            'license_no'=>$data['license_no'] ? $data['license_no'] : 'N/A',
            'aadhar_no'=>$data['aadhar_no'] ? $data['aadhar_no'] : 'N/A',
            'aadhar_front_image'=>$data['aadhar_front_image'] ? $data['aadhar_front_image'] : 'N/A',
            'aadhar_back_image'=>$data['aadhar_back_image'] ? $data['aadhar_back_image'] : 'N/A',
            'pancard_no'=>$data['pancard_no'] ? $data['pancard_no'] : 'N/A',
            'pancard_front_image'=>$data['pancard_front_image'] ? $data['pancard_front_image'] : 'N/A',
            'pancard_back_image'=>$data['pancard_back_image'] ? $data['pancard_back_image'] : 'N/A',
            'voter_card_no'=>$data['voter_card_no'] ? $data['voter_card_no'] : 'N/A',
            'voter_front_image'=>$data['voter_front_image'] ? $data['voter_front_image'] : 'N/A',
            'voter_back_image'=>$data['voter_back_image'] ? $data['voter_back_image'] : 'N/A',
            'restaurant_state'=>$data['restaurant_state'] ? $data['restaurant_state'] : 'N/A',
            'restaurant_city'=>$data['restaurant_city'] ? $data['restaurant_city'] : 'N/A',
            'restaurant_area'=>$data['restaurant_area'] ? $data['restaurant_area'] : 'N/A',
            'select_kyc'=>$data['select_kyc'] ? $data['select_kyc'] : 'N/A',
            'restaurant_contact_person'=>$data['restaurant_contact_person'] ? $data['restaurant_contact_person'] : 'N/A',
            'restaurant_phone'=>$data['restaurant_phone'] ? $data['restaurant_phone'] : 'N/A',
            'delivery_type'=>$data['delivery_type'] ? $data['delivery_type'] : 'N/A',
            'auth_token'=>$token,
        );
        $res_name = strtolower($data['restaurant_name']);
        $restaurant_name_code = str_replace("'", '', $res_name);
        $ins['restaurant_name_code'] = str_replace(' ', '-', $restaurant_name_code);
        $restaurant = restaurant::create($ins);

        $ins1=array(
            'outlet_gps_address'=>$data['restaurant_gps_address'] ? $data['restaurant_gps_address'] : 'N/A',
            'outlet_gps_lat'=>$data['restaurant_gps_lat'] ? $data['restaurant_gps_lat'] : 'N/A',
            'outlet_gps_lng'=>$data['restaurant_gps_lng'] ? $data['restaurant_gps_lng'] : 'N/A',
            'outlet_state'=>$data['restaurant_state'] ? $data['restaurant_state'] : 'N/A',
            'outlet_city'=>$data['restaurant_city'] ? $data['restaurant_city'] : 'N/A',
            'outlet_area'=>$data['restaurant_area'] ? $data['restaurant_area'] : 'N/A',
            'is_main'=>1,
            'restaurant_id'=>$restaurant->restaurant_id,
        );
        $restaurant_outlet = restaurant_outlet::create($ins1);

        for($i=0;$i<7;$i++)
        {
            if ($i==0) 
            {
                $day='Sunday';
            }
            if ($i==1) 
            {
                $day='Monday';
            }
            if ($i==2) 
            {
                $day='Tuesday';
            }
            if ($i==3) 
            {
                $day='Wednesday';
            }
            if ($i==4) 
            {
                $day='Thursday';
            }
            if ($i==5) 
            {
                $day='Friday';
            }
            if ($i==6) 
            {
                $day='Saturday';
            }
            $ins2=array(
                'day'=>$day,
                'from_time'=>'00:00:00',
                'to_time'=>'23:59:59',
                'restaurant_id'=>$restaurant->restaurant_id,
            );

            $restaurant_time_slot = restaurant_time_slot::create($ins2);
        }
        
        $list = restaurant::where('restaurant_id',$restaurant->restaurant_id)->first();

        return response()->json(['success' => 'true','token' => $token,'data' => $list,'message' => 'Restaurant registered successfully.'], 200);
    }

    public function profile_detail(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }
        
            $detail = restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->where('restaurant_id',$restaurant['restaurant_id'])->first();

            return response()->json(['success' => 'true','data' => $detail,'message' => 'Details fetched.'], 200);
    }

    public function updateprofile(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $input = $request->all();
   
        $restaurant_id=$restaurant['restaurant_id'];
        $restaurant = restaurant::find($restaurant_id);
        $res_name = strtolower($request['restaurant_name']);
        $restaurant_name_code = str_replace("'", '', $res_name);
        $input['restaurant_name_code'] = str_replace(' ', '-', $restaurant_name_code);
        $restaurant->update($input);

        $ins1=array(
            'outlet_gps_address'=>$request['restaurant_gps_address'] ? $request['restaurant_gps_address'] : 'N/A',
            'outlet_gps_lat'=>$request['restaurant_gps_lat'] ? $request['restaurant_gps_lat'] : 'N/A',
            'outlet_gps_lng'=>$request['restaurant_gps_lng'] ? $request['restaurant_gps_lng'] : 'N/A',
            'outlet_state'=>$request['restaurant_state'] ? $request['restaurant_state'] : 'N/A',
            'outlet_city'=>$request['restaurant_city'] ? $request['restaurant_city'] : 'N/A',
            'outlet_area'=>$request['restaurant_area'] ? $request['restaurant_area'] : 'N/A',
        );
        $restaurant_outlet = restaurant_outlet::where('restaurant_id',$restaurant_id)->where('is_main',1)->update($ins1);
        
        return response()->json(['success' => 'true','data'=>$restaurant,'message'=>'Profile updated'],200);
    }

    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'new_password' => 'required',
            'mobile' => 'required'
        ]);
           
        if($validator->fails()){
            return response()->json(['success' => 'false','data'=>'required','message'=>'filed is required'],200);   
        }

        if (restaurant::where(['restaurant_mobile' => $request['mobile']])->exists())
        {
            $ins['password'] = bcrypt($input['new_password']);
            restaurant::where('restaurant_mobile',$request['mobile'])->update($ins);
            return response()->json(['success' => 'true','data'=>'N/A','message'=>'Password changed successfully'],200);
        }
        else
        {
            return response()->json(['success' => 'false','data'=>'N/A','message'=>'Mobile No. Not Registered'],200);
        }
    }

    public function change_password(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'old_password' => 'required',
            'new_password' => 'required'
        ]);
           
        if($validator->fails()){
            return response()->json(['success' => 'false','data'=>'required','message'=>'filed is required'],200);   
        }

        $ins['password'] = bcrypt($input['new_password']);
            if (Hash::check($input['old_password'], $restaurant['password']))
            {
                restaurant::where('restaurant_id',$restaurant['restaurant_id'])->update($ins);
                return response()->json(['success' => 'true','data'=>'N/A','message'=>'Password changed successfully'],200);
            }
            else
            {
                return response()->json(['success' => 'false','data'=>'N/A','message'=>'Old password does not match'],200);
            }

        return $this->sendResponse('Updated', 'Password updated');
    }

    public function menu_list(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $cat = restaurant_category::leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->where('restaurant_categories.restaurant_id',$restaurant['restaurant_id'])->where('categories.cat_status',1)->select('categories.cat_name','categories.cat_image','categories.cat_id')->groupby('restaurant_categories.cat_id')->get();
        foreach($cat as $c)
        {
            $c['catmenus'] = restaurant_category::where('restaurant_categories.cat_id',$c['cat_id'])->where('restaurant_categories.restaurant_id',$restaurant['restaurant_id'])->orderby('restaurant_categories.restaurant_cat_id','DESC')->get();
        }

        if($cat->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$cat,'message'=>'Menu Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$cat,'message'=>'Menu fetched'],200);
        }
            
    }

    public function menu_on_off(Request $request,$restaurant_cat_id)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        if (restaurant_category::where('restaurant_cat_id',$restaurant_cat_id)->where('rest_menu_status',0)->exists()) 
        {
            restaurant_category::where('restaurant_cat_id',$restaurant_cat_id)->update(['rest_menu_status'=>1]);

            return response()->json(['success' => 'true','data'=>'changed','message'=>'Menu item activated'],200);

        }
        else
        {
            restaurant_category::where('restaurant_cat_id',$restaurant_cat_id)->update(['rest_menu_status'=>0]);

            return response()->json(['success' => 'true','data'=>'changed','message'=>'Menu item de-activated'],200);
        }
    }

    public function updatemenu_price(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $restaurant_category = restaurant_category::where('restaurant_cat_id',$request['restaurant_cat_id'])->update(['menu_price'=>$request['menu_price']]);
        
        return response()->json(['success' => 'true','data'=>$restaurant_category,'message'=>'Menu price updated'],200);
    }

    public function outlets_add(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $data = $request->all();
        $ins=array(
            'outlet_gps_address'=>$data['outlet_gps_address'] ? $data['outlet_gps_address'] : 'N/A',
            'outlet_gps_lat'=>$data['outlet_gps_lat'] ? $data['outlet_gps_lat'] : 'N/A',
            'outlet_gps_lng'=>$data['outlet_gps_lng'] ? $data['outlet_gps_lng'] : 'N/A',
            'outlet_state'=>$data['outlet_state'] ? $data['outlet_state'] : 'N/A',
            'outlet_city'=>$data['outlet_city'] ? $data['outlet_city'] : 'N/A',
            'outlet_area'=>$data['outlet_area'] ? $data['outlet_area'] : 'N/A',
            'restaurant_id'=>$restaurant['restaurant_id'],
        );
        $restaurant_outlet = restaurant_outlet::create($ins);
        
        return response()->json(['success' => 'true','data' => $restaurant_outlet,'message' => 'Restaurant outlet created.'], 200);
    }

    public function outlets(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $data = $request->all();
        $ins=array(
            'outlet_gps_address'=>$data['outlet_gps_address'] ? $data['outlet_gps_address'] : 'N/A',
            'outlet_gps_lat'=>$data['outlet_gps_lat'] ? $data['outlet_gps_lat'] : 'N/A',
            'outlet_gps_lng'=>$data['outlet_gps_lng'] ? $data['outlet_gps_lng'] : 'N/A',
            'outlet_state'=>$data['outlet_state'] ? $data['outlet_state'] : 'N/A',
            'outlet_city'=>$data['outlet_city'] ? $data['outlet_city'] : 'N/A',
            'outlet_area'=>$data['outlet_area'] ? $data['outlet_area'] : 'N/A',
            'restaurant_id'=>$restaurant['restaurant_id'],
        );
        $restaurant_outlet = restaurant_outlet::create($ins);
        
        return response()->json(['success' => 'true','data' => $restaurant_outlet,'message' => 'Restaurant outlet created.'], 200);
    }

    public function outlets_list(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $outlet = restaurant_outlet::where('restaurant_id',$restaurant['restaurant_id'])->get();

        if($outlet->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$outlet,'message'=>'outlet Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$outlet,'message'=>'Outlet fetched'],200);
        }
            
    }

    public function book_table_list(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $book_table=book_table::where('restaurant_id',$restaurant['restaurant_id'])->orderby('book_table_id','desc')->get();
        if($book_table->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$book_table,'message'=>'Booked table not found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$book_table,'message'=>'Booked table fetched'],200);
        }
    }
}
