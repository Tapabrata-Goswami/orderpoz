<?php

namespace App\CPU;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Cassandra\Collection;
use App\Models\restaurant;
use App\Models\detail;
use App\Models\restaurant_category;
use App\Models\cart_item;
use App\Models\offline_cart;
use App\Models\restaurant_outlet;
use App\Models\restaurant_time_slot;
use App\Models\coupon;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Illuminate\Support\Str;

class CartManager
{
    public static function add_to_cart($request, $from_api = false)
    {
        
        $price = 0;

        $user = Helpers::get_customer($request);
        $restaurant_category = restaurant_category::find($request->restaurant_cat_id);
        $restaurant_outlet = restaurant_outlet::where('restaurant_id',$restaurant_category->restaurant_id)->where('is_main',1)->first();

        $day = Carbon::today()->format('l');
        if (restaurant_time_slot::where('restaurant_id',$restaurant_category->restaurant_id)->where('day',$day) ->where('from_time', '<=', date('H:i:s'))->where('to_time', '>=', date('H:i:s'))->exists()) 
        {

            if ($user == 'offline') 
            {
                if (session()->has('user_random_id')) 
                {
                    $user_random_id = session()->get('user_random_id');
                }
                else
                {
                    session()->put('user_random_id', Str::random(50));
                    $user_random_id = 'N/A';
                }

                if (offline_cart::where('restaurant_id',$restaurant_category['restaurant_id'])->where('random_id',$user_random_id)->exists()) 
                {
                    $cart = offline_cart::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'random_id' => $user_random_id])->first();
                    if (isset($cart) == false) 
                    {

                        $random_id = session()->get('user_random_id');

                        $cart = new offline_cart();
                        $cart['random_id'] = $random_id;
                        $cart['qty'] = 1;
                        $cart['menu_price'] = $restaurant_category->menu_price;
                        $cart['menu_title'] = $restaurant_category->menu_title;
                        $cart['restaurant_cat_id'] = $request->restaurant_cat_id;
                        $cart['menu_id'] = $restaurant_category->menu_id;
                        $cart['restaurant_id'] = $restaurant_category->restaurant_id;
                        $cart['outlet_id'] = $restaurant_outlet->outlet_id;
                        $cart['cat_id'] = $restaurant_category->cat_id;
                        $cart['menu_image'] = $restaurant_category->menu_image;
                        $cart['add_on_name'] = $request->add_on_name ? $request->add_on_name : 'N/A';
                        $cart->save();

                        session()->pull('amount');
                        session()->pull('discounted_amount');
                        session()->pull('coupon_code');
                    }
                    else
                    {
                        return [
                            'status' => 0,
                            'message' => 'Info! Item already added into cart!'
                        ];
                    }
                }
                else
                {
                    $cart = offline_cart::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'random_id' => $user_random_id])->first();
                    if (isset($cart) == false) 
                    {
                        $random_id = session()->get('user_random_id');
                        $remove=offline_cart::where('random_id',$user_random_id)->delete();

                        $cart = new offline_cart();
                        $cart['random_id'] = $random_id;
                        $cart['qty'] = 1;
                        $cart['menu_price'] = $restaurant_category->menu_price;
                        $cart['menu_title'] = $restaurant_category->menu_title;
                        $cart['restaurant_cat_id'] = $request->restaurant_cat_id;
                        $cart['menu_id'] = $restaurant_category->menu_id;
                        $cart['restaurant_id'] = $restaurant_category->restaurant_id;
                        $cart['outlet_id'] = $restaurant_outlet->outlet_id;
                        $cart['cat_id'] = $restaurant_category->cat_id;
                        $cart['menu_image'] = $restaurant_category->menu_image;
                        $cart['add_on_name'] = $request->add_on_name ? $request->add_on_name : 'N/A';
                        $cart->save();

                        session()->pull('amount');
                        session()->pull('discounted_amount');
                        session()->pull('coupon_code');
                    }
                    else
                    {
                        return [
                            'status' => 0,
                            'message' => 'Info! Item already added into cart!'
                        ];
                    }
                }
            } 
            else 
            {
                if (cart_item::where('restaurant_id',$restaurant_category['restaurant_id'])->where('user_id',$user->id)->exists()) 
                {
                    $cart = cart_item::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'user_id' => $user->id])->first();
                    if (isset($cart) == false) {
                        $cart = new cart_item();
                        $cart['user_id'] = $user->id ?? 0;
                        $cart['qty'] = 1;
                        $cart['menu_price'] = $restaurant_category->menu_price;
                        $cart['menu_title'] = $restaurant_category->menu_title;
                        $cart['restaurant_cat_id'] = $request->restaurant_cat_id;
                        $cart['menu_id'] = $restaurant_category->menu_id;
                        $cart['restaurant_id'] = $restaurant_category->restaurant_id;
                        $cart['outlet_id'] = $restaurant_outlet->outlet_id;
                        $cart['cat_id'] = $restaurant_category->cat_id;
                        $cart['menu_image'] = $restaurant_category->menu_image;
                        $cart['add_on_name'] = $request->add_on_name ? $request->add_on_name : 'N/A';
                        $cart->save();

                    } else {
                        return [
                            'status' => 0,
                            'message' => 'Info! Item already added into cart!'
                        ];
                    }
                }
                else
                {
                    $cart = cart_item::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'user_id' => $user->id])->first();
                    if (isset($cart) == false) {
                        $remove=cart_item::where('user_id',$user->id)->delete();

                        $cart = new cart_item();
                        $cart['user_id'] = $user->id ?? 0;
                        $cart['qty'] = 1;
                        $cart['menu_price'] = $restaurant_category->menu_price;
                        $cart['menu_title'] = $restaurant_category->menu_title;
                        $cart['restaurant_cat_id'] = $request->restaurant_cat_id;
                        $cart['menu_id'] = $restaurant_category->menu_id;
                        $cart['restaurant_id'] = $restaurant_category->restaurant_id;
                        $cart['outlet_id'] = $restaurant_outlet->outlet_id;
                        $cart['cat_id'] = $restaurant_category->cat_id;
                        $cart['menu_image'] = $restaurant_category->menu_image;
                        $cart['add_on_name'] = $request->add_on_name ? $request->add_on_name : 'N/A';
                        $cart->save();

                        session()->pull('amount');
                        session()->pull('discounted_amount');
                        session()->pull('coupon_code');

                    } else {
                        return [
                            'status' => 0,
                            'message' => 'Info! Item already added into cart!'
                        ];
                    }
                }
            }

            return [
                'status' => 1,
                'message' => 'Success! Item added into cart'
            ];
        }
        else
        {
            return [
                'status' => 2,
                'message' => 'Restaurant is closed'
            ];
        }
    }

    public static function get_cart()
    {
        $user = Helpers::get_customer();
        if ($user == 'offline') {
            $random_id = session()->get('user_random_id');
            $cart = offline_cart::where('random_id', $random_id)->get();
        }
        else
        {
            $cart = cart_item::where('user_id', $user->id)->get();
        }

        return $cart;
    }

    public static function update_cart_plus($request)
    {
        $user = Helpers::get_customer($request);
        if (session()->has('user_random_id') && $user == 'offline') 
        {
            $user_random_id = session()->get('user_random_id');
            
            offline_cart::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'random_id' => $user_random_id])->update(['qty'=>$request->qty+1]);

        } else {
            
            cart_item::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'user_id' => $user->id])->update(['qty'=>$request->qty+1]);

            session()->pull('amount');
        }

        return [
            'status' => 1,
            'qty' => $request->qty,
            'message' => 'Success! Item quantity updated!'
        ];
    }

    public static function update_cart_minus($request)
    {
        $user = Helpers::get_customer($request);
        if (session()->has('user_random_id') && $user == 'offline') 
        {
            $user_random_id = session()->get('user_random_id');
            
            offline_cart::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'random_id' => $user_random_id])->update(['qty'=>$request->qty-1]);

            if(offline_cart::where('restaurant_cat_id',$request->restaurant_cat_id)->where('random_id',$user_random_id)->where('qty','<=',0)->exists())
            {
                offline_cart::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'random_id' => $user_random_id])->delete();
            }

        } else {
            
            cart_item::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'user_id' => $user->id])->update(['qty'=>$request->qty-1]);

            if(cart_item::where('restaurant_cat_id',$request->restaurant_cat_id)->where('user_id',$user->id)->where('qty','<=',0)->exists())
            {
                cart_item::where(['restaurant_cat_id' => $request->restaurant_cat_id, 'user_id' => $user->id])->delete();
            }

            session()->pull('amount');
        }

        return [
            'status' => 1,
            'qty' => $request->qty,
            'message' => 'Success! Item quantity updated!'
        ];
    }

    public static function cart_to_db()
    {
        $user = Helpers::get_customer();
        if (session()->has('user_random_id')) {
            $user_random_id = session()->get('user_random_id');

            $cart = offline_cart::where('random_id',$user_random_id)->get();

            foreach ($cart as $item) 
            {
                $ins1=array(
                    'restaurant_cat_id'=>$item['restaurant_cat_id'] ? $item['restaurant_cat_id'] : '0',
                    'menu_price'=>$item['menu_price'] ? $item['menu_price'] : '0',
                    'qty'=>$item['qty'] ? $item['qty'] : '0',
                    'user_id'=>$user->id,
                    'menu_id'=>$item['menu_id'] ? $item['menu_id'] : 'N/A',
                    'restaurant_id'=>$item['restaurant_id'] ? $item['restaurant_id'] : 'N/A',
                    'outlet_id'=>$item['outlet_id'] ? $item['outlet_id'] : '0',
                    'cat_id'=>$item['cat_id'] ? $item['cat_id'] : 'N/A',
                    'menu_title'=>$item['menu_title'] ? $item['menu_title'] : 'N/A',
                    'menu_image'=>$item['menu_image'] ? $item['menu_image'] : 'N/A',
                    'add_on_name'=>$item['add_on_name'] ? $item['add_on_name'] : 'N/A',
                );

                cart_item::insert($ins1);
            }

            offline_cart::where('random_id',$user_random_id)->delete();
        }
    }

    public static function applycoupon($request, $from_api = false)
    {
        if(session()->has('amount') || session()->has('discounted_amount') || session()->has('coupon_code'))
        {
            return [
                'status' => 3,
                'message' => 'Warning! Coupon code already applied!'
            ];
        }
        else
        {
            $restaurant = restaurant::where('restaurant_name_code',$request->restaurant_name_code)->first();
            if (coupon::where('country_id',$restaurant->country_id)->where('coupon_code',$request->coupon_code)->where('coupon_validity','>=',Carbon::today())->exists()) 
            {
                // if ($request->order_type=='Pickup') 
                // {
                //     $shipping_charge = 0;
                // }
                // else
                // {
                //     $shipping_charge = $request->shipping_charge;
                // }

                $sub_total=0;
                $cart = cart_item::where('user_id',auth()->user()->id)->get();
                foreach($cart as $cartItem)
                {
                    $sub_total+=($cartItem['menu_price']*$cartItem['qty']);
                }

                $coupan=coupon::where('coupon_code',$request->coupon_code)->first();
                if ($coupan->coupon_type==0) 
                {
                    if ($sub_total<$coupan->amount_percent) 
                    {
                        return [
                            'status' => 4,
                            'message' => 'Error! Discount cant applied!'
                        ];
                    }

                    $discounted_amount = $coupan->amount_percent;
                    $amount = ($sub_total - $coupan->amount_percent);
                    
                }
                else
                {
                    $discounted_amount = ($sub_total * $coupan->amount_percent) / 100;
                    if ($sub_total<$discounted_amount) 
                    {
                        return [
                            'status' => 4,
                            'message' => 'Error! Discount cant applied!'
                        ];
                    }
                    
                    $amount = ($sub_total - $discounted_amount);

                }
                session()->put('amount',$amount);
                session()->put('discounted_amount',$discounted_amount);
                session()->put('coupon_code',$coupan->coupon_code);

                return [
                    'status' => 1,
                    'amount' => $amount,
                    'discounted_amount' => $discounted_amount,
                    'message' => 'Success! Coupon code applied!'
                ];
            } 
            else 
            {
                return [
                    'status' => 2,
                    'message' => 'Error! Invalid coupon code!'
                ];
            }
        }
    }

    public static function removecoupon($request, $from_api = false)
    {
        if(session()->has('amount') || session()->has('discounted_amount'))
        {
            session()->pull('amount');
            session()->pull('discounted_amount');
            session()->pull('coupon_code');
            return [
                'status' => 1,
                'message' => 'Success! Remove applied coupon code!'
            ];
        }
        else
        {
            return [
                'status' => 2,
                'message' => 'Error! Coupon code not applied!'
            ];
        }
       
    }
    
}