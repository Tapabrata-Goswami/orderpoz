@extends('WEB.partials.app')
@section('title',('Restaurant Registration'))

@section('content')
    <!-- section start -->
    <section class="section-b-space animated-section dark-cls">
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
                <div class="offset-lg-12 col-lg-12 col-sm-8 col-12">
                    <div class="account-sign-in">
                        <div class="title" style="text-align: center;">
                            <h3>Restaurant Registration</h3>
                        </div>
                        <form action="{{route('restaurant.restaurant-store')}}" method="POST" enctype="multipart/form-data" id="restaurant_form" onsubmit="return validateform()" name="myForm">
                            @csrf
                            <div class="row" style="background-color: white;padding: 20px;box-shadow: 0 2px 4px 0 #dedede;">
                                <div class="form-group col-md-6">
                                    <label for="name">Restaurant Name</label>
                                    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" placeholder="Enter Restaurant Name" style="border-radius: 5px;" required>
                                </div>
                                <!-- <div class="col-lg-3"> -->
                                <div class="form-group col-md-6">
                                    <label for="name">Restaurant Mobile</label>
                                    <div role="wrapper" class="gj-datepicker gj-datepicker-bootstrap gj-unselectable input-group">
                                        <span class="input-group-append" role="right-icon">
                                            <select name="country_id" id="country_id" class="form-control"  data-toggle="tooltip" title="{{('Country') }}" required style="border-radius: 5px;">
                                                <option value="">Select</option>
                                                @foreach($country as $con)
                                                    <option value="{{$con->country_id}}">{{$con->country_code}} {{$con->country_name}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                        <input type="text" class="form-control restaurant_mobile" name="restaurant_mobile" id="restaurant_mobile" placeholder="04 xxxx xxxx" required style="border-radius: 5px;" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="13">
                                        
                                    </div>
                                    <span id="mobile_yes" style="color:red;display:none;">Mobile No. already exist </span>
                                </div>
                                <!-- </div> -->

                                <div class="form-group col-md-6">
                                    <label for="name">Restaurant Email</label>
                                    <input type="text" class="form-control" id="restaurant_email" name="restaurant_email" placeholder="Enter Restaurant Email" style="border-radius: 5px;" required>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="restaurant_gps_address">Restaurant Address</label>
                                    <input type="text" class="form-control" name="restaurant_gps_address" id="restaurant_gps_address" placeholder="Address" required style="border-radius: 5px;">
                                    <input type="hidden" name="restaurant_gps_lat" id="restaurant_gps_lat" class="form-control" placeholder="Enter lat" value="" required>
                                    <input type="hidden" name="restaurant_gps_lng" id="restaurant_gps_lng" class="form-control" placeholder="Enter lng" value="" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="restaurant_state">Restaurant State</label>
                                    <input type="text" name="restaurant_state" id="restaurant_state" class="form-control" placeholder="Enter State" value="" required style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="restaurant_city">Restaurant City</label>
                                    <input type="text" name="restaurant_city" id="restaurant_city" class="form-control" placeholder="Enter lng" value="" required style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="restaurant_area">Restaurant Area</label>
                                    <input type="text" name="restaurant_area" id="restaurant_area" class="form-control" placeholder="Enter Area" value="" required style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="license_no">License No./ ABN No.</label>
                                    <input type="text" name="license_no" id="license_no" class="form-control" placeholder="Enter Area" value="" required style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6 row">
                                    <label for="license_no">Restaurant Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="restaurant_image" id="customFileEg1" class="form-control" accept=".jpg, .png, .jpeg|image/*" required style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer"
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="restaurant_contact_person">Restaurant Contact Person Name</label>
                                    <input type="text" name="restaurant_contact_person" id="restaurant_contact_person" class="form-control" placeholder="Enter Name" value="" required style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="restaurant_phone">Restaurant Phone</label>
                                    <input type="text" name="restaurant_phone" id="restaurant_phone" class="form-control" placeholder="Enter Phone No." value="" required style="border-radius: 5px;" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="13">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="shipping_charge">Restaurant Shipping Charge</label>
                                    <input type="number" name="shipping_charge" id="shipping_charge" class="form-control" placeholder="Enter Charge" value="" required style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="delivery_type">Delivery Type</label>
                                    <select name="delivery_type" id="delivery_type" class="form-control"  data-toggle="tooltip" title="{{('Delivery Type') }}" required style="border-radius: 5px;">
                                        <option value="">Select Type</option>
                                        <option value="Delivery">Delivery</option>
                                        <option value="Pickup">Pickup</option>
                                        <option value="Both">Both</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="restaurant_about">Restaurant About</label>
                                    <textarea name="restaurant_about" class="form-control" cols="100" rows="2" required style="border-radius: 5px;"></textarea>
                                </div>

                                <div class="form-group col-md-12 row">
                                    <label for="license_no">Select Proof</label>

                                    <div class="icheck-material-primary icheck-inline col-md-2 immi">
                                        <input type="checkbox" value="Immi Card" id="immi" name="select_kyc[]" class="form-check-input radio_animated" style="border-radius: 1.25em;">
                                        <label for="immi">Immi Card</label>
                                    </div>
                                    <div class="icheck-material-primary icheck-inline col-md-2 adhar" style="display:none">
                                        <input type="checkbox" value="Aadhar Card" id="aadhar" name="select_kyc[]" class="form-check-input radio_animated" style="border-radius: 1.25em;">
                                        <label for="aadhar">Aadhar Card</label>
                                    </div>
                                    <div class="icheck-material-primary icheck-inline col-md-2 personal" style="display:none">
                                        <input type="checkbox" value="Personal ID" id="personal" name="select_kyc[]" class="form-check-input radio_animated" style="border-radius: 1.25em;">
                                        <label for="personal">Personal ID</label>
                                    </div>

                                    <div class="icheck-material-primary icheck-inline col-md-2">
                                        <input type="checkbox" value="Passport" id="passport" name="select_kyc[]" class="form-check-input radio_animated" style="border-radius: 1.25em;">
                                        <label for="passport">Passport</label>
                                    </div>
                                    
                                    <div class="icheck-material-primary icheck-inline col-md-2">
                                        <input type="checkbox" value="Driving License" id="driving" name="select_kyc[]" class="form-check-input radio_animated" style="border-radius: 1.25em;">
                                        <label for="driving">Driving Licence</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 aadhar_proof" style="display:none">
                                    <label for="aadhar_no">Aadharcard No.</label>
                                    <input type="text" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Enter Number" value="" style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6 row aadhar_proof" style="display:none">
                                    <label for="license_no">Aadharcard Front Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="aadhar_front_image" id="customFileEg2" class="form-control" accept=".jpg, .png, .jpeg|image/*" style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer2"
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 row aadhar_proof" style="display:none">
                                    <label for="license_no">Aadharcard Back Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="aadhar_back_image" id="customFileEg3" class="form-control" accept=".jpg, .png, .jpeg|image/*" style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer3"
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 personalimmi_proof" style="display:none">
                                    <label for="pancard_no" class="immi_proof" style="display:none">Immi No.</label>
                                    <label for="pancard_no" class="personal_proof" style="display:none">Personal ID No.</label>
                                    <input type="text" name="pancard_no" id="pancard_no" class="form-control" placeholder="Enter Number" value="" style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6 row personalimmi_proof" style="display:none">
                                    <label for="license_no" class="immi_proof" style="display:none">Immi card Image</label>
                                    <label for="license_no" class="personal_proof" style="display:none">Personal ID Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="pancard_front_image" id="customFileEg4" class="form-control" accept=".jpg, .png, .jpeg|image/*" style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer4"
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>

                                {{--<!-- <div class="form-group col-md-12 personal_proof" style="display:none">
                                    <label for="pancard_no">Personal ID No.</label>
                                    <input type="text" name="pancard_no" id="pancard_no" class="form-control" placeholder="Enter Number" value="" style="border-radius: 5px;">
                                </div> -->

                                <!-- <div class="form-group col-md-6 row personal_proof" style="display:none">
                                    <label for="license_no">Personal ID Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="pancard_front_image" id="customFileEg4" class="form-control" accept=".jpg, .png, .jpeg|image/*" style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer4"
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div> -->--}}

                                <div class="form-group col-md-6 row passport_proof" style="display:none">
                                    <label for="license_no">Passport Front Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="pancard_back_image" id="customFileEg8" class="form-control" accept=".jpg, .png, .jpeg|image/*" style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer8"
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 driving_proof" style="display:none">
                                    <label for="voter_card_no">Driving Licence No.</label>
                                    <input type="text" name="voter_card_no" id="voter_card_no" class="form-control" placeholder="Enter Number" value="" style="border-radius: 5px;">
                                </div>

                                <div class="form-group col-md-6 row driving_proof" style="display:none">
                                    <label for="license_no">Driving Licence Front Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="voter_front_image" id="customFileEg6" class="form-control" accept=".jpg, .png, .jpeg|image/*" style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer6"
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 row driving_proof" style="display:none">
                                    <label for="license_no">Driving Licence Back Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="voter_back_image" id="customFileEg7" class="form-control" accept=".jpg, .png, .jpeg|image/*" style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer7"
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>

                                <div class="button-bottom">
                                    <button type="submit" class="w-100 btn btn-solid">create account</button>
                                </div>
                            </div>
                        </form>
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
  function initialize() {
  var input = document.getElementById('restaurant_gps_address');
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
        if (place.address_components[i].types[j] == "sublocality_level_1") {
          var area = place.address_components[i].long_name;
        }
        if (place.address_components[i].types[j] == "administrative_area_level_1") {
          var state = place.address_components[i].long_name;
        }
      }
    }
      var address = place.formatted_address;
      var latitude = place.geometry.location.lat();
      var longitude = place.geometry.location.lng();

      document.getElementById("restaurant_gps_lat").value = latitude;
      document.getElementById("restaurant_gps_lng").value = longitude;
      document.getElementById("restaurant_area").value = area;
      document.getElementById("restaurant_city").value = city;
      document.getElementById("restaurant_state").value = state;
  })
}
google.maps.event.addDomListener(window, "load", initialize);
</script>
<script>
        function validateform() {
            let country_id = document.forms["myForm"]["country_id"].value;
            let aadhar_no = document.forms["myForm"]["aadhar_no"].value;
            let aadhar_front_image = document.forms["myForm"]["aadhar_front_image"].value;
            let aadhar_back_image = document.forms["myForm"]["aadhar_back_image"].value;
            let pancard_back_image = document.forms["myForm"]["pancard_back_image"].value;
            let voter_card_no = document.forms["myForm"]["voter_card_no"].value;
            let voter_front_image = document.forms["myForm"]["voter_front_image"].value;
            let voter_back_image = document.forms["myForm"]["voter_back_image"].value;
            let pancard_no = document.forms["myForm"]["pancard_no"].value;
            let pancard_front_image = document.forms["myForm"]["pancard_front_image"].value;
            var numberOfChecked = $('input:checkbox:checked').length;
        if (numberOfChecked < 2)
        {
            toastr.error('Error! Select Atlist 2 ID Proof');
            return false;
        }
            var select_kyc = [];
            $('input[type="checkbox"]:checked').each(function () {
                select_kyc.push($(this).val());
            });
            if(country_id==1)
            {
                if (select_kyc == "Aadhar Card,Passport,Driving License") {
                    if(aadhar_no=="")
                    {
                        toastr.error('Error! Aadharcard no. field is required');
                        return false;
                    }
                    if(aadhar_front_image=="")
                    {
                        toastr.error('Error! Aadhar Front Image is required');
                        return false;
                    }
                    if(aadhar_back_image=="")
                    {
                        toastr.error('Error! Aadhar Back Image is required');
                        return false;
                    }
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Aadhar Card,Passport") {
                    if(aadhar_no=="")
                    {
                        toastr.error('Error! Aadharcard no. field is required');
                        return false;
                    }
                    if(aadhar_front_image=="")
                    {
                        toastr.error('Error! Aadhar Front Image is required');
                        return false;
                    }
                    if(aadhar_back_image=="")
                    {
                        toastr.error('Error! Aadhar Back Image is required');
                        return false;
                    }
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Aadhar Card,Driving License") {
                    if(aadhar_no=="")
                    {
                        toastr.error('Error! Aadharcard no. field is required');
                        return false;
                    }
                    if(aadhar_front_image=="")
                    {
                        toastr.error('Error! Aadhar Front Image is required');
                        return false;
                    }
                    if(aadhar_back_image=="")
                    {
                        toastr.error('Error! Aadhar Back Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Passport,Driving License") {
                    
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
            }
            else if(country_id==2)
            {
                if (select_kyc == "Immi Card,Passport,Driving License") {
                    if(pancard_no=="")
                    {
                        toastr.error('Error! Immi no. field is required');
                        return false;
                    }
                    if(pancard_front_image=="")
                    {
                        toastr.error('Error! Immi card Image is required');
                        return false;
                    }
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Immi Card,Passport") {
                    if(pancard_no=="")
                    {
                        toastr.error('Error! Immi no. field is required');
                        return false;
                    }
                    if(pancard_front_image=="")
                    {
                        toastr.error('Error! Immi card Image is required');
                        return false;
                    }
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Immi Card,Driving License") {
                    if(pancard_no=="")
                    {
                        toastr.error('Error! Immi no. field is required');
                        return false;
                    }
                    if(pancard_front_image=="")
                    {
                        toastr.error('Error! Immi card Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Passport,Driving License") {
                    
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
            }
            else
            {
                if (select_kyc == "Personal ID,Passport,Driving License") {
                    // if(pancard_no=="")
                    // {
                    //     toastr.error('Error! Personal ID no. field is required');
                    //     return false;
                    // }
                    if(pancard_front_image=="")
                    {
                        toastr.error('Error! Personal ID Image is required');
                        return false;
                    }
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Personal ID,Passport") {
                    // if(pancard_no=="")
                    // {
                    //     toastr.error('Error! Personal ID no. field is required');
                    //     return false;
                    // }
                    if(pancard_front_image=="")
                    {
                        toastr.error('Error! Personal ID Image is required');
                        return false;
                    }
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Personal ID,Driving License") {
                    // if(pancard_no=="")
                    // {
                    //     toastr.error('Error! Personal ID no. field is required');
                    //     return false;
                    // }
                    if(pancard_front_image=="")
                    {
                        toastr.error('Error! Personal ID Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Passport,Driving License") {
                    
                    if(pancard_back_image=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
            }

        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg2").change(function () {
            readURL2(this);
        });

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer3').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg3").change(function () {
            readURL3(this);
        });

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer4').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg4").change(function () {
            readURL4(this);
        });

        function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer5').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg5").change(function () {
            readURL5(this);
        });

        function readURL6(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer6').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg6").change(function () {
            readURL6(this);
        });

        function readURL7(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer7').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg7").change(function () {
            readURL7(this);
        });

        function readURL8(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer8').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg8").change(function () {
            readURL8(this);
        });
    </script>
    <script>
        $('#country_id').on('change',function(e)
        {
            var country_id = $("#country_id").val();
            if (country_id == 1) 
            {
                $('.adhar').show();
                $('.immi').hide();
                $('.personal').hide();
                document.getElementById("immi").checked = false;
                document.getElementById("personal").checked = false;
                $(".immi_proof").hide();
                $(".personal_proof").hide();
                $(".personalimmi_proof").hide();
            }
            else if (country_id == 2) 
            {
                $('.adhar').hide();
                $('.immi').show();
                $('.personal').hide();
                document.getElementById("aadhar").checked = false;
                document.getElementById("personal").checked = false;
                $(".aadhar_proof").hide();
                $(".personal_proof").hide();
                $(".personalimmi_proof").hide();
            }
            else
            {
                $('.adhar').hide();
                $('.immi').hide();
                $('.personal').show();
                document.getElementById("immi").checked = false;
                document.getElementById("aadhar").checked = false;
                $(".immi_proof").hide();
                $(".personalimmi_proof").hide();
                $(".aadhar_proof").hide();
            }
        });

        if ($("#country_id").val() == 1) {
            $(".adhar").show();
            $(".immi").hide();
            $('.personal').hide();
        }
        else if ($("#country_id").val() == 2) {
            $('.adhar').hide();
            $('.immi').show();
            $('.personal').hide();
        }
        else
        {
            $('.adhar').hide();
            $('.immi').hide();
            $('.personal').show();
        }

        $("#immi").click(function () {
            if ($(this).is(":checked")) {
                $(".immi_proof").show();
                $(".personalimmi_proof").show();
            } else {
                $(".immi_proof").hide();
                $(".personalimmi_proof").hide();
            }
        });

        $("#aadhar").click(function () {
            if ($(this).is(":checked")) {
                $(".aadhar_proof").show();
            } else {
                $(".aadhar_proof").hide();
            }
        });

        $("#personal").click(function () {
            if ($(this).is(":checked")) {
                $(".personal_proof").show();
                $(".personalimmi_proof").show();
            } else {
                $(".personal_proof").hide();
                $(".personalimmi_proof").hide();
            }
        });

        $("#passport").click(function () {
            if ($(this).is(":checked")) {
                $(".passport_proof").show();
            } else {
                $(".passport_proof").hide();
            }
        });

        $("#driving").click(function () {
            if ($(this).is(":checked")) {
                $(".driving_proof").show();
            } else {
                $(".driving_proof").hide();
            }
        });

        // jQuery(".restaurant_mobile").keyup(function () {
        $('.restaurant_mobile').on('change',function(e){
            
        // $("#mobile_yes").css("display", "block");
        let restaurant_mobile = $(".restaurant_mobile").val();
        if (restaurant_mobile.length > 0) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '{{ url('restaurant/check-mobile') }}',
                dataType: 'json',
                data: {
                    restaurant_mobile: restaurant_mobile
                },
                success: function (response) {
                    if (response == 200) {
                        $('#mobile_yes').show();
                    }
                    else{
                        $('#mobile_yes').hide();
                    }
                },
            });
        } else {
            $('#mobile_yes').hide();
        }
    });

    // jQuery(document).mouseup(function (e) {
    //     var container = $("#mobile_yes");
    //     if (!container.is(e.target) && container.has(e.target).length === 0) {
    //         container.hide();
    //     }
    // });
    </script>
    @endpush