@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))

@section('content')

    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        <img src="{{asset('front-end/assets')}}/images/inner-bg.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="breadcrumb-content">
            <div>
                <h2>Sign In</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sign In</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="title-breadcrumb">ORDERPOZ</div>
    </section>
    <!-- breadcrumb end -->


    <!-- section start -->
    <section class="section-b-space dark-cls animated-section">
        <img src="{{asset('front-end/assets')}}/images/cab/grey-bg.jpg" alt="" class="img-fluid blur-up lazyload bg-img">
        <div class="animation-section">
            <div class="cross po-1"></div>
            <div class="cross po-2"></div>
            <div class="round po-4"></div>
            <div class="round po-5"></div>
            <div class="round r-y po-8"></div>
            <div class="square po-10"></div>
            <div class="square po-11"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 offset-sm-2 col-sm-8 col-12">
                    <div class="account-sign-in signindiv">
                        <div class="title" style="text-align: center; border-bottom: 1px solid rgba(239, 63, 62, 0.09);">
                            <h3>Sign In</h3>
                        </div>
                        <form method="post" enctype="multipart/form-data" id="singinform">
                            @csrf
                            <div id="singin_div">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile No.</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile no." onkeypress="return event.charCode>=48 && event.charCode<=57">
                                </div>
                            
                                <button type="button" class="w-100 btn btn-solid" onclick="sendotp()">Submit</button>
                            </div> 
                            <div id="otp_div" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">OTP</label>
                                    <input id="otp" name="otp" type="number" class="form-control" placeholder="Enter OTP">
                                </div>

                                <a href="#" style="color:black;" class="resend-link" onclick="sendotp()">Resend OTP</a>

                                <button class="w-100 btn btn-solid" type="button" onclick="signin()">Sign In Now</button>
                            </div>
                        </form>
                        {{--<div class="button-bottom">
                                <div class="divider">
                                    <h6>or</h6>
                                </div>
                                <button type="button" class="w-100 btn btn-solid btn-outline" onclick="signupshow()"><a  style="color: unset;">create account</a></button>
                        </div>--}}
                    </div>
                    <div class="account-sign-in signupdiv" style="display:none;">
                        <div class="title" style="text-align: center; border-bottom: 1px solid rgba(239, 63, 62, 0.09);">
                            <h3>Register</h3>
                        </div>
                        <form method="post" enctype="multipart/form-data" class="singupform">
                            @csrf
                            <div id="singup_div">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile No.</label>
                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter mobile no.">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
                                    <input type="hidden" name="lat" id="lat" class="form-control" placeholder="Enter lat" required>
                                    <input type="hidden" name="lng" id="lng" class="form-control" placeholder="Enter lng"  required>
                                </div>
                            
                                <button type="button" class="w-100 btn btn-solid" onclick="sendotpreg()">Submit</button>
                            </div> 
                            <div id="otp_div_reg" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">OTP</label>
                                    <input id="otp_reg" name="otp_reg" type="number" class="form-control" placeholder="Enter OTP">
                                </div>

                                <a href="#" style="color:black;" class="resend-link" onclick="sendotp()">Resend OTP</a>

                                <button class="w-100 btn btn-solid" type="button" onclick="signup()">Register</button>
                            </div>
                        </form>
                        <div class="button-bottom">
                                
                            <div class="divider">
                                <h6>or</h6>
                            </div>
                            <button type="button" class="w-100 btn btn-solid btn-outline" onclick="signinshow()"><a  style="color: unset;">Sign In Now</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    @endsection
    @push('script')
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&libraries=places&country=ind"></script>

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

    function signin()
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
                updateNavview();
                toastr.success('Success! LogIn Successfully',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                window.location = "{{route('home')}}";
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

    function signup()
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
                $('.signupdiv').hide();
                $('.signindiv').show();
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
    </script>
    @endpush