<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\CPU\Helpers;
use Carbon\Carbon;
use App\CPU\CartManager;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\cart_item;
use App\Models\order_detail;
use App\Models\order_menu_item;
use App\Models\restaurant;
use App\Models\local_notification_restaurant;
use App\Models\local_notification_user;
use App\Models\restaurant_outlet;
use App\Models\restaurant_time_slot;
use App\Models\restaurant_review;

class StripePaymentController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function index()
    {
        return view('payment');
    }

    public function strippayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => Helpers::error_processor($validator)]);     
        }

        $data = $request->all();

        $token = $this->createToken($request);
        if (!empty($token['error'])) {
            $return = [
                'status' => 400,
                'message' => $token['error']
            ];
            return response()->json($return);
        }
        if (empty($token['id'])) {

            $return = [
                'status' => 404,
                'message' => 'Error! Payment failed.'
            ];
            return response()->json($return);
        }

        $secret_key = restaurant::where('restaurant_id',$data['restaurant_id'])->first()->secret_key;
        $charge = $this->createCharge($token['id'], 100,$secret_key);
        if (!empty($charge) && $charge['status'] == 'succeeded') {

            $sub_total=0;
            $cart = cart_item::where('user_id',auth()->user()->id)->get();
            foreach($cart as $cartItem)
            {
                $sub_total+=($cartItem['menu_price']*$cartItem['qty']);
            }

            if(session()->has('coupon_code'))
            {
                $promocode=session()->get('coupon_code');
            }
            else
            {
                $promocode='N/A';
            }

            if (session()->has('discounted_amount')) 
            {
                $discount = session()->get('discounted_amount');
            }
            else
            {
                $discount = 0;
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

            $ins=array(
                'order_id'=>$data['order_id'],
                'user_id'=>auth()->user()->id,
                'restaurant_id'=>$data['restaurant_id'] ? $data['restaurant_id'] : '0',
                'outlet_id'=>$data['outlet_id'],
                'payment_type'=>$data['payment_type'] ? $data['payment_type'] : 'N/A',
                'basic_amount'=>$sub_total,
                'coupon_code'=>$promocode,
                'coupon_amount'=>$discount,
                'shipping_charge'=>$shipping_charge,
                'order_type'=>$data['order_type'] ? $data['order_type'] : 'N/A',
                'grand_total'=>$grand_total,
                'user_name'=>$data['user_name'] ? $data['user_name'] : 'N/A',
                'user_mobile'=>$data['user_mobile'] ? $data['user_mobile'] : 'N/A',
                'user_email'=>$data['user_email'] ? $data['user_email'] : 'N/A',
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
                        'order_id'=>$data['order_id'],
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
                            'description' => 'New order arrived. Order id is '.$data['order_id'],
                        ];
                        Helpers::send_to_device('restaurant',$restaurant->restaurant_device_id,$data);
                    }

                    $ins2=array(
                        'noti_restaurant_id'=>$order_detail['restaurant_id'],
                        'noti_type'=>'1',
                        'noti_msg'=>'New order arrived. Order id is '.$data['order_id'],
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
            }

                $return = [
                    'status' => 200,
                    'message' => 'Success! Order placed.'
                ];
                return response()->json($return);

        } else {
            $request->session()->flash('danger', 'Payment failed.');
            $return = [
                'status' => 404,
                'message' => 'Error! Payment failed.'
            ];
            return response()->json($return);
        }
    }

    private function createToken($cardData)
    {
        $token = null;
        $secret_key = restaurant::where('restaurant_id',$cardData['restaurant_id'])->first()->secret_key;
        $stripe = new StripeClient($secret_key);
        try {
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount,$secret_key)
    {
        $charge = null;
        $stripe = new StripeClient($secret_key);
        try {
            $charge = $stripe->charges->create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
}
