@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))
@push('css_or_js')
<style>

.radio {
	border-radius: 3px;
	position: relative;
}

.radio input {
	width: auto;
	height: 100%;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	outline: none;
	cursor: pointer;
	border-radius: 2px;
	padding: 4px 8px;
	background: #EF3F3E;
	color: #ffffff;
	font-size: 14px;
	font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
		"Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji",
		"Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
	transition: all 100ms linear;
}

.radio input:checked {
	background: #8AC642;
	color: #fff;
	box-shadow: 0 1px 1px #0000002e;
	text-shadow: 0 1px 0px #79485f7a;
}

.radio input:before {
	content: attr(label);
	display: inline-block;
	text-align: center;
	width: 100%;
}
.checkout-process .checkout-box .address-sec .select-box.active .address-box {
    border: 1px solid #dddddd;
}
.sticky-cls-top {
    position: sticky;
    z-index: 11000000000;
    top: 22px;
}
</style>
@endpush
@section('content')

    <!-- breadcrumb start -->
    <section class="breadcrumb-section order-food-section pt-0">
      
    <img src="{{asset('image')}}/{{$restaurant->restaurant_image}}" class="bg-img img-fluid blur-up lazyload" alt="">
    <div class="breadcrumb-content restaurant-name">
      <div>
        
        <div class="rest-order-content">
          <div>
             {{-- <img src="{{asset('image')}}/{{$restaurant->restaurant_image}}" class="img-fluid blur-up lazyload" alt=""> --}}
            <h3>{{$restaurant->restaurant_name}}</h3>
            {{--<h6>{{$cat_name}}</h6>--}}
            <ul>
              <li><td>Rating ({{$restaurant->total_rating}})</td><td class="rating">
                    @foreach(range(1,5) as $i)
                        @if($restaurant->total_rating >0)
                            @if($restaurant->total_rating >0.9)
                                <i class="fas fa-star" style="color: gold;"></i>
                            @elseif($restaurant->total_rating >0.2 && $restaurant->total_rating < 0.9)
                                <i class="fas fa-star-half-alt" style="color: gold;"></i>
                            @endif
                        @endif
                        @php $restaurant->total_rating--; @endphp
                    @endforeach
                  </td> </li>
              <!-- <li>30 mins</li>
              <li>$25 for 2</li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- breadcrumb end -->


    <!-- section start -->
    <section class="single-section small-section bg-inner">
        <div class="container" data-sticky_parent>
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="checkout-process checkout_process">
                        @include('WEB.partial-pages.'.$url,['restaurant_name_code'=>$restaurant->restaurant_name_code])
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                  <div class="sticky-cls-top">
                    <div class="single-sidebar order-cart-right cart_items">
                    @include('WEB.partial-pages.cart-items',['restaurant_name_code'=>$restaurant->restaurant_name_code,'checkout'=>1,'cart'=>$cart])
                    </div>
                    {{-- <div class="single-sidebar p-0" style="margin-top: 0px;">
                      <div class="newsletter-sec">
                        <div class="checkout">
                            <a href="{{url('restaurant-checkout')}}/{{$restaurant->restaurant_name_code}}" class="btn btn-solid w-100">place order</a>
                        </div>
                      </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <!-- cart mobile -->
    <div class="cart">
      <a href="javascript:void(0)"><i class="fas fa-shopping-cart"></i></a>
    </div>
    <!-- cart mobile -->
    @endsection
    @push('script')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&libraries=places&country=ind"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', function () {
    //alert("sdfsdfsdf");
    var places = new google.maps.places.Autocomplete(document.getElementById('address'));
    google.maps.event.addListener(places, 'place_changed', function () {
      var place = places.getPlace();
      var address = place.formatted_address;
      var latitude = place.geometry.location.lat();
      var longitude = place.geometry.location.lng();

      document.getElementById("lat").value = latitude;
      document.getElementById("lng").value = longitude;

    });
  });

  // $(document).ready(function() {
  //   $('.checkout').hide();
  //   });

    var input = document.getElementById('gps_address');
    var options = {
      types: ['address'],
      // componentRestrictions: {
      //   country: 'in'
      // }
    };
    autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var place = autocomplete.getPlace();
      for (var i = 0; i < place.address_components.length; i++) {
        for (var j = 0; j < place.address_components[i].types.length; j++) {
          if (place.address_components[i].types[j] == "postal_code") {
            var code = place.address_components[i].long_name;
          }
          if (place.address_components[i].types[j] == "locality") {
            var city = place.address_components[i].long_name;
          }
        }
      }
      var address = place.formatted_address;
      var latitude = place.geometry.location.lat();
      var longitude = place.geometry.location.lng();
      document.getElementById("gps_lat").value = latitude;
      document.getElementById("gps_lng").value = longitude;
      document.getElementById("pincode").value = code;
    });

  function ordertype(type,restaurant_name_code)
  {
    if(type=='Pickup')
    {
      $('#pickup-div').show();
      $('#delivery-div').hide();
    }
    else
    {
      $('#pickup-div').hide();
      $('#delivery-div').show();
    }

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
            url: '{{ route('order-type-session') }}',
            data: {type:type},
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (response) {
              console.log(response);
              updateNavCart(restaurant_name_code);
            },
            complete: function () {
                $('#loading').hide();
            }
        });
  }

  function paymenttype(type)
  {
    if(type=='Cash')
    {
      $('.cash_order').show();
      $('.online_order').hide();
    }
    else
    {
      $('.cash_order').hide();
      $('.online_order').show();
    }
  }

  let copybtn = document.querySelector(".copybtn");


function copyIt(coupon_id){
  let copyInput = document.querySelector('#copyvalue'+coupon_id);

  copyInput.select();

  document.execCommand("copy");

  copybtn.textContent = "COPIED";
}

function onlinecheckout(restaurant_name_code)
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
            url: '{{ route('strippayment') }}',
            data: $('.onlinecheckoutform').serializeArray(),
            beforeSend: function () {
            $('#loading').show();
            },
            success: function (response) {
            console.log(response);
            if (response.errors) {
                for (var i = 0; i < response.errors.length; i++) {
                    toastr.error(response.errors[i].message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            }
            else if (response.status == 200) {
                toastr.success(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                window.location = "{{route('restaurant-order-success')}}";
                return false;
            }
            else if (response.status == 404) {
                toastr.warning(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                $('#payment').modal('hide');
                return false;
            }
            else if (response.status == 400) {
                toastr.error(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else
            {
              toastr.error(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            },
            error: function(xhr, status, error) {
              toastr.error(xhr.responseJSON.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
                // console.log(xhr);
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }
  </script>

@endpush
