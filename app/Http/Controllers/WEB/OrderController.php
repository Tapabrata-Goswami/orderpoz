<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CPU\CartManager;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\cart_item;
use App\Models\User;
use App\Models\order_detail;
use App\Models\order_menu_item;
use App\Models\restaurant;
use App\Models\local_notification_restaurant;
use App\Models\local_notification_user;
use App\Models\restaurant_outlet;
use App\Models\restaurant_time_slot;
use App\Models\restaurant_review;
use App\Models\country;
use Validator;
use App\CPU\Helpers;
use Carbon\Carbon;
use Mail;
use App\Mail\OrderMail;
use App\Mail\RestuarantMail;
use DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cartcnt = CartManager::get_cart();
        $cnt = $cartcnt->count();
        if ($cnt<=0) 
        {
            $return = [
                'status' => 400,
                'message' => 'Error! Your cart is empty'
            ];
            return response()->json($return);
        }

        $data = $request->all();

        $day = Carbon::today()->format('l');
        if (restaurant_time_slot::where('restaurant_id',$data['restaurant_id'])->where('day',$day) ->where('from_time', '<=', date('H:i:s'))->where('to_time', '>=', date('H:i:s'))->exists()) 
        {
            
            $validator2 = Validator::make($request->all(), [
                'order_type' => 'required'
            ]);
            if($validator2->fails()){
                $return = [
                    'status' => 403,
                    'message' => 'Error! Please select order type'
                ];
                return response()->json($return);     
            }

            if ($request->order_type=='Pickup') 
            {
                $validator1 = Validator::make($request->all(), [
                    'outlet_id' => 'required'
                ]);
                if($validator1->fails()){
                    $return = [
                        'status' => 402,
                        'message' => 'Error! Please select restaurant outlet'
                    ];
                    return response()->json($return);     
                }
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'user_name' => 'required',
                    'user_mobile' => 'required',
                    'user_email' => 'required',
                    'gps_address' => 'required',
                    'house_flat_no' => 'required',
                    'road_area_name' => 'required',
                    'pincode' => 'required',
                ]);
        
                if($validator->fails()){
                    return response()->json(['errors' => Helpers::error_processor($validator)]);     
                }
            }

            $validator3 = Validator::make($request->all(), [
                'payment_type' => 'required'
            ]);
            if($validator3->fails()){
                $return = [
                    'status' => 406,
                    'message' => 'Error! Please select payment type'
                ];
                return response()->json($return);     
            }
        
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
            $sub_total=0;
            $cart = cart_item::where('user_id',auth()->user()->id)->get();
            foreach($cart as $cartItem)
            {
                $sub_total+=($cartItem['menu_price']*$cartItem['qty']);
            }

            $restaurant_outlet = restaurant_outlet::where('restaurant_id',$data['restaurant_id'])->where('is_main',1)->first();

            $restaurants = restaurant::where('restaurant_id',$data['restaurant_id'])->first();

            if ($request->outlet_id=='' || $request->outlet_id==Null) 
            {
                $outlet_id=$restaurant_outlet->outlet_id;
            }
            else
            {
                $outlet_id=$request->outlet_id;
            }

            if (session()->has('discounted_amount')) 
            {
                $discount = session()->get('discounted_amount');
            }
            else
            {
                $discount = 0;
            }

            if(session()->has('coupon_code'))
            {
                $promocode=session()->get('coupon_code');
            }
            else
            {
                $promocode='N/A';
            }

            if ($data['order_type']=='Pickup') 
            {
                $shipping_charge=0;
            }
            else
            {
                $shipping_charge=$restaurants->shipping_charge;
            }

            if(session()->has('amount'))
            {
                $grand_total=session()->get('amount') + $shipping_charge;
            }
            else
            {
                $grand_total=$sub_total + $shipping_charge;
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

            if($data['payment_type']=="Cash")
            {
            
                $ins=array(
                    'order_id'=>$order_id,
                    'user_id'=>$user_id,
                    'restaurant_id'=>$data['restaurant_id'] ? $data['restaurant_id'] : '0',
                    'outlet_id'=>$outlet_id,
                    'payment_type'=>$data['payment_type'] ? $data['payment_type'] : 'N/A',
                    'basic_amount'=>$sub_total,
                    'coupon_code'=>$promocode,
                    'coupon_amount'=>$discount,
                    'shipping_charge'=>$shipping_charge,
                    'order_type'=>$data['order_type'] ? $data['order_type'] : 'N/A',
                    'grand_total'=>$grand_total,
                    'user_name'=>$user_name,
                    'user_mobile'=>$user_mobile,
                    'user_email'=>$user_email,
                    'pincode'=>$data['pincode'] ? $data['pincode'] : 'N/A',
                    'house_flat_no'=>$data['house_flat_no'] ? $data['house_flat_no'] : 'N/A',
                    'road_area_name'=>$data['road_area_name'] ? $data['road_area_name'] : 'N/A',
                    'gps_address'=>$data['gps_address'] ? $data['gps_address'] : 'N/A',
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

                    session()->put('order_id',$order_id);

                    $order = DB::table('order_details')->leftjoin('users','users.id','order_details.user_id')->leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('restaurant_outlets','restaurant_outlets.outlet_id','order_details.outlet_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->select('order_details.*','countries.*','restaurant_outlets.*', 'users.id', 'users.name','users.email','users.mobile','users.image', 'restaurants.restaurant_name', 'restaurants.restaurant_image','restaurants.restaurant_mobile','restaurants.restaurant_email')->orderBy('order_details.o_id', 'desc')->where('order_id',session()->get('order_id'))->first();


                        Mail::to($user_email)->send(new OrderMail($order));

                        if (restaurant::where('restaurant_id',$data['restaurant_id'])->exists()) 
                        {
                            $restaurant = restaurant::where('restaurant_id',$data['restaurant_id'])->first();
                            $data = [
                                'title' => 'Orderpoz Restaurant',
                                'description' => 'New order arrived. Order ID is '.$order_id,
                            ];
                            Helpers::send_to_device('restaurant',$restaurant->restaurant_device_id,$data);

                            $country = country::where('country_id',$restaurant->country_id)->first();

                            Helpers::successuserorder($user_mobile,$order_id,$country->country_code);
                            Helpers::successrestuarantorder($restaurant->restaurant_mobile,$country->country_code);

                            Mail::to($restaurant->restaurant_email)->send(new RestuarantMail($order));

                        }

                        $ins2=array(
                            'noti_restaurant_id'=>$order_detail['restaurant_id'],
                            'noti_type'=>'1',
                            'noti_msg'=>'New order arrived. Order ID is '.$order_id,
                            'noti_status'=>'1',
                        );
                        $local_notification = local_notification_restaurant::create($ins2);

                        $removecart=cart_item::where('user_id',auth()->user()->id)->delete();

                        if(session()->has('amount') || session()->has('discounted_amount') || session()->has('coupon_code'))
                        {
                            session()->pull('amount');
                            session()->pull('discounted_amount');
                            session()->pull('coupon_code');
                            session()->pull('order_type');
                        }

                        $return = [
                            'status' => 200,
                            'message' => 'Success! Order placed successfully'
                        ];
                        return response()->json($return);
                }
                else
                {
                    $return = [
                        'status' => 404,
                        'message' => 'Warning! Something went wrong'
                    ];
                    return response()->json($return);
                }
            }
            else
            {
                
                $return = [
                    'status' => 401,
                    'order_id' => $order_id,
                    'restaurant_id' => $data['restaurant_id'],
                    'payment_type' => $data['payment_type'],
                    'order_type' => $data['order_type'],
                    'outlet_id' => $outlet_id,
                    'grand_total' => $grand_total,
                    'user_name'=>$user_name,
                    'user_mobile'=>$user_mobile,
                    'user_email'=>$user_email,
                    'pincode'=>$data['pincode'] ? $data['pincode'] : 'N/A',
                    'house_flat_no'=>$data['house_flat_no'] ? $data['house_flat_no'] : 'N/A',
                    'road_area_name'=>$data['road_area_name'] ? $data['road_area_name'] : 'N/A',
                    'gps_address'=>$data['gps_address'] ? $data['gps_address'] : 'N/A',
                    'gps_lat'=>$data['gps_lat'] ? $data['gps_lat'] : '0',
                    'gps_lng'=>$data['gps_lng'] ? $data['gps_lng'] : '0'
                ];
                return response()->json($return);
            }
        }
        else
        {
            $return = [
                'status' => 407,
                'message' => 'Restaurant is closed'
            ];
            return response()->json($return);
        }
    }

    public function order_mail()
    {
        return view('WEB.order-mail');
    }

    public function order_success()
    {
        return view('WEB.restaurant-order-success');
    }

    public function orderdetail($order_id)
    {
        $order_detail = order_detail::leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('restaurant_outlets','restaurant_outlets.outlet_id','order_details.outlet_id')->leftjoin('users','users.id','order_details.user_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->where('order_id',$order_id)->where('order_details.user_id',auth()->user()->id)->select('order_details.*','users.name','users.mobile','users.email','users.gps_address','order_details.outlet_id as ot_id','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email','restaurant_outlets.outlet_area','restaurant_outlets.outlet_gps_address','countries.country_currency')->with('order_items')->first();

        $order_menu_item = order_menu_item::leftjoin('categories','categories.cat_id','order_menu_items.cat_id')->leftjoin('restaurant_categories','restaurant_categories.restaurant_cat_id','order_menu_items.restaurant_cat_id')->select('order_menu_items.*','restaurant_categories.is_veg', 'categories.cat_name')->orderBy('order_menu_items.order_item_id', 'desc')->where('order_id',$order_id)->get();

        return view('WEB.order-detail',compact('order_detail','order_menu_item'));
    }

    public function cancel_order(Request $request)
    {
        if(order_detail::where('order_id',$request->order_id)->exists())
        {
            $order_detail = order_detail::where('order_id',$request->order_id)->first();

            order_detail::where('order_id',$request->order_id)->update(array('order_status'=>4,'cancel_date'=>date('Y-m-d H:i:s')));

            $ins=array(
                'noti_user_id'=>$order_detail->user_id,
                'noti_type'=>'1',
                'noti_msg'=>'Your order is cancelled. your Order ID is '.$request->order_id,
                'noti_status'=>'1',
            );
            $local_notification = local_notification_user::create($ins);

            if (restaurant::where('restaurant_id',$order_detail->restaurant_id)->exists()) 
            {
                $restaurant = restaurant::where('restaurant_id',$order_detail->restaurant_id)->first();
                $data = [
                    'title' => 'Orderpoz Restaurant',
                    'description' => 'User cancelled order. Order ID is '.$request->order_id,
                ];
                Helpers::send_to_device('restaurant',$restaurant->restaurant_device_id,$data);

                $ins1=array(
                    'noti_restaurant_id'=>$order_detail->restaurant_id,
                    'noti_type'=>'1',
                    'noti_msg'=>'User cancelled Order. Order ID is '.$request->order_id,
                    'noti_status'=>'1',
                );
                $local_notification = local_notification_restaurant::create($ins1);
            }

            return response()->json(200);
        }
        else
        {
            return response()->json(404);
        }
    }

    public function review_rating(Request $request)
    {
            $input = $request->all();
       
            $ins_d=array(
                'restaurant_id'=>$request->restaurant_id,
                'user_id'=>auth()->user()->id,
                'order_id'=>$request->order_id,
                'restaurant_review'=>$input['restaurant_review'] ? $input['restaurant_review'] : 'N/A',
                'restaurant_rate'=>$input['restaurant_rate'] ? $input['restaurant_rate'] : '0',
            );
            $restaurant_review = restaurant_review::create($ins_d);

            $restaurant_rate = restaurant_review::where('restaurant_id',$request->restaurant_id)->avg('restaurant_rate');

            $restaurant_up =restaurant::where('restaurant_id',$request->restaurant_id)->update([
                'total_rating' => $restaurant_rate,
            ]);

            if($restaurant_review)
            {
                return response()->json(200);
            }
            else
            {
                return response()->json(400);
            }
    }
}
