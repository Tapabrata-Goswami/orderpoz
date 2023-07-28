<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\slider;
use App\Models\detail;
use App\Models\coupon;
use App\Models\local_notification_user;
use App\Models\restaurant_review;
use App\Models\restaurant;
use App\Models\restaurant_outlet;
use App\Models\country;
use App\Models\User;
use Validator;
use App\CPU\Helpers;
use Illuminate\Support\Str;
use App\CPU\ImageManager;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use DB;

class DetailController extends Controller
{
    public function show()
    {
        $detail = detail::first();
        return response()->json(['success' => 'true','data' => $detail,'message' => 'Details fetched.'], 200);
    }

    public function slider_show()
    {
        $slider = slider::where('slider_status',1)->get();
        foreach($slider as $sli)
        {
            $sli['outlet_id']=restaurant_outlet::where('restaurant_id',$sli->restaurant_id)->where('is_main',1)->first()->outlet_id;
        }
        
        if($slider->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$slider,'message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$slider,'message'=>'List fetched'],200);
        }
    }

    public function country_show()
    {
        $country = country::get();
        
        if($country->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$country,'message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$country,'message'=>'List fetched'],200);
        }
    }

    public function fileupload(Request $request)
    {
       $validator = Validator::make($request->all(),[ 
              'image' => 'required|image:jpeg,png,jpg',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 400);
            
        }
         
        $image=ImageManager::upload('modal/', 'png', $request->file('image'));
        return response()->json(['image' => $image], 200);
    }

    public function coupon_show($user_id)
    {
        if(User::where('id',$user_id)->exists())
        {
            $user=User::where('id',$user_id)->first();

            $coupon = coupon::where('country_id',$user->country_id)->where('coupon_validity','>=',Carbon::today())->where('coupon_status',1)->get();
        }
        else
        {
            $coupon = coupon::where('coupon_validity','>=',Carbon::today())->where('coupon_status',1)->get();
        }
            
        
        if($coupon->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$coupon,'message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$coupon,'message'=>'List fetched'],200);
        }
    }

    public function localnotishow()
    {
        $noti = local_notification_user::where('noti_user_id',auth()->user()->id)->orderby('user_noti_id','DESC')->get();
        if($noti->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$noti,'message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$noti,'message'=>'List fetched'],200);
        }
    }

    public function reviewstore(Request $request)
    {
        $input = $request->all();
       
            $ins_d=array(
                'restaurant_id'=>$request->restaurant_id,
                'user_id'=>auth()->user()->id,
                'order_id'=>$request->order_id,
                'restaurant_review'=>$request->restaurant_review,
                'restaurant_rate'=>$request->restaurant_rate,
            );
            $restaurant_review = restaurant_review::create($ins_d);

            $restaurant_rate = restaurant_review::where('restaurant_id',$request->restaurant_id)->avg('restaurant_rate');

            $restaurant_up =restaurant::where('restaurant_id',$request->restaurant_id)->update([
                'total_rating' => $restaurant_rate,
            ]);
           
            return response()->json(['success' => 'true','data' => $restaurant_review,'message' => 'Review add successfully'], 200);
    }

    public function add_record(Request $request)
    {
        $data = $request->all();

        $ins1=array(
            'record'=>$data['record'] ? $data['record'] : 'N/A',
            'created'=>date('Y-m-d H:i:s'),
        );
        
        $records = DB::table('records')->insert($ins1);
        
        if($records)
        {
            return response()->json(['success' => 'true','data'=>$records,'message'=>'Data added'],200);
        }
        else
        {
            return response()->json(['success' => 'false','data'=>$records,'message'=>'Something went wrong'],200);
        }
        
    }

    public function record_list()
    {
        $records = DB::table('records')->orderby('id','DESC')->get();
        
        if($records->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$records,'message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$records,'message'=>'List fetched'],200);
        }
        
    }
}
