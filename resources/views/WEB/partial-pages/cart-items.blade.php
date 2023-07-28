<!-- <div class="sticky-cls-top"> -->
    <!-- <div class="single-sidebar order-cart-right"> -->
<script>
    $(".back-btn").click(function () {
        $('.order-cart-right').css("right", "-310px");
    });
    </script>
        <div class="back-btn">
        back
        </div>
        <div class="order-cart">
        <h4 class="title">cart items:</h4>
            @php($sub_total=0)
            @php($charge=App\Models\restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->where('restaurant_name_code',$restaurant_name_code)->first())

            <div class="cart-items">
                @if($cart->count() > 0)
                    @foreach($cart as $cartItem)
                    @php ($veg = App\Models\restaurant_category::where('restaurant_cat_id',$cartItem->restaurant_cat_id)->first())
                    <form id="quantity{{$cartItem['restaurant_cat_id']}}" class="mb-2">
                    <input type="hidden" name="restaurant_cat_id" value="{{$cartItem['restaurant_cat_id']}}">
                    <div class="items @if($veg['is_veg']=='0') non-veg @else veg @endif" style="padding-top: 5px;">
                        <h6>{{$cartItem['menu_title']}}</h6>
                        <h5>{{$charge->country_currency}}{{$cartItem['menu_price']}}</h5>
                        <div class="qty-box cart_qty">
                            <div class="input-group">
                                <button type="button" class="btn qty-left-minus" data-type="minus"
                                data-field="" tabindex="0" onclick="CartQuantityminus({{$cartItem['restaurant_cat_id']}},'{{$restaurant_name_code}}')">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="text" name="qty" class="form-control input-number qty-input" value="{{$cartItem['qty']}}" tabindex="0" readonly style="background: white;">
                                <button type="button" class="btn qty-right-plus update-cart" data-type="plus"
                                data-field="" tabindex="0" onclick="CartQuantityplus({{$cartItem['restaurant_cat_id']}},'{{$restaurant_name_code}}')">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="price">
                            <span>{{$charge->country_currency}}{{$cartItem['menu_price']*$cartItem['qty']}}</span>
                        </div>
                    </div>
                    </form>
                    @php($sub_total+=($cartItem['menu_price']*$cartItem['qty']))
                    @endforeach
                    @if(session()->has('coupon_code'))
                        @if(session()->has('amount'))
                        @else
                            @php(session()->put('amount',$sub_total-session()->get('discounted_amount')))
                        @endif
                    @endif
                @else
                <style>
                    .single-section .single-sidebar .order-cart .cart-items {
                            overflow-y: hidden;
                        }
                    </style>
                    <div style="margin: 85px 20px;text-align:center;"><img src="{{asset('front-end/assets')}}/images/cart-empty.png" style="width: 100%;"></div>
                @endif
                    @php($d_charge=0)
                    @if(session()->has('order_type'))
                        @if(session()->get('order_type')=='Pickup')
                            @php($d_charge=0)
                        @else
                            @php($d_charge=$charge->shipping_charge)
                        @endif
                    @else
                        @php($d_charge=0)
                    @endif
            </div>
            <div class="cart-bottom">
                <h6 class="sub-total">subtotal
                    <span>{{$sub_total}}</span><span>{{$charge->country_currency}}</span>
                </h6>
                <h6 class="sub-total">delivery charge
                    <span id="del_charge">@if(empty($cart->count()))0 @else{{$d_charge}}@endif</span><span>{{$charge->country_currency}}</span>
                </h6>
                <h6 class="sub-total">Discount
                    <span id="dis">@if(session()->has('discounted_amount')) {{session()->get('discounted_amount')}} @else 0 @endif</span><span>{{$charge->country_currency}}</span>
                </h6>
                <h6 class="grand-total sub-total">total
                    <span id="tot">@if(empty($cart->count())) 0 @else @if(session()->has('amount')) {{session()->get('amount') + $d_charge}} @else {{$sub_total + $d_charge}} @endif @endif</span><span>{{$charge->country_currency}}</span>

                </h6>

                {{-- @if($checkout==0)
                <div class="checkout">
                    <a href="{{url('restaurant-checkout')}}/{{$restaurant_name_code}}" class="btn btn-solid w-100">place order</a>
                </div>
                @endif --}}
            </div>
        </div>
    <!-- </div>
    <div class="single-sidebar p-0">
        <div class="newsletter-sec">
        <div>
            <h4 class="title">always first</h4>
            <p>Be the first to find out latest deals and exclusive offers and get 15% off your
            first order.</p>
            <form>
            <input type="email" id="email1" class="form-control"
                placeholder="Enter your email">
            <div class="button">
                <a href="#" class="btn btn-solid ">be the first</a>
            </div>
            </form>
        </div>
        </div>
    </div> -->
<!-- </div> -->