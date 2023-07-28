<?php

namespace App\Http\Controllers\API_RESTAURANT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\CPU\Helpers;
use Illuminate\Support\Str;
use App\CPU\ImageManager;
use Illuminate\Support\Arr;
use App\Models\cart_item;
use App\Models\restaurant_category;
use App\Models\order_detail;
use App\Models\order_menu_item;
use App\Models\restaurant;
use App\Models\local_notification_restaurant;
use App\Models\local_notification_user;
use App\Models\restaurant_outlet;
use App\Models\restaurant_review;
use App\Models\User;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function order_list(Request $request ,$order_status)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        if ($order_status=='All') 
        {
            $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->where('restaurants.restaurant_id',$restaurant['restaurant_id'])->select('order_details.*','order_details.outlet_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email')->orderBy('o_id','desc')->get();
        }
        else
        {
            if ($order_status==4 || $order_status=='4') 
            {
                $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->where('restaurants.restaurant_id',$restaurant['restaurant_id'])->select('order_details.*','order_details.outlet_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email')->where(function($query){$query->where('order_status',4)->orWhere('order_status',5);})->orderBy('o_id','desc')->get();
            }
            else
            {
                $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->where('restaurants.restaurant_id',$restaurant['restaurant_id'])->where('order_status',$order_status)->select('order_details.*','order_details.outlet_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email')->orderBy('o_id','desc')->get();
            }
        }
        
        if($order_detail->isEmpty())
        {
            return response()->json(['success' => 'false','message' => 'list not fetched','data'=>$order_detail
            ], 200);
        }
        else
        {
            return response()->json(['success' => 'true','message' => 'list fetched','data'=>$order_detail
            ], 200);
        }
    }

    public function order_detail(Request $request ,$order_id)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }
        
            $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->where('order_id',$order_id)->where('restaurants.restaurant_id',$restaurant['restaurant_id'])->select('order_details.*','order_details.outlet_id as ot_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email')->with('order_items')->first();

            $outlet = restaurant_outlet::where('outlet_id',$order_detail->ot_id)->first();

            $order_detail['outlet_gps_address'] = $outlet->outlet_gps_address;
            $order_detail['outlet_gps_lat'] = $outlet->outlet_gps_lat;
            $order_detail['outlet_gps_lng'] = $outlet->outlet_gps_lng;
            $order_detail['outlet_state'] = $outlet->outlet_state;
            $order_detail['outlet_city'] = $outlet->outlet_city;
            $order_detail['outlet_area'] = $outlet->outlet_area;

        if($order_detail)
        {
            return response()->json(['success' => 'true','message' => 'Detail fetched','data'=>$order_detail], 200);
        }
        else
        {
            return response()->json(['success' => 'false','message' => 'Detail not fetched','data'=>$order_detail], 200);
        }
    }

    public function update_status(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $input = $request->all();

        $userdata=order_detail::where('order_id',$request->order_id)->first();
        $user = User::where('id',$userdata->user_id)->first();
        
        if($request->order_status==1)
        {
            order_detail::where('order_id',$request->order_id)->update(array('order_status'=>$request->order_status));

            if (User::where('id',$userdata->user_id)->exists()) 
            {
                $data = [
                    'title' => 'ORDERPOZ',
                    'description' => 'Dear '.$user->name.', Your order request is accepted. Your order id is '.$request->order_id,
                ];
                Helpers::send_to_device('user',$user->device_id, $data);
            }

            $ins=array(
                'noti_user_id'=>$userdata->user_id,
                'noti_type'=>'1',
                'noti_msg'=>'Your order request is accepted. Your order id is '.$request->order_id,
                'noti_status'=>'1',
            );
            $local_notification = local_notification_user::create($ins);

            return response()->json(['success' => 'true','data' => 'N/A','message' => 'Order accepted.'], 200);
            
        }
        if($request->order_status==2)
        {
            order_detail::where('order_id',$request->order_id)->update(array('order_status'=>$request->order_status));

                if (User::where('id',$userdata->user_id)->exists()) 
                {
                    $data = [
                        'title' => 'ORDERPOZ',
                        'description' => 'Dear '.$user->name.', Your order is on the Way. Your order id is '.$request->order_id,
                    ];
                    Helpers::send_to_device('user',$user->device_id, $data);
                }

                $ins=array(
                    'noti_user_id'=>$userdata->user_id,
                    'noti_type'=>'1',
                    'noti_msg'=>'Your order is on the way. Your order id is '.$request->order_id,
                    'noti_status'=>'1',
                );
                $local_notification = local_notification_user::create($ins);

                return response()->json(['success' => 'true','data' => 'N/A','message' => 'Order picked up.'], 200);
        }
        if($request->order_status==3)
        {
            order_detail::where('order_id',$request->order_id)->update(array('order_status'=>$request->order_status,'delivered_date'=>date('Y-m-d H:i:s')));

            if (User::where('id',$userdata->user_id)->exists()) 
            {
                $data = [
                    'title' => 'ORDERPOZ',
                    'description' => 'Dear '.$user->name.', Your order is delivered. Your order id is '.$request->order_id,
                ];
                Helpers::send_to_device('user',$user->device_id, $data);
            }

            $ins=array(
                'noti_user_id'=>$userdata->user_id,
                'noti_type'=>'1',
                'noti_msg'=>'Your order is delivered. Your order id is '.$request->order_id,
                'noti_status'=>'1',
            );
            $local_notification = local_notification_user::create($ins);

            return response()->json(['success' => 'true','data' => 'N/A','message' => 'Order delivered.'], 200);
        }

        if($request->order_status==5)
        {
            order_detail::where('order_id',$request->order_id)->update(array('order_status'=>$request->order_status,'delivered_date'=>date('Y-m-d H:i:s')));

            if (User::where('id',$userdata->user_id)->exists()) 
            {
                $data = [
                    'title' => 'ORDERPOZ',
                    'description' => 'Dear '.$user->name.', Your order is rejected. Your order id is '.$request->order_id,
                ];
                Helpers::send_to_device('user',$user->device_id, $data);
            }

            $ins=array(
                'noti_user_id'=>$userdata->user_id,
                'noti_type'=>'1',
                'noti_msg'=>'Your order is rejected. Your order id is '.$request->order_id,
                'noti_status'=>'1',
            );
            $local_notification = local_notification_user::create($ins);

            return response()->json(['success' => 'true','data' => 'N/A','message' => 'Order rejected.'], 200);
        }
    }

    public function report_list(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $all_order_week = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        $complate_order_week = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->where('order_status',3)->count();

        $cancel_order_week = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->whereIn('order_status',[4,5])->count();

        $all_order_month = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->whereMonth('created_at', Carbon::now())->count();

        $complate_order_month = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->where('order_status',3)->whereMonth('created_at', Carbon::now())->count();

        $cancel_order_month = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->whereIn('order_status',[4,5])->whereMonth('created_at', Carbon::now())->count();

        $online_sum = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->where('payment_type','Online')->where('order_status',3)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('grand_total');

        $cash_sum = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->where('order_status',3)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->where('payment_type','Cash')->sum('grand_total');

        $total_sum = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->where('order_status',3)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('grand_total');

        $online_month_sum = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->where('payment_type','Online')->where('order_status',3)->whereMonth('created_at', Carbon::now())->sum('grand_total');

        $cash_month_sum = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->where('payment_type','Cash')->where('order_status',3)->whereMonth('created_at', Carbon::now())->sum('grand_total');

        $total_month_sum = order_detail::where('restaurant_id',$restaurant['restaurant_id'])->where('order_status',3)->whereMonth('created_at', Carbon::now())->sum('grand_total');

            
            return response()->json(['success' => 'true','message' => 'N/A','all_order_week' => $all_order_week,'complate_order_week' => $complate_order_week,'cancel_order_week' => $cancel_order_week,'all_order_month' => $all_order_month,'complate_order_month' => $complate_order_month,'cancel_order_month' => $cancel_order_month,'online_sum' => $online_sum,'cash_sum' => $cash_sum,'total_sum' => $total_sum,'online_month_sum' => $online_month_sum,'cash_month_sum' => $cash_month_sum,'total_month_sum' => $total_month_sum
            ], 200);
    }
}
