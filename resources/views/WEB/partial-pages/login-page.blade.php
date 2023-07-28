@php($country=App\Models\restaurant::where('restaurant_name_code',$restaurant_name_code)->first())
<div class="checkout-box">
    <!-- <h4 class="title">Sign In:</h4> -->
    <div class="review-section">
        <div class="review_box">
            <div class="flight_detail payment-gateway">
                <div class="accordion" id="accordionExample">
                    <div class="card" style="border: 0px;">
                        <div id="one"  aria-labelledby="h_one"
                            data-bs-parent="#accordionExample">
                            <div class="card-body" style="border: 0px;">
                                <form>
                                    <div class="container">
                                        <div class="row">
                                            <div class="offset-lg-3 col-lg-6 offset-sm-2 col-sm-8 col-12">
                                                <div class="account-sign-in signindiv">
                                                    <div class="title" style="text-align: center; border-bottom: 1px solid rgba(239, 63, 62, 0.09);">
                                                        <h3>Login</h3>
                                                    </div>
                                                    <form method="post" enctype="multipart/form-data" id="singinform">
                                                        @csrf
                                                        <div id="singin_div">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Mobile No.*</label>
                                                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="04 xxxx xxxx" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="13">
                                                                <input type="hidden" class="form-control" name="country_id" id="country_id" value="{{$country->country_id}}">
                                                            </div>
                                                        
                                                            <button type="button" class="w-100 btn btn-solid" onclick="sendotp()">Submit</button>
                                                        </div> 
                                                        <div id="otp_div" style="display:none;">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">OTP*</label>
                                                                <input id="otp" name="otp" type="number" class="form-control" placeholder="Enter OTP">
                                                            </div>

                                                            <a href="#" style="color:black;" class="resend-link" onclick="sendotp()">Resend OTP?</a>

										                    <button class="w-100 btn btn-solid" type="button" onclick="login('{{$restaurant_name_code}}')">Sign In Now</button>
                                                        </div>
                                                    </form>
                                                    <div class="button-bottom">
                                                            <div class="divider">
                                                                <h6>or</h6>
                                                            </div>
                                                            <button type="button" class="w-100 btn btn-solid btn-outline" onclick="signupshow()"><a  style="color: unset;">create account</a></button>
                                                        </div>
                                                </div>
                                                <div class="account-sign-in signupdiv" style="display:none;">
                                                    <div class="title" style="text-align: center; border-bottom: 1px solid rgba(239, 63, 62, 0.09);">
                                                        <h3>Register</h3>
                                                    </div>
                                                    <form method="post" enctype="multipart/form-data" class="singupform">
                                                        @csrf
                                                        <div id="singup_div">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Name*</label>
                                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                                                <input type="hidden" class="form-control" name="country_id" id="country_id" value="{{$country->country_id}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Mobile No.*</label>
                                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="04 xxxx xxxx" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="13">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Address*</label>
                                                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
                                                                <input type="hidden" name="lat" id="lat" class="form-control" placeholder="Enter lat" required>
                                                                <input type="hidden" name="lng" id="lng" class="form-control" placeholder="Enter lng"  required>
                                                            </div>
                                                        
                                                            <button type="button" class="w-100 btn btn-solid" onclick="sendotpreg()">Submit</button>
                                                        </div> 
                                                        <div id="otp_div_reg" style="display:none;">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">OTP*</label>
                                                                <input id="otp_reg" name="otp_reg" type="number" class="form-control" placeholder="Enter OTP">
                                                            </div>

                                                            <a href="#" style="color:black;" class="resend-link" onclick="sendotpreg()">Resend OTP?</a>

										                    <button class="w-100 btn btn-solid" type="button" onclick="register('{{$restaurant_name_code}}')">Register</button>
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>