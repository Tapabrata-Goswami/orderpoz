<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ORDERPOZ">
    <meta name="keywords" content="ORDERPOZ">
    <meta name="author" content="ORDERPOZ">
    <link rel="icon" href="{{asset('front-end/assets')}}/images/icon/footer-logo.png" type="image/x-icon" />
    <title>@yield('title')</title>

    <!--Google font-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Vampiro+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/css/font-awesome.css">

    <!-- Animation -->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/css/animate.css">

    <!-- price range css -->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/css/price-range.css">

    <!-- magnific css -->
    <link rel="stylesheet" href="{{asset('front-end/assets')}}/css/magnific-popup.css">

    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/css/datepicker.min.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/css/slick-theme.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/css/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets')}}/css/color1.css">
    <link rel="stylesheet" href="{{asset('back-end/assets/back-end')}}/css/toastr.css">
    
    @stack('css_or_js')

    {{--dont touch this--}}
    <meta name="_token" content="{{csrf_token()}}">
    {{--dont touch this--}}
</head>

<body onload="init()">

    @include('WEB.partials.header')
	{{--loader--}}
    <!-- pre-loader start -->
    <div class="loader-wrapper food-loader">
        <div class="loader">
            <img src="{{asset('front-end/assets')}}/images/loader/food.gif" alt="loader">
        </div>
    </div>

    <!-- <div>
        <div id="loading" style="display:none">
            <img src="{{asset('front-end/assets')}}/images/loader/food1.gif" alt="loader">
        </div>
    </div> -->

    <div class="container">
		<div class="row">
			<div class="col-12" style="width:85%;position: fixed;z-index: 9999;display: flex;align-items: center;justify-content: center;margin-top:100px;">
				<div id="loading" style="display: none">
					<img width="300"
						src="{{asset('front-end/assets')}}/images/loader/food2.gif">
				</div>
			</div>
		</div>
	</div>
    <!-- pre-loader end -->
    {{--loader--}}
	@yield('content')
	@include('WEB.partials.footer')
    <!-- cart customized modal -->
    <div class="modal fade customized" id="customized" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Veg Cheese Quesadillas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="size-option">
                        <div class="item">
                            <h5>Size</h5>
                            <form>
                                <div class="form-check">
                                    <input class="form-check-input radio_animated" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        15 Cm [6 Inches]
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input radio_animated" type="radio" name="exampleRadios"
                                        id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        30 Cm [12 Inches]
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="item">
                            <h5>Extra Toppings</h5>
                            <form>
                                <div class="form-check">
                                    <input class="form-check-input checkbox_animated" type="text"
                                        name="exampleRadios" id="cheese" value="cheese" checked>
                                    <label class="form-check-label" for="cheese">
                                        extra cheese ($2)
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn add__button btn-solid">add to cart</button>
                </div>
            </div>
        </div>
    </div>
    <!-- cart customized modal -->
    <!-- tap to top -->
    <div class="tap-top">
        <div>
            <i class="fas fa-angle-up"></i>
        </div>
    </div>
    <!-- tap to top end -->


    <!-- setting start -->
    <!-- <div class="theme-setting">
        <div class="dark">
            <input class="tgl tgl-skewed" id="dark" type="checkbox">
            <label class="tgl-btn" data-tg-off="Dark" data-tg-on="Light" for="dark"></label>
        </div>
        <div class="rtl">
            <input class="tgl tgl-skewed" id="rtl" type="checkbox">
            <label class="tgl-btn" data-tg-off="RTL" data-tg-on="LTR" for="rtl"></label>
        </div>
    </div> -->
    <!-- setting end -->

    <!-- latest jquery-->
    <script src="{{asset('front-end/assets')}}/js/jquery-3.5.1.min.js"></script>

    <!-- zoom gallery js -->
    <script src="{{asset('front-end/assets')}}/js/jquery.magnific-popup.js"></script>
    <script src="{{asset('front-end/assets')}}/js/zoom-gallery.js"></script>

    <!-- filter js -->
    <script src="{{asset('front-end/assets')}}/js/filter.js"></script>
    <script src="{{asset('front-end/assets')}}/js/isotope.min.js"></script>

    <!-- jarallax effect js -->
    <script src="{{asset('front-end/assets')}}/js/jarallax-min-0.2.1.js"></script>
    <script src="{{asset('front-end/assets')}}/js/custom-jarallax.js"></script>

    <!-- date-time picker js -->
    <script src="{{asset('front-end/assets')}}/js/date-picker.js"></script>

     <!-- stick section js -->
    <script src="{{asset('front-end/assets')}}/js/sticky-kit.js"></script>

     <!-- scrollspy js -->
    <!-- <script src="{{asset('front-end/assets')}}/js/scrollyspy.js"></script> -->

    <!-- price range js -->
    <script src="{{asset('front-end/assets')}}/js/price-range.js"></script>

    <!-- slick js-->
    <script src="{{asset('front-end/assets')}}/js/slick.js"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('front-end/assets')}}/js/bootstrap.bundle.min.js"></script>

    <!-- lazyload js-->
    <script src="{{asset('front-end/assets')}}/js/lazysizes.min.js"></script>

    <!-- Theme js-->
    <script src="{{asset('front-end/assets')}}/js/script.js"></script>
    <script src="{{asset('back-end/assets/back-end')}}/js/sweet_alert.js"></script>
    <script src="{{asset('front-end/assets')}}/semantic.min.js"></script>
    {{--Toastr--}}
    <script src="{{asset('back-end/assets/back-end')}}/js/toastr.js"></script>
    {!! Toastr::message() !!}

    @if ($errors->any())
        <script>
            @foreach($errors->all() as $error)
            toastr.error('{{$error}}', Error, {
                CloseButton: true,
                ProgressBar: true
            });
            @endforeach
        </script>
    @endif
    <!-- JS Plugins Init. -->
    <script>
        $(document).ready(function () {
            if ($(window).width() > 991) {
                $(".product_img_scroll, .pro_sticky_info").stick_in_parent();
            }
        });
        $('#datetimepicker').datetimepicker({
            uiLibrary: 'bootstrap4',
        });
    </script>
    @stack('script')
    <script>
    function addToCart(restaurant_cat_id,restaurant_name_code) {
        // if (checkAddToCartValidity()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('cart-add') }}',
                data: $('#add-to-cart-form' + restaurant_cat_id).serializeArray(),
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == 1) {
                        updateNavCart(restaurant_name_code);
                        toastr.success(response.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        // $('.call-when-done').click();
                        $('.customized').modal('hide');
                        return false;
                    } else if (response.status == 2) {

                        Swal.fire(response.message, '', 'error')

                        $('.customized').modal('hide');
                        return false;
                    } else if (response.status == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cart',
                            text: response.message
                        });
                        return false;
                    }
                },
                complete: function () {
                    $('#loading').hide();
                }
            });
        // } else {
        //     Swal.fire({
        //         type: 'info',
        //         title: 'Cart',
        //         text: '{{('please_choose_all_the_options')}}'
        //     });
        // }
    }

    function updateNavCart(restaurant_name_code) {
        $.post('{{route('nav-cart')}}', {_token: '{{csrf_token()}}',restaurant_name_code: restaurant_name_code}, function (response) {
            $('.cart_items').html(response.data);
        });
    }

    function CartQuantityplus(key,restaurant_name_code) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.post({
            url: '{{ route('cart-quantity-plus') }}',
            data: $('#quantity' + key).serializeArray(),
            // beforeSend: function () {
            //     $('#loading').show();
            // },
            success: function (response) {
                console.log(response);
                if (response.status == 1) {
                    updateNavCart(restaurant_name_code);
                    toastr.success(response.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    // $('.call-when-done').click();
                    return false;
                } else if (response.status == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: response.message
                    });
                    return false;
                }
            },
            // complete: function () {
            //     $('#loading').hide();
            // }
        });
    }

    function CartQuantityminus(key,restaurant_name_code) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.post({
            url: '{{ route('cart-quantity-minus') }}',
            data: $('#quantity' + key).serializeArray(),
            // beforeSend: function () {
            //     $('#loading').show();
            // },
            success: function (response) {
                console.log(response);
                if (response.status == 1) {
                    updateNavCart(restaurant_name_code);
                    toastr.success(response.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    // $('.call-when-done').click();
                    return false;
                } else if (response.status == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: response.message
                    });
                    return false;
                }
            },
            // complete: function () {
            //     $('#loading').hide();
            // }
        });
    }

    function sendotp()
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var mobile = $('#mobile').val();
            var country_id = $('#country_id').val();
            $.post({
            url: '{{ route('send-otp-login') }}',
            data: {mobile:mobile,country_id:country_id},
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
            else if (response == 200) {
                $('#singin_div').hide();
                $('#otp_div').show();
                toastr.success('Success! OTP send to your mobile number',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response == 404) {
                toastr.error('Error! Mobile number not registered',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }

    function login(restaurant_name_code)
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var mobile = $('#mobile').val();
            var otp = $('#otp').val();
            $.post({
            url: '{{ route('login') }}',
            data: {mobile:mobile, otp:otp},
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
            else if (response == 200) {
                updateNavCheckout(restaurant_name_code);
                updateNavCart(restaurant_name_code);
                updateNavview();
                $('#login_model').modal('hide');
                toastr.success('Success! LogIn Successfully',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response == 201) {
                $('#singin_div').show();
                $('#otp_div').hide();
                toastr.error('Error! Account has been suspended',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response == 404) {
                toastr.warning('Warning! Please enter valid otp',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }

    function sendotpreg()
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            // var mobile = $('#mobile').val();
            $.post({
            url: '{{ route('send-otp-register') }}',
            data: $('.singupform').serializeArray(),
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
            else if (response == 200) {
                $('#singup_div').hide();
                $('#otp_div_reg').show();
                toastr.success('Success! OTP send to your mobile number',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }

    function register(restaurant_name_code)
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
            url: '{{ route('register') }}',
            data: $('.singupform').serializeArray(),
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
            else if (response == 200) {
                // $('.signupdiv').hide();
                // $('.signindiv').show();
                updateNavCheckout(restaurant_name_code);
                updateNavCart(restaurant_name_code);
                updateNavview();
                $('#login_model').modal('hide');
                toastr.success('Success! Account Create Successfully',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response == 201) {
                $('.signupdiv').show();
                $('.signindiv').hide();
                toastr.error('Error! Something went wrong',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response == 404) {
                toastr.warning('Warning! Please enter valid otp',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }

    function updateNavview() {
        $.post('{{route('nav-header-view')}}', {_token: '{{csrf_token()}}'}, function (response) {
            $('.header_view').html(response.data);
        });
    }

    function updateNavCheckout(restaurant_name_code) {
        $.post('{{route('nav-checkout')}}', {_token: '{{csrf_token()}}',restaurant_name_code: restaurant_name_code}, function (response) {
            $('.checkout_process').html(response.data);
        });
    }
    
    function signupshow()
    {
        $('.signupdiv').show();
        $('.signindiv').hide();
    }

    function signinshow()
    {
        $('.signupdiv').hide();
        $('.signindiv').show();
    }

    function checkout(restaurant_name_code)
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
            url: '{{ route('checkout') }}',
            data: $('.checkoutform').serializeArray(),
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
            else if (response.status == 407) {
                Swal.fire(response.message, '', 'error')
                return false;
            }
            else if (response.status == 402) {
                toastr.error(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response.status == 403) {
                toastr.error(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response.status == 406) {
                toastr.error(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response.status == 404) {
                toastr.warning(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            else if (response.status == 401) {
                $('#payment').modal('show');
                $('.payamt').html(response.grand_total);
                $('.restaurant_id').val(response.restaurant_id);
                $('.grand_total').val(response.grand_total);
                $('.order_type').val(response.order_type);
                $('.payment_type').val(response.payment_type);
                $('.user_name').val(response.user_name);
                $('.user_mobile').val(response.user_mobile);
                $('.user_email').val(response.user_email);
                $('.pincode').val(response.pincode);
                $('.house_flat_no').val(response.house_flat_no);
                $('.road_area_name').val(response.road_area_name);
                $('.gps_address').val(response.gps_address);
                $('.gps_lat').val(response.gps_lat);
                $('.gps_lng').val(response.gps_lng);
                $('.order_id').val(response.order_id);
                $('.outlet_id').val(response.outlet_id);
                return false;
            }
            else if (response.status == 400) {
                toastr.error(response.message,{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                window.location = '{{url('restaurant-order')}}/'+restaurant_name_code;
                return false;
            }
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }

	function apply(restaurant_name_code) {
	    var coupon_code = $('#coupon_code').val();
	    var shipping_charge = $('#shipping_charge').val();
	    var country_currency = $('#country_currency').val();
	    var order_type = $("input[name='order_type']:checked").val();;
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });
          
        $.post({
        url: '{{ route('apply-coupon') }}',
        data: {coupon_code:coupon_code,shipping_charge:shipping_charge,order_type:order_type,restaurant_name_code:restaurant_name_code},
        beforeSend: function () {
        	$('#loading').show();
        },
        success: function (response) {
          console.log(response);
          if (response.status == 1) {
            // $('#dis').html(response.discounted_amount);
            // $('#tot').html(response.amount);
            // $('#final_amt').val(response.amount);
            updateNavCart(restaurant_name_code);
            $('.coupon_app').hide();
            $('.coupon_rem').show();
              toastr.success(response.message,{
                  CloseButton: true,
                  ProgressBar: true

              });
              // $('.call-when-done').click();
              return false;
          } else if (response.status == 2) {
              toastr.error(response.message,{
                  CloseButton: true,
                  ProgressBar: true

              });
              return false;
          }
          else if (response.status == 3) {
              toastr.warning(response.message,{
                  CloseButton: true,
                  ProgressBar: true

              });
              return false;
          }
        },
        complete: function () {
            $('#loading').hide();
            }
      });
    }

  function coupon_remove() {
    $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });
          
        $.post({
        url: '{{ route('remove-coupon') }}',
        // data: $('#applycoupon').serializeArray(),
        // beforeSend: function () {
        // 	$('#loading').show();
        // },
        success: function (response) {
          console.log(response);
          if (response.status == 1) {
            location.reload();
            // $('#coupon_code').val('');
              toastr.success(response.message,{
                  CloseButton: true,
                  ProgressBar: true

              });
              return false;
          }
          else if (response.status == 2) {
              toastr.error(response.message,{
                  CloseButton: true,
                  ProgressBar: true

              });
              return false;
          }
        },
      });
  }
    
    </script>
</body>

</html>