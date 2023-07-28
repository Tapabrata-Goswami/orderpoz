<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CPU\CartManager;
use Brian2694\Toastr\Facades\Toastr;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = CartManager::add_to_cart($request);
        return response()->json($cart);
    }

    public function updateNavCart(Request $request)
    {
        $restaurant_name_code=$request->restaurant_name_code;
        $checkout=0;
        $cart = CartManager::get_cart();
        return response()->json(['data' => view('WEB.partial-pages.cart-items',compact('restaurant_name_code','checkout','cart'))->render()]);
    }

    public function updateNavCheckout(Request $request)
    {
        $restaurant_name_code=$request->restaurant_name_code;
        return response()->json(['data' => view('WEB.partial-pages.checkout-page',compact('restaurant_name_code'))->render()]);
    }

    public function updateQuantityPlus(Request $request)
    {
        $cart = CartManager::update_cart_plus($request);
        return response()->json($cart);
    }

    public function updateQuantityMinus(Request $request)
    {
        $cart = CartManager::update_cart_minus($request);
        return response()->json($cart);
    }

    public function apply_coupon(Request $request)
    {
        $cart = CartManager::applycoupon($request);
        return response()->json($cart);
    }

    public function remove_coupon(Request $request)
    {
        $cart = CartManager::removecoupon($request);
        return response()->json($cart);
    }
}
