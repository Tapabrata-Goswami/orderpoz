<?php

namespace App\Http\Controllers\API;

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
use App\Models\restaurant_time_slot;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $data = $request->all();

        $res = restaurant_category::where('restaurant_cat_id',$data['restaurant_cat_id'])->first();

        $ins1=array(
            'restaurant_cat_id'=>$data['restaurant_cat_id'] ? $data['restaurant_cat_id'] : '0',
            'menu_price'=>$data['menu_price'] ? $data['menu_price'] : '0',
            'qty'=>$data['qty'] ? $data['qty'] : '0',
            'user_id'=>auth()->user()->id,
            'menu_id'=>$res['menu_id'] ? $res['menu_id'] : 'N/A',
            'restaurant_id'=>$res['restaurant_id'] ? $res['restaurant_id'] : 'N/A',
            'outlet_id'=>$data['outlet_id'] ? $data['outlet_id'] : '0',
            'cat_id'=>$res['cat_id'] ? $res['cat_id'] : 'N/A',
            'menu_title'=>$res['menu_title'] ? $res['menu_title'] : 'N/A',
            'menu_image'=>$res['menu_image'] ? $res['menu_image'] : 'N/A',
            'add_on_name'=>$data['add_on_name'] ? $data['add_on_name'] : 'N/A',
        );

        if (cart_item::where('restaurant_id',$res['restaurant_id'])->where('user_id',auth()->user()->id)->exists()) 
        {
            $cart_item = cart_item::create($ins1);
            
            if($cart_item)
            {
                return response()->json(['success' => 'true','data'=>$cart_item,'message'=>'Items added into cart'],200);
            }
            else
            {
                return response()->json(['success' => 'false','data'=>$cart_item,'message'=>'Something went wrong'],200);
            }
        }
        else
        {
            $remove=cart_item::where('user_id',auth()->user()->id)->delete();
            $cart_item = cart_item::create($ins1);

            return response()->json(['success' => 'true','data'=>$cart_item,'message'=>'Previous restaurant Item removed from the cart'],200);
        }
    }

    public function cart_list()
    {
        $cart_item = cart_item::leftjoin('restaurants','restaurants.restaurant_id','cart_items.restaurant_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->where('user_id',auth()->user()->id)->select('countries.*','cart_items.cart_id','cart_items.restaurant_cat_id','cart_items.restaurant_id','cart_items.menu_price','cart_items.qty','cart_items.menu_title','cart_items.menu_image','cart_items.outlet_id','cart_items.add_on_name','restaurants.secret_key','restaurants.publish_key')->get();

        if (cart_item::where('user_id',auth()->user()->id)->exists()) 
        {
            $restaurant_id = cart_item::where('user_id',auth()->user()->id)->first()->restaurant_id;
            $shipping_charge = restaurant::where('restaurant_id',$restaurant_id)->first()->shipping_charge;
        }
        else
        {
            $shipping_charge = '0';
            $restaurant_id = 0;
        }

        $day = Carbon::today()->format('l');
        if (restaurant_time_slot::where('restaurant_id',$restaurant_id)->exists()) 
            {
                if (restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day',$day)->exists()) 
                {
                    $time = restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day',$day)->first();

                    if (restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day',$day) ->where('from_time', '<=', date('H:i:s'))->where('to_time', '>=', date('H:i:s'))->exists()) 
                    {
                        $is_open=1;
                    }
                    else
                    {
                        $is_open=0;
                    }

                }
                else
                {
                    $is_open=1;
                }
            }
            else
            {
                $is_open=1;
            }
        

        if($cart_item->isEmpty())
        {
            return response()->json(['success' => 'false','shipping_charge' => $shipping_charge,'is_open' => $is_open,'data'=>$cart_item,'message'=>'Cart list found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','shipping_charge' => $shipping_charge,'is_open' => $is_open,'data'=>$cart_item,'message'=>'Cart list fetched'],200);
        }
    }

    public function cart_update(Request $request)
    {
        if($request->qty<1)
        {
            $cart_item=cart_item::where('cart_id',$request->cart_id)->delete();

            return response()->json(['success' => 'true','data'=>$cart_item,'message'=>'Item removed from the cart'],200);
        }
        else
        {
            $cart_item=cart_item::where('cart_id',$request->cart_id)->update(array('qty'=>$request->qty));

            return response()->json(['success' => 'true','data'=>$cart_item,'message'=>'Item quantity updated'],200);
        }

    }

    public function cart_item_remove(Request $request)
    {
        $cart_item=cart_item::where('cart_id',$request->cart_id)->delete();

        return response()->json(['success' => 'true','data'=>$cart_item,'message'=>'Item removed from the cart'],200);
    }

    public function order_place(Request $request)
    {
        $data = $request->all();
        $user_id=auth()->user()->id;

        $order_id = mt_rand(111111,999999);

		$countt=order_detail::get()->count();

		for($i=0;$i<$countt;$i++)
		{
			if(order_detail::where('order_id',$order_id)->exists())
			{
				$order_id = mt_rand(111111,999999);
			}
			else
			{
				break;
			}
		}

        if($data['order_type']=='Pickup')
        {
            $user_name = auth()->user()->name;
            $user_mobile = auth()->user()->mobile;
            $user_email = auth()->user()->email;
        }
        else
        {
            $user_name = $data['user_name'];
            $user_mobile = $data['user_mobile'];
            $user_email = $data['user_email'];
        }

        $ins=array(
            'order_id'=>$order_id,
            'user_id'=>$user_id,
            'restaurant_id'=>$data['restaurant_id'] ? $data['restaurant_id'] : '0',
            'outlet_id'=>$data['outlet_id'] ? $data['outlet_id'] : '0',
            'payment_type'=>$data['payment_type'] ? $data['payment_type'] : 'N/A',
            'basic_amount'=>$data['basic_amount'] ? $data['basic_amount'] : '0',
            'coupon_code'=>$data['coupon_code'] ? $data['coupon_code'] : 'N/A',
            'coupon_amount'=>$data['coupon_amount'] ? $data['coupon_amount'] : '0',
            'shipping_charge'=>$data['shipping_charge'] ? $data['shipping_charge'] : 'N/A',
            'grand_total'=>$data['grand_total'] ? $data['grand_total'] : '0',
            'user_name'=>$user_name,
            'user_mobile'=>$user_mobile,
            'user_email'=>$user_email,
            'pincode'=>$data['pincode'] ? $data['pincode'] : 'N/A',
            'house_flat_no'=>$data['house_flat_no'] ? $data['house_flat_no'] : 'N/A',
            'road_area_name'=>$data['road_area_name'] ? $data['road_area_name'] : 'N/A',
            'gps_address'=>$data['gps_address'] ? $data['gps_address'] : 'N/A',
            'order_type'=>$data['order_type'] ? $data['order_type'] : 'N/A',
            'gps_lat'=>$data['gps_lat'] ? $data['gps_lat'] : '0',
            'gps_lng'=>$data['gps_lng'] ? $data['gps_lng'] : '0',
            'cancel_reason'=>'N/A',
        );

        $order_detail = order_detail::create($ins);

        if ($order_detail) 
        {
            $cart_items = cart_item::where('user_id',auth()->user()->id)->get();
            foreach($cart_items as $cart_item)
            {
                $ins1=array(
                    'order_id'=>$order_id,
                    'restaurant_cat_id'=>$cart_item['restaurant_cat_id'] ? $cart_item['restaurant_cat_id'] : '0',
                    'per_menu_price'=>$cart_item['menu_price'] ? $cart_item['menu_price'] : '0',
                    'menu_qty'=>$cart_item['qty'] ? $cart_item['qty'] : '0',
                    'total_menu_price'=>$cart_item['qty']*$cart_item['menu_price'],
                    'user_id'=>auth()->user()->id,
                    'menu_id'=>$cart_item['menu_id'] ? $cart_item['menu_id'] : 'N/A',
                    'restaurant_id'=>$cart_item['restaurant_id'] ? $cart_item['restaurant_id'] : 'N/A',
                    'outlet_id'=>$cart_item['outlet_id'] ? $cart_item['outlet_id'] : 'N/A',
                    'cat_id'=>$cart_item['cat_id'] ? $cart_item['cat_id'] : 'N/A',
                    'menu_title'=>$cart_item['menu_title'] ? $cart_item['menu_title'] : 'N/A',
                    'menu_image'=>$cart_item['menu_image'] ? $cart_item['menu_image'] : 'N/A',
                    'add_on_name'=>$cart_item['add_on_name'] ? $cart_item['add_on_name'] : 'N/A',
                );
        
                    $order_menu_item = order_menu_item::create($ins1);
            }

                if (restaurant::where('restaurant_id',$data['restaurant_id'])->exists()) 
                {
                    $restaurant = restaurant::where('restaurant_id',$data['restaurant_id'])->first();
                    $data = [
                        'title' => 'Orderpoz Restaurant',
                        'description' => 'New order arrived. Order id is '.$order_id,
                    ];
                    Helpers::send_to_device('restaurant',$restaurant->restaurant_device_id,$data);
                }

                $ins2=array(
                    'noti_restaurant_id'=>$order_detail['restaurant_id'],
                    'noti_type'=>'1',
                    'noti_msg'=>'New order arrived. Order id is '.$order_id,
                    'noti_status'=>'1',
                );
                $local_notification = local_notification_restaurant::create($ins2);

                $removecart=cart_item::where('user_id',auth()->user()->id)->delete();

                return response()->json(['success' => 'true','data' => $order_detail,'message' => 'Order created successfully.'], 200);
        }
        else
        {
            return response()->json(['success' => 'false','data' => $order_detail,'message' => 'Something went wrong.'], 200);

        }
    }

    public function order_list($order_status)
    {
        $user_id = auth()->user()->id;
        if ($order_status=='All') 
        {
            $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->where('user_id',$user_id)->select('order_details.*','order_details.outlet_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email','countries.country_currency')->orderBy('o_id','desc')->get();
        }
        else if ($order_status==4) 
        {
            $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->where('user_id',$user_id)->whereIn('order_status',[4,5])->select('order_details.*','order_details.outlet_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email','countries.country_currency')->orderBy('o_id','desc')->get();
        }
        else
        {
            $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->where('user_id',$user_id)->where('order_status',$order_status)->select('order_details.*','order_details.outlet_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email','countries.country_currency')->orderBy('o_id','desc')->get();
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

    public function order_detail($order_id)
    {
        $user_id = auth()->user()->id;
        
            $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->where('order_id',$order_id)->where('user_id',$user_id)->select('order_details.*','order_details.outlet_id as ot_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email','countries.country_currency')->with('order_items')->first();

            $outlet = restaurant_outlet::where('outlet_id',$order_detail->ot_id)->first();

            $order_detail['outlet_gps_address'] = $outlet->outlet_gps_address;
            $order_detail['outlet_gps_lat'] = $outlet->outlet_gps_lat;
            $order_detail['outlet_gps_lng'] = $outlet->outlet_gps_lng;
            $order_detail['outlet_state'] = $outlet->outlet_state;
            $order_detail['outlet_city'] = $outlet->outlet_city;
            $order_detail['outlet_area'] = $outlet->outlet_area;

            if (restaurant_review::where('order_id',$order_id)->where('user_id',$user_id)->exists()) 
            {
                $order_detail['is_review'] = 1;
            }
            else
            {
                $order_detail['is_review'] = 0;
            }
        
        if($order_detail)
        {
            return response()->json(['success' => 'true','message' => 'Detail fetched','data'=>$order_detail], 200);
        }
        else
        {
            return response()->json(['success' => 'false','message' => 'Detail not fetched','data'=>$order_detail], 200);
        }
    }

    public function update_status($order_id)
    {
        $order_detail = order_detail::where('order_id',$order_id)->first();

        order_detail::where('order_id',$order_id)->update(array('order_status'=>4,'cancel_date'=>date('Y-m-d H:i:s')));

        $user_id=auth()->user()->id;
        $ins=array(
            'noti_user_id'=>$user_id,
            'noti_type'=>'1',
            'noti_msg'=>'Your order is cancelled. Your order id is '.$order_id,
            'noti_status'=>'1',
        );
        $local_notification = local_notification_user::create($ins);

        if (restaurant::where('restaurant_id',$order_detail->restaurant_id)->exists()) 
        {
            $restaurant = restaurant::where('restaurant_id',$order_detail->restaurant_id)->first();
            $data = [
                'title' => 'Orderpoz Restaurant',
                'description' => 'User cancelled order. Order id is '.$order_id,
            ];
            Helpers::send_to_device('restaurant',$restaurant->restaurant_device_id,$data);

            $ins1=array(
                'noti_restaurant_id'=>$order_detail->restaurant_id,
                'noti_type'=>'1',
                'noti_msg'=>'User cancelled order. Order id is '.$order_id,
                'noti_status'=>'1',
            );
            $local_notification = local_notification_restaurant::create($ins1);
        }

        return response()->json(['success' => 'true','data' => $order_detail,'message' => 'Order cancelled.'], 200);
        
    }
    
}
