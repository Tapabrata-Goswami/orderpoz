<style>
.cop::before {
    position: absolute;
    content: "";
    height: 40px;
    left: -20px;
    border-radius: 40px;
    z-index: 1;
    top: 70px;
    background-color: #EF3F3E;
    width: 40px;
}
.cop::after {
    position: absolute;
    content: "";
    height: 40px;
    right: -20px;
    border-radius: 40px;
    z-index: 1;
    top: 70px;
    background-color: #EF3F3E;
    width: 40px;
}
    </style>
<form method="post" enctype="multipart/form-data" class="checkoutform">
@csrf

@php($restaurant=App\Models\restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->where('restaurant_name_code',$restaurant_name_code)->first())
<input type="hidden" class="form-control" id="restaurant_id" value="{{$restaurant->restaurant_id}}" name="restaurant_id" id="user_name">

<div class="checkout-box">
    <h4 class="title">order type:</h4>
    <div class="review-section">
        <div class="review_box">
            <div class="flight_detail">
                <div class="promo-section">
                    <div class="promos">
                            <div class="row col-4">
                                @if($restaurant->delivery_type=='Both' || $restaurant->delivery_type=='Delivery')
                                <div class="form-check col-6" style="padding-left: 3.5em;">
                                    <input class="form-check-input radio_animated" type="radio" name="order_type" id="exampleRadios4" value="Delivery" onclick="ordertype('Delivery','{{$restaurant_name_code}}')" @if(session()->has('order_type')) @if(session()->get('order_type')=='Delivery') checked @endif  @endif>
                                    <div>
                                        <label class="form-check-label title" for="exampleRadios4">
                                            Delivery
                                        </label>
                                    </div>
                                </div>
                                @endif
                                @if($restaurant->delivery_type=='Both' || $restaurant->delivery_type=='Pickup')
                                <div class="form-check col-6" style="margin-top: 0px;@if($restaurant->delivery_type=='Pickup')padding-left: 3.5em;@endif">
                                    <input class="form-check-input radio_animated" type="radio" name="order_type" id="exampleRadios3" value="Pickup" onclick="ordertype('Pickup','{{$restaurant_name_code}}')" @if(session()->has('order_type')) @if(session()->get('order_type')=='Pickup') checked @endif @endif>
                                    <div>
                                        <label class="form-check-label title" for="exampleRadios3">
                                            Pickup
                                        </label>
                                    </div>
                                </div>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php($add=App\Models\order_detail::where('user_id',auth()->user()->id)->where('order_type','Delivery')->first())
@php($charge=App\Models\restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->where('restaurant_name_code',$restaurant_name_code)->first())
<div class="checkout-box" id="delivery-div" @if(session()->has('order_type')) @if(session()->get('order_type')=='Pickup') style="display:none;" @endif @else style="display:none;" @endif>
    <h4 class="title">delivery address:</h4>
    <div class="review-section">
        <div class="review_box">
            <div class="flight_detail payment-gateway">
                <div class="accordion" >
                    <div class="card">
                        <div  class="collapse show">
                            <div class="card-body" style="border-top: 0px">
                                
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="name">User Name</label>
                                            <input type="text" class="form-control" name="user_name" id="user_name" value="@if($add){{$add->user_name}}@endif" placeholder="Enter User Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="number">User Mobile No.</label>
                                            <input type="text" class="form-control" id="user_mobile" name="user_mobile" value="@if($add){{$add->user_mobile}}@endif" placeholder="Enter User Mobile No.">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">User Email</label>
                                            <input type="email" class="form-control" id="user_email" name="user_email" value="@if($add){{$add->user_email}}@endif" placeholder="Enter User Email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="address">GPS Address</label>
                                            <input type="text" class="form-control" id="gps_address" name="gps_address" value="@if($add){{$add->gps_address}}@endif">
                                            <input type="hidden" class="form-control" id="gps_lat" name="gps_lat" value="@if($add){{$add->gps_lat}}@endif">
                                            <input type="hidden" class="form-control" id="gps_lng" name="gps_lng" value="@if($add){{$add->gps_lng}}@endif">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">House/Flat No.</label>
                                            <input type="text" class="form-control" id="house_flat_no" name="house_flat_no" value="@if($add){{$add->house_flat_no}}@endif" placeholder="Enter House/Flat No.">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="area">Road/Area Name</label>
                                            <input type="text" class="form-control" id="road_area_name" name="road_area_name" value="@if($add){{$add->road_area_name}}@endif" placeholder="Enter Road/Area Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="area">Pincode</label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" value="@if($add){{$add->pincode}}@endif" placeholder="Enter Pincode">
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="small-section dashboard-section bg-inner" data-sticky_parent="" style="padding-top:20px;padding-bottom: 20px;position: unset;@if(session()->has('order_type')) @if(session()->get('order_type')=='Delivery') display:none @endif @else display:none @endif" id="pickup-div" >
        <div class="faq-content tab-content" id="top-tabContent" style="min-height: auto;">
            <div class="tab-pane fade active show" id="bookings">
                <div class="dashboard-box">
                    <div class="dashboard-title">
                        <h4>Outlets:</h4>
                    </div>
                    @php($outlets=App\Models\restaurant_outlet::leftjoin('restaurants','restaurants.restaurant_id','restaurant_outlets.restaurant_id')->where('restaurants.restaurant_name_code',$restaurant_name_code)->where('restaurant_outlets.outlet_status',1)->orderby('outlet_id','ASC')->get())
                    @if($outlets->count()>1) @php($ck='')
                    @else @php($ck='checked') @endif
                    @foreach($outlets as $outlet)
                    <div class="dashboard-detail">
                        <div class="booking-box">
                            <div class="detail-middle" style="width: 92%;">
                                <div class="media row col-12">
                                    <div class="col-8">
                                        <p>address:</p>
                                        <h6 class="media-heading"><b>{{$outlet->outlet_gps_address}}</b></h6>
                                    </div>
                                    <div class="col-4">
                                        <p>area:</p>
                                        <h6 class="media-heading"><b>{{$outlet->outlet_area}}</b></h6>
                                    </div>
                                    {{--<!-- <div class="col-2">
                                        <p>city:</p>
                                        <h6 class="media-heading"><b>{{$outlet->outlet_city}}</b></h6>
                                    </div>
                                    <div class="col-2">
                                        <p>city:</p>
                                        <h6 class="media-heading"><b>{{$outlet->outlet_state}}</b></h6>
                                    </div> -->--}}
                                </div>
                            </div>
                            
                            <div class="detail-last bottom radio" style="@if($outlets->count()<2) display:none @endif">
                                <!-- <span class="badge bg-info">upcoming</span> -->
                                <input type="radio" id="outlet_id" label="Select" name="outlet_id" value="{{$outlet->outlet_id}}" class="bottom_btn" {{$ck}}/>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</section>

<div class="checkout-box" style="margin-top: 10px;">
    <h4 class="title">apply coupon:</h4>
    <div class="review-section">
        <div class="review_box">
            <div class="review_box">
                <div class="flight_detail">
                    <div class="promo-section">
                        <div class="form-group mb-0">
                            <label>Don't have a coupon code? <a href="" data-bs-toggle="modal" data-bs-target="#delete-account">Get Code.</a></label>
                            <div class="input-group">
                                @php($charge=App\Models\restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->where('restaurant_name_code',$restaurant_name_code)->first())
                                <input type="hidden" class="form-control" id="shipping_charge" name="shipping_charge" value="{{$charge->shipping_charge}}">
                                <input type="hidden" class="form-control" id="country_currency" name="country_currency" value="{{$charge->country_currency}}">

                                <input type="text" class="form-control" placeholder="Enter Promo Code" id="coupon_code" name="coupon_code" value="@if(session()->has('coupon_code')) {{session()->get('coupon_code')}} @endif">
                                <div class="input-group-prepend">
                                

                                    <button class="input-group-text coupon_app" name="submit-ccamt" type="button" onclick="apply('{{$restaurant_name_code}}')" style="@if(session()->has('coupon_code')) display:none; @else display:block ; @endif">Apply</button>
                                    <button class="input-group-text coupon_rem" name="submit-ccamt" type="button" onclick="coupon_remove('{{$restaurant_name_code}}')" style="@if(session()->has('coupon_code')) display:block; @else display:none ; @endif">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="checkout-box">
    <h4 class="title">payment:</h4>
    <div class="review-section">
        <div class="review_box">
            <div class="flight_detail">
                <div class="promo-section">
                    <div class="promos">
                        <div class="row col-4">
                            <div class="form-check col-6" style="padding-left: 3.5em;">
                                <input class="form-check-input radio_animated" type="radio" name="payment_type" id="exampleRadios5" value="Cash" onclick="paymenttype('Cash')">
                                <div>
                                    <label class="form-check-label title" for="exampleRadios5">
                                        Cash
                                    </label>
                                </div>
                            </div>
                            <div class="form-check col-6" style="margin-top: 0px;">
                                <input class="form-check-input radio_animated" type="radio" name="payment_type" id="exampleRadios6" value="Online" onclick="paymenttype('Online')">
                                <div>
                                    <label class="form-check-label title" for="exampleRadios6">
                                        Online
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="wallet-section">
                            <div class="payment-btn">
                                <button onclick="checkout('{{$restaurant_name_code}}')" type="button" class="btn btn-solid color1" style="width:100%;">Place Order</button>
                                <!-- <button data-bs-toggle="modal" data-bs-target="#payment" type="button" class="btn btn-solid color1 online_order" style="width:100%;display:none;">Place Order</button> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add card modal start -->
<div class="modal fade edit-profile-modal" id="delete-account" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Coupons</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            @if(App\Models\coupon::where('country_id',$restaurant->country_id)->where('coupon_validity','>=',Carbon\Carbon::today())->where('coupon_status',1)->exists())
            <div class="modal-body" style="background: #EF3F3E;">
                <div class="promos">
                @php($coupons= App\Models\coupon::where('country_id',$restaurant->country_id)->where('coupon_validity','>=',Carbon\Carbon::today())->where('coupon_status',1)->get())
                @foreach($coupons as $coupon)
                    <div class="cop" style="height: 155px;border-radius: 5px;box-shadow: 0 4px 6px 0 rgb(0 0 0 / 20%);background-color: #fff;padding: 10px 10px;position: relative;margin-bottom: 10px;">
                        <div class="main" style="display: flex;justify-content: space-between;padding: 0 10px;align-items: center;">
                        <div class="co-img">
                            <img src="{{asset('image')}}/{{$coupon->coupon_image}}" alt="" style="width: 80px;height: 70px;">
                        </div>
                        <div class="vertical" style="border-left: 5px dotted black;height: 75px;position: absolute;left: 32%;"></div>
                        <div class="content" style="width: 55%;">
                            <h2 style="font-size: 15px;margin-left: -20px;color: #565656;text-transform: uppercase;">{{$coupon->coupon_title}}</h2>
                            <h1 style="font-size: 20px;margin-left: -20px;color: #565656;">{{$coupon->amount_percent}}@if($coupon->coupon_type==0){{$restaurant->country_currency}}@else%@endif <span style="font-size: 18px;">@if($coupon->coupon_type==0) Flat @else Off @endif</span></h1>
                            <p style="font-size: 16px;color: #696969;margin-left: -20px;">Valid till {{ \Carbon\Carbon::parse( $coupon->coupon_validity )->format('d F Y')}}</p>
                        </div>
                        </div>
                        <div class="copy-button" style="margin: 12px 20px -5px 20px;height: 45px;border-radius: 4px;padding: 0 5px;border: 1px solid #e1e1e1;display: flex;justify-content: space-between;align-items: center;">
                        <input id="copyvalue{{$coupon->coupon_id}}" type="text" readonly="" value="{{$coupon->coupon_code}}" style="width: 100%;height: 100%;border: none;outline: none;font-size: 15px;">
                        <button onclick="copyIt({{$coupon->coupon_id}})" class="copybtn" style="padding: 5px 20px;background-color: #EF3F3E;color: #fff;border: 1px solid transparent;">COPIED</button>
                        </div>
                    </div>
                    
                @endforeach
                </div>
            </div>
            @else
            <div class="modal-body" style="text-align: center;">
                <img src="{{asset('front-end/assets')}}/images/no-result.png" style="width:40%;">
            </div>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade edit-profile-modal" id="payment" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="error_div">
                @foreach (['danger', 'success'] as $status)
                    @if(Session::has($status))
                        <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                    @endif
                @endforeach
                </div>
                <form role="form" method="POST" class="onlinecheckoutform" id="paymentForm">
                    @csrf

                    <div class="form-group">
                        <label for="username">Full name (on the card)</label>
                        <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="cardNumber">Card number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="cardNumber" placeholder="Card Number">
                            <div class="input-group-append">
                                <span class="input-group-text text-muted">
                                <i class="fab fa-cc-visa fa-lg" style="padding-right: 1px;"></i>
                                <i class="fab fa-cc-amex fa-lg" style="padding-right: 1px;"></i>
                                <i class="fab fa-cc-mastercard fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label><span class="hidden-xs">Expiration</span> </label>
                                <div class="input-group">
                                    <select class="form-control" name="month">
                                        <option value="">MM</option>
                                        @foreach(range(1, 12) as $month)
                                            <option value="{{$month}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control" name="year">
                                        <option value="">YYYY</option>
                                        @foreach(range(date('Y'), date('Y') + 10) as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label data-toggle="tooltip" title=""
                                    data-original-title="3 digits code on back side of the card">CVV <i
                                    class="fa fa-question-circle"></i></label>
                                <input type="number" class="form-control" placeholder="CVV" name="cvv">

                                <input type="hidden" class="form-control restaurant_id" value="" name="restaurant_id">
                                <input type="hidden" class="form-control grand_total" value="" name="grand_total">
                                <input type="hidden" class="form-control order_type" value="" name="order_type">
                                <input type="hidden" class="form-control payment_type" value="" name="payment_type">
                                <input type="hidden" class="form-control user_name" value="" name="user_name">
                                <input type="hidden" class="form-control user_mobile" value="" name="user_mobile">
                                <input type="hidden" class="form-control user_email" value="" name="user_email">
                                <input type="hidden" class="form-control pincode" value="" name="pincode">
                                <input type="hidden" class="form-control house_flat_no" value="" name="house_flat_no">
                                <input type="hidden" class="form-control road_area_name" value="" name="road_area_name">
                                <input type="hidden" class="form-control order_id" value="" name="order_id">
                                <input type="hidden" class="form-control outlet_id" value="" name="outlet_id">
                                <input type="hidden" class="form-control gps_address" value="" name="gps_address">
                                <input type="hidden" class="form-control gps_lat" value="" name="gps_lat">
                                <input type="hidden" class="form-control gps_lng" value="" name="gps_lng">
                            </div>
                        </div>
                    </div>
                    
                        <button class="btn btn-solid color1" onclick="onlinecheckout()" type="button">Pay Now({{$charge->country_currency}}<span class="payamt"></span>)</button>
                       
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>
