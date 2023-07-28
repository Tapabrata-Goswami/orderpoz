<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order_detail;
use App\Models\order_menu_item;
use App\Models\local_notification_user;
use App\Models\User;
use App\CPU\ImageManager;
use App\CPU\Helpers;
use Brian2694\Toastr\Facades\Toastr;

class OrderController extends Controller
{
    public function list($status, Request $request)
    {
        // Order::where(['checked' => 0])->update(['checked' => 1]);

        if(session()->has('order_filter'))
        {
            $request = json_decode(session('order_filter'));
        }

        $orders = order_detail::leftjoin('users','users.id','order_details.user_id')->leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->
        when($status == 'new', function($query){
            $query->where('order_details.order_status', 0);
        })
        ->when($status == 'accepted', function($query){
            $query->where('order_details.order_status', 1);
        })
        ->when($status == 'picked', function($query){
            $query->where('order_details.order_status', 2);
        })
        ->when($status == 'rejected', function($query){
            $query->where('order_details.order_status', 5);
        })
        ->when($status == 'cancelled', function($query){
            $query->where('order_details.order_status', 4);
        })
        ->when($status == 'completed', function($query){
            $query->where('order_details.order_status', 3);
        })
        ->when($status == 'all', function($query){
            $query;
        })
        ->when(isset($request->from_date)&&isset($request->to_date)&&$request->from_date!=null&&$request->to_date!=null, function($query)use($request){
            return $query->whereBetween('order_details.created_at', [$request->from_date." 00:00:00",$request->to_date." 23:59:59"]);
        })
        ->select('order_details.*','countries.*', 'users.name', 'restaurants.restaurant_name')->orderby('o_id','DESC')->paginate(config('default_pagination'));

        $from_date =isset($request->from_date)?$request->from_date:null;
        $to_date =isset($request->to_date)?$request->to_date:null;

        return view('Admin.order-list', compact('orders','status','from_date', 'to_date'));
    }

    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $parcel_order = $request->parcel_order??false;
        $orders=order_detail::leftjoin('users','users.id','order_details.user_id')->leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('order_details.order_id', 'like', "%{$value}%")
                ->orWhere('order_details.grand_total', 'like', "%{$value}%")
                ->orWhere('users.name', 'like', "%{$value}%")
                ->orWhere('restaurants.restaurant_name', 'like', "%{$value}%");
            }
        });
        $orders = $orders->limit(50)->get();
        
        return response()->json([
            'view'=>view('Admin.view.order-table',compact('orders','parcel_order'))->render()
        ]);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'from_date' => 'required_if:to_date,true',
            'to_date' => 'required_if:from_date,true',
        ]);
        session()->put('order_filter', json_encode($request->all()));
        return back();
    }

    public function filter_reset(Request $request)
    {
        session()->forget('order_filter');
        return back();
    }

    public function detail($o_id)
    {
        $order = order_detail::leftjoin('users','users.id','order_details.user_id')->leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('restaurant_outlets','restaurant_outlets.outlet_id','order_details.outlet_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->select('order_details.*','countries.*','restaurant_outlets.*', 'users.id', 'users.name','users.email','users.mobile','users.image', 'restaurants.restaurant_name', 'restaurants.restaurant_image','restaurants.restaurant_mobile','restaurants.restaurant_email')->orderBy('order_details.o_id', 'desc')->where('o_id',$o_id)->first();

        $order_menu_item = order_menu_item::leftjoin('categories','categories.cat_id','order_menu_items.cat_id')->select('order_menu_items.*', 'categories.cat_name')->orderBy('order_menu_items.order_item_id', 'desc')->where('order_id',$order->order_id)->get();

        return view('Admin.order-detail', compact('order','order_menu_item'));
    }

    public function status($order_id,$order_status)
    {
        $userdata=order_detail::where('order_id',$order_id)->first();
        $user = User::where('id',$userdata->user_id)->first();
        
        if($order_status==1)
        {
            order_detail::where('order_id',$order_id)->update(array('order_status'=>$order_status));

            if (User::where('id',$userdata->user_id)->exists()) 
            {
                $data = [
                    'title' => 'ORDERPOZ',
                    'description' => 'Dear '.$user->name.', Your order is accepted. your Order ID is '.$order_id,
                ];
                Helpers::send_to_device('user',$user->device_id, $data);
            }

            $ins=array(
                'noti_user_id'=>$userdata->user_id,
                'noti_type'=>'1',
                'noti_msg'=>'Your order is request accepted. your Order ID is '.$order_id,
                'noti_status'=>'1',
            );
            $local_notification = local_notification_user::create($ins);

            Toastr::success('Success! Status updated');
            return redirect()->route('panel.Order.list',['accepted']);

        }
        if($order_status==2)
        {
            order_detail::where('order_id',$order_id)->update(array('order_status'=>$order_status));

                if (User::where('id',$userdata->user_id)->exists()) 
                {
                    $data = [
                        'title' => 'ORDERPOZ',
                        'description' => 'Dear '.$user->name.', Your order is on the way. Your order id is '.$order_id,
                    ];
                    Helpers::send_to_device('user',$user->device_id, $data);
                }

                $ins=array(
                    'noti_user_id'=>$userdata->user_id,
                    'noti_type'=>'1',
                    'noti_msg'=>'Your order is on the way. Your order id is '.$order_id,
                    'noti_status'=>'1',
                );
                $local_notification = local_notification_user::create($ins);

                Toastr::success('Success! Status updated');
                return redirect()->route('panel.Order.list',['picked']);
        }
        if($order_status==3)
        {
            order_detail::where('order_id',$order_id)->update(array('order_status'=>$order_status,'delivered_date'=>date('Y-m-d H:i:s')));

            if (User::where('id',$userdata->user_id)->exists()) 
            {
                $data = [
                    'title' => 'ORDERPOZ',
                    'description' => 'Dear '.$user->name.', Your order is delivered. Your order id is '.$order_id,
                ];
                Helpers::send_to_device('user',$user->device_id, $data);
            }

            $ins=array(
                'noti_user_id'=>$userdata->user_id,
                'noti_type'=>'1',
                'noti_msg'=>'Your order is delivered. Your order id is '.$order_id,
                'noti_status'=>'1',
            );
            $local_notification = local_notification_user::create($ins);

            Toastr::success('Success! Status updated');
            return redirect()->route('panel.Order.list',['completed']);
        }
        if($order_status==4)
        {
            order_detail::where('order_id',$order_id)->update(array('order_status'=>$order_status,'cancel_date'=>date('Y-m-d H:i:s')));

            if (User::where('id',$userdata->user_id)->exists()) 
            {
                $data = [
                    'title' => 'ORDERPOZ',
                    'description' => 'Dear '.$user->name.', Your order is cancelled. Your order id is '.$order_id,
                ];
                Helpers::send_to_device('user',$user->device_id, $data);
            }

            $ins=array(
                'noti_user_id'=>$userdata->user_id,
                'noti_type'=>'1',
                'noti_msg'=>'Your order is cancelled. Your order id is '.$order_id,
                'noti_status'=>'1',
            );
            $local_notification = local_notification_user::create($ins);

            Toastr::success('Success! Status updated');
            return redirect()->route('panel.Order.list',['completed']);
        }

    }

    
}
