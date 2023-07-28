@extends('Admin.app')

@section('title', ('Restaurant'))

@push('css_or_js')
    <link href="{{asset('back-end/assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <!-- <link href="{{ asset('back-end/assets/back-end/css/select2.min.css')}}" rel="stylesheet"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('Restaurant')}}</a>
                </li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="{{route('panel.Restaurant.store')}}" method="POST"
                      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                      enctype="multipart/form-data"
                      id="restaurant_form" onsubmit="return validateform()" name="myForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{('Restaurant Form')}}</h4>
                        </div>
                        <div class="card-body">
                            <div id="Product-form">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="restaurant_name">{{('Restaurant Name')}} </label>
                                            <input type="text" name="restaurant_name" id="restaurant_name" class="form-control" placeholder="Enter Restaurant Name" value="@if(!empty($restaurant)){{$restaurant->restaurant_name}}@endif" required>
                                            <input type="hidden" name="restaurant_id" value="@if(!empty($restaurant)){{$restaurant->restaurant_id}}@endif" id="restaurant_id">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="restaurant_country">{{('Country')}} </label>
                                            <select name="country_id" id="country_id" class="form-control" required data-toggle="tooltip" title="{{('Country') }}">
                                            <option value="">Select Country</option>
                                                @foreach($country as $con)
                                                    <option value="{{$con->country_id}}"
                                                    @if(!empty($restaurant))
                                                        @if($con->country_id == $restaurant->country_id)
                                                            selected
                                                        @endif
                                                    @endif>{{$con->country_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="restaurant_mobile">{{('Restaurant Mobile')}} </label>
                                            <input type="number" name="restaurant_mobile" id="restaurant_mobile" class="form-control" placeholder="Enter Restaurant Mobile" value="@if(!empty($restaurant)){{$restaurant->restaurant_mobile}}@endif" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="restaurant_email">{{('Restaurant Email')}} </label>
                                            <input type="email" name="restaurant_email" id="restaurant_email" class="form-control" placeholder="Enter Restaurant Email" value="@if(!empty($restaurant)){{$restaurant->restaurant_email}}@endif" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="input-label"for="exampleFormControlInput1">@if(!empty($restaurant)) {{('Password')}} <small>( enter if you want to change )</small> @else {{('Password')}} @endif</label>
                                            <input type="text" name="password" class="form-control" placeholder="Enter Password" value="">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">{{('Address')}}</label>
                                            <input type="text" name="restaurant_gps_address" id="restaurant_gps_address" class="form-control" placeholder="Enter address" value="@if(!empty($restaurant)){{$restaurant->restaurant_gps_address}}@endif" required>
                                            <input type="hidden" name="restaurant_gps_lat" id="restaurant_gps_lat" class="form-control" placeholder="Enter lat" value="@if(!empty($restaurant)){{$restaurant->restaurant_gps_lat}}@endif" required>
                                            <input type="hidden" name="restaurant_gps_lng" id="restaurant_gps_lng" class="form-control" placeholder="Enter lng" value="@if(!empty($restaurant)){{$restaurant->restaurant_gps_lng}}@endif" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="name">{{('Shipping Charge')}}</label>
                                            <input type="number" name="shipping_charge" id="shipping_charge" class="form-control" placeholder="Enter Shipping Charge" value="@if(!empty($restaurant)){{$restaurant->shipping_charge}}@endif" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="name">{{('Area')}}</label>
                                            <input type="text" name="restaurant_area" id="restaurant_area" class="form-control" placeholder="Enter Area" value="@if(!empty($restaurant)){{$restaurant->restaurant_area}}@endif" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="name">{{('City')}}</label>
                                            <input type="text" name="restaurant_city" id="restaurant_city" class="form-control" placeholder="Enter City" value="@if(!empty($restaurant)){{$restaurant->restaurant_city}}@endif" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="name">{{('State')}}</label>
                                            <input type="text" name="restaurant_state" id="restaurant_state" class="form-control" placeholder="Enter State" value="@if(!empty($restaurant)){{$restaurant->restaurant_state}}@endif" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="restaurant_contact_person">{{('Contact Person Name')}} </label>
                                            <input type="text" name="restaurant_contact_person" id="restaurant_contact_person" class="form-control" placeholder="Enter Contact Person Name" value="@if(!empty($restaurant)){{$restaurant->restaurant_contact_person}}@endif" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="restaurant_phone">{{('Restaurant Phone')}} </label>
                                            <input type="text" name="restaurant_phone" id="restaurant_phone" class="form-control" placeholder="Enter Restaurant Phone" value="@if(!empty($restaurant)){{$restaurant->restaurant_phone}}@endif">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="license_no">{{('License No./ ABN No.')}} </label>
                                            <input type="text" name="license_no" id="license_no" class="form-control" placeholder="Enter License No." value="@if(!empty($restaurant)){{$restaurant->license_no}}@endif" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="voter_card_no">{{('Delivery Type')}} </label>
                                            <select name="delivery_type" id="delivery_type" class="form-control" data-toggle="tooltip" title="{{('Delivery Type') }}" required style="border-radius: 5px;">
                                                <option value="">Select Type</option>
                                                <option value="Delivery" @if(!empty($restaurant))
                                                        @if($restaurant->delivery_type == 'Delivery')
                                                            selected
                                                        @endif
                                                    @endif>Delivery</option>
                                                <option value="Pickup" @if(!empty($restaurant))
                                                        @if($restaurant->delivery_type == 'Pickup')
                                                            selected
                                                        @endif
                                                    @endif>Pickup</option>
                                                <option value="Both" @if(!empty($restaurant))
                                                        @if($restaurant->delivery_type == 'Both')
                                                            selected
                                                        @endif
                                                    @endif>Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="secret_key">{{('Stripe Secret Key')}} </label>
                                            <input type="text" name="secret_key" id="secret_key" class="form-control" placeholder="Enter Stripe Secret Key" value="@if(!empty($restaurant)){{$restaurant->secret_key}}@endif" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="publish_key">{{('Stripe Publishable key')}} </label>
                                            <input type="text" name="publish_key" id="publish_key" class="form-control" placeholder="Enter Stripe Publishable key" value="@if(!empty($restaurant)){{$restaurant->publish_key}}@endif" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="voter_card_no">{{('Restaurant About')}} </label>
                                            <textarea name="restaurant_about" class="form-control" cols="100" rows="2" required>@if(!empty($restaurant)){{$restaurant->restaurant_about}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="voter_card_no">{{('Select Proof')}} </label>
                                            <div class="form-group col-md-12 row">
                                                <div class="custom-control custom-radio col-md-2 immi">
                                                    <input type="checkbox" value="Immi Card" id="immi" name="select_kyc[]" class="custom-control-input" style="border-radius: 1.25em;" 
                                                    @if(!empty($restaurant)) @foreach($select_kyc as $datas)
                                                        {{$datas == 'Immi Card' ?'checked':''}}
                                                    @endforeach @endif>
                                                    <label class="custom-control-label" for="immi">Immi Card</label>
                                                </div>
                                                <div class="custom-control custom-radio col-md-2 adhar" style="display:none">
                                                    <input type="checkbox" value="Aadhar Card" id="aadhar" name="select_kyc[]" class="custom-control-input" style="border-radius: 1.25em;"
                                                    @if(!empty($restaurant)) @foreach($select_kyc as $datas)
                                                        {{$datas == 'Aadhar Card' ?'checked':''}}
                                                    @endforeach @endif>
                                                    <label class="custom-control-label" for="aadhar">Aadhar Card</label>
                                                </div>
                                                <div class="custom-control custom-radio col-md-2 personal" style="display:none">
                                                    <input type="checkbox" value="Personal ID" id="personal" name="select_kyc[]" class="custom-control-input" style="border-radius: 1.25em;"
                                                    @if(!empty($restaurant)) @foreach($select_kyc as $datas)
                                                        {{$datas == 'Personal ID' ?'checked':''}}
                                                    @endforeach @endif>
                                                    <label class="custom-control-label" for="personal">Personal ID</label>
                                                </div>

                                                <div class="custom-control custom-radio col-md-2">
                                                    <input type="checkbox" value="Passport" id="passport" name="select_kyc[]" class="custom-control-input" style="border-radius: 1.25em;"
                                                    @if(!empty($restaurant)) @foreach($select_kyc as $datas)
                                                        {{$datas == 'Passport' ?'checked':''}}
                                                    @endforeach @endif>
                                                    <label class="custom-control-label" for="passport">Passport</label>
                                                </div>
                                                
                                                <div class="custom-control custom-radio col-md-2">
                                                    <input type="checkbox" value="Driving License" id="driving" name="select_kyc[]" class="custom-control-input" style="border-radius: 1.25em;"
                                                    @if(!empty($restaurant)) @foreach($select_kyc as $datas)
                                                        {{$datas == 'Driving License' ?'checked':''}}
                                                    @endforeach @endif>
                                                    <label class="custom-control-label" for="driving">Driving Licence</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 aadhar_proof" style="display:none">
                                            <label for="aadhar_no">{{('Aadharcard No.')}} </label>
                                            <input type="text" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Enter Aadharcard No." value="@if(!empty($restaurant)){{$restaurant->aadhar_no}}@endif">
                                        </div>
                                        <div class="col-md-6 personalimmi_proof" style="display:none">
                                            <label for="pancard_no" class="immi_proof" style="display:none">{{('Immi No.')}} </label>
                                            <label for="pancard_no" class="personal_proof" style="display:none">{{('Personal ID No.')}} </label>
                                            <input type="text" name="pancard_no" id="pancard_no" class="form-control" placeholder="Enter Number" value="@if(!empty($restaurant)){{$restaurant->pancard_no}}@endif">
                                        </div>
                                        {{--<!-- <div class="col-md-6 personal_proof" style="display:none">
                                            <label for="pancard_no">{{('Personal ID No.')}} </label>
                                            <input type="text" name="pancard_no" id="pancard_no" class="form-control" placeholder="Enter Number" value="@if(!empty($restaurant)){{$restaurant->pancard_no}}@endif">
                                        </div> -->--}}
                                        <div class="col-md-6 driving_proof" style="display:none">
                                            <label for="voter_card_no">{{('Driving Licence No.')}} </label>
                                            <input type="text" name="voter_card_no" id="voter_card_no" class="form-control" placeholder="Enter Number" value="@if(!empty($restaurant)){{$restaurant->voter_card_no}}@endif">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{('Proof Image')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row mb-4">
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center" >{{('Restaurant Image')}}</label>
                                    <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" name="restaurant_image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*" >
                                        <label class="custom-file-label" for="customFileEg1">{{('choose')}} {{('file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer"
                                        @if(isset($restaurant))
                                        src="{{asset('image')}}/{{$restaurant['restaurant_image']}}"
                                        @else
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        @endif
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>
                                <div class="row mb-4 aadhar_proof" style="display:none">
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center" >{{('Aadharcard Front Image')}}</label>
                                    <div class="col-md-6">
                                        <div class="custom-file">
                                        <input type="file" name="aadhar_front_image" id="customFileEg2" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*" >
                                        <input type="hidden" name="aadhar_front_image1" value="@if(!empty($restaurant)){{$restaurant->aadhar_front_image}}@endif">
                                        <label class="custom-file-label" for="customFileEg2">{{('choose')}} {{('file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer2"
                                        @if(isset($restaurant))
                                        src="{{asset('image')}}/{{$restaurant['aadhar_front_image']}}"
                                        @else
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        @endif
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>
                                <div class="row mb-4 aadhar_proof" style="display:none">
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center" >{{('Aadharcard Back Image')}}</label>
                                    <div class="col-md-6">
                                        <div class="custom-file">
                                        <input type="file" name="aadhar_back_image" id="customFileEg3" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*" >
                                        <input type="hidden" name="aadhar_back_image1" value="@if(!empty($restaurant)){{$restaurant->aadhar_back_image}}@endif">
                                        <label class="custom-file-label" for="customFileEg3">{{('choose')}} {{('file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer3"
                                        @if(isset($restaurant))
                                        src="{{asset('image')}}/{{$restaurant['aadhar_back_image']}}"
                                        @else
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        @endif
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>
                                <div class="row mb-4 personalimmi_proof" style="display:none">
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center immi_proof">{{('Immi card Image')}}</label>
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center personal_proof">{{('Personal ID Image')}}</label>
                                    <div class="col-md-6">
                                        <div class="custom-file">
                                        <input type="file" name="pancard_front_image" id="customFileEg4" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*">
                                        <input type="hidden" name="pancard_front_image1" value="@if(!empty($restaurant)){{$restaurant->pancard_front_image}}@endif">
                                        <label class="custom-file-label" for="customFileEg4">{{('choose')}} {{('file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer4"
                                        @if(isset($restaurant))
                                        src="{{asset('image')}}/{{$restaurant['pancard_front_image']}}"
                                        @else
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        @endif
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>
                                {{--<!-- <div class="row mb-4 personal_proof" style="display:none">
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center">{{('Personal ID Image')}}</label>
                                    <div class="col-md-6">
                                        <div class="custom-file">
                                        <input type="file" name="pancard_front_image" id="customFileEg4" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*">
                                        <input type="hidden" name="pancard_front_image1" value="@if(!empty($restaurant)){{$restaurant->pancard_front_image}}@endif">
                                        <label class="custom-file-label" for="customFileEg4">{{('choose')}} {{('file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer4"
                                        @if(isset($restaurant))
                                        src="{{asset('image')}}/{{$restaurant['pancard_front_image']}}"
                                        @else
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        @endif
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div> -->--}}
                                <div class="row mb-4 passport_proof" style="display:none">
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center" >{{('Passport Front Image')}}</label>
                                    <div class="col-md-6">
                                        <div class="custom-file">
                                        <input type="file" name="pancard_back_image" id="customFileEg5" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*">
                                        <input type="hidden" name="pancard_back_image1" value="@if(!empty($restaurant)){{$restaurant->pancard_back_image}}@endif">
                                        <label class="custom-file-label" for="customFileEg5">{{('choose')}} {{('file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer5"
                                        @if(isset($restaurant))
                                        src="{{asset('image')}}/{{$restaurant['pancard_back_image']}}"
                                        @else
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        @endif
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>
                                <div class="row mb-4 driving_proof" style="display:none">
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center">{{('Driving Licence Front Image')}}</label>
                                    <div class="col-md-6">
                                        <div class="custom-file">
                                        <input type="file" name="voter_front_image" id="customFileEg6" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*" >
                                        <input type="hidden" name="voter_front_image1" value="@if(!empty($restaurant)){{$restaurant->voter_front_image}}@endif">
                                        <label class="custom-file-label" for="customFileEg6">{{('choose')}} {{('file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer6"
                                        @if(isset($restaurant))
                                        src="{{asset('image')}}/{{$restaurant['voter_front_image']}}"
                                        @else
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        @endif
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>
                                <div class="row mb-4 driving_proof" style="display:none">
                                    <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-center">{{('Driving Licence Back Image')}}</label>
                                    <div class="col-md-6">
                                        <div class="custom-file">
                                        <input type="file" name="voter_back_image" id="customFileEg7" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*" >
                                        <input type="hidden" name="voter_back_image1" value="@if(!empty($restaurant)){{$restaurant->voter_back_image}}@endif">
                                        <label class="custom-file-label" for="customFileEg7">{{('choose')}} {{('file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer7"
                                        @if(isset($restaurant))
                                        src="{{asset('image')}}/{{$restaurant['voter_back_image']}}"
                                        @else
                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                        @endif
                                        alt="image" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'"/>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{('Multiple Image')}}</h4>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{('Restaurant Multiple')}} {{('Images')}}</label>
                            <div>
                                <div class="row" @if(!empty($restaurant)) id="editcoba" @else id="coba" @endif>
                                @if(!empty($restaurant))
                                @foreach ($restaurant_gallery as $img)
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <img style="width: 100%" height="auto" onerror="this.src='{{asset('back-end/assets/back-end/img/image-place-holder.png')}}'" src="{{asset("image/$img->gallery_image")}}" alt="Product image">
                                                <a href="{{route('panel.Restaurant.remove-image',['gallery_id'=>$img['gallery_id'],'name'=>$img['gallery_image'],'restaurant_id'=>$img['restaurant_id']])}}" class="btn btn-danger btn-block">{{('Remove')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="card card-footer">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 20px">
                                <button type="submit" class="btn btn-primary">{{('Submit')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<script src="{{asset('back-end/assets/back-end/js/spartan-multi-image-picker.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'gallery_image[]',
                maxCount: 6,
                rowHeight: '120px',
                groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: "{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}",
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error("{{('please only input png or jpg type file')}}", {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error("{{('file size too big')}}", {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        var imageCount = {{6-$imgcnt}};
        if (imageCount > 0) {
                $("#editcoba").spartanMultiImagePicker({
                    fieldName: 'gallery_image[]',
                    maxCount: imageCount,
                    rowHeight: 'auto',
                    groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
                    maxFileSize: '',
                    placeholderImage: {
                        image: "{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}",
                        width: '100%',
                    },
                    dropFileLabel: "Drop Here",
                    onAddRow: function (index, file) {

                    },
                    onRenderedPreview: function (index) {

                    },
                    onRemoveRow: function (index) {

                    },
                    onExtensionErr: function (index, file) {
                        toastr.error("{{('please only input png or jpg type file')}}", {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    },
                    onSizeErr: function (index, file) {
                        toastr.error("{{('file size too big')}}", {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                });
            }
    </script>
    <script>
        function validateform() {
        let u_mo_no = document.forms["myForm"]["u_mo_no"].value;
        let category_id = document.forms["myForm"]["category_id"].value;
        if (u_mo_no == "") {
            toastr.error('Error! User Mobile no. field is required');
            return false;
        }
        if (category_id == "") {
            toastr.error('Error! Category must be selected');
            return false;
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
    </script>
    <script>
        // $('#country_id').on('change',function(e)
        // {
        //     var country_id = $("#country_id").val();
        //     if (country_id == 1) 
        //     {
        //         $('.adhar').show();
        //         $('.immi').hide();
        //     }
        //     else
        //     {
        //         $('.adhar').hide();
        //         $('.immi').show();
        //     }
        // });

        // if ($("#country_id").val() == 1) {
        //     $(".adhar").show();
        //     $(".immi").hide();
        // }
        // else {
        //     $('.adhar').hide();
        //     $('.immi').show();
        // }
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

            let pancard_front_image1 = document.forms["myForm"]["pancard_front_image1"].value;
            let aadhar_front_image1 = document.forms["myForm"]["aadhar_front_image1"].value;
            let aadhar_back_image1 = document.forms["myForm"]["aadhar_back_image1"].value;
            let pancard_back_image1 = document.forms["myForm"]["pancard_back_image1"].value;
            let voter_front_image1 = document.forms["myForm"]["voter_front_image1"].value;
            let voter_back_image1 = document.forms["myForm"]["voter_back_image1"].value;
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
                    if(aadhar_front_image=="" && aadhar_front_image1=="")
                    {
                        toastr.error('Error! Aadhar Front Image is required');
                        return false;
                    }
                    if(aadhar_back_image=="" && aadhar_back_image1=="")
                    {
                        toastr.error('Error! Aadhar Back Image is required');
                        return false;
                    }
                    if(pancard_back_image=="" && pancard_back_image1=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
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
                    if(aadhar_front_image=="" && aadhar_front_image1=="")
                    {
                        toastr.error('Error! Aadhar Front Image is required');
                        return false;
                    }
                    if(aadhar_back_image=="" && aadhar_back_image1=="")
                    {
                        toastr.error('Error! Aadhar Back Image is required');
                        return false;
                    }
                    if(pancard_back_image=="" && pancard_back_image1=="")
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
                    if(aadhar_front_image=="" && aadhar_front_image1=="")
                    {
                        toastr.error('Error! Aadhar Front Image is required');
                        return false;
                    }
                    if(aadhar_back_image=="" && aadhar_back_image1=="")
                    {
                        toastr.error('Error! Aadhar Back Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Passport,Driving License") {
                    
                    if(pancard_back_image=="" && pancard_back_image1=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="" && voter_card_no1=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
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
                    if(pancard_front_image=="" && pancard_front_image1=="")
                    {
                        toastr.error('Error! Immi card Image is required');
                        return false;
                    }
                    if(pancard_back_image=="" && pancard_back_image1=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
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
                    if(pancard_front_image=="" && pancard_front_image1=="")
                    {
                        toastr.error('Error! Immi card Image is required');
                        return false;
                    }
                    if(pancard_back_image=="" && pancard_back_image1=="")
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
                    if(pancard_front_image=="" && pancard_front_image1=="")
                    {
                        toastr.error('Error! Immi card Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Passport,Driving License") {
                    
                    if(pancard_back_image=="" && pancard_back_image1=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
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
                    if(pancard_front_image=="" && pancard_front_image1=="")
                    {
                        toastr.error('Error! Personal ID Image is required');
                        return false;
                    }
                    if(pancard_back_image=="" && pancard_back_image1=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
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
                    if(pancard_front_image=="" && pancard_front_image1=="")
                    {
                        toastr.error('Error! Personal ID Image is required');
                        return false;
                    }
                    if(pancard_back_image=="" && pancard_back_image1=="")
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
                    if(pancard_front_image=="" && pancard_front_image1=="")
                    {
                        toastr.error('Error! Personal ID Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
                if (select_kyc == "Passport,Driving License") {
                    
                    if(pancard_back_image=="" && pancard_back_image1=="")
                    {
                        toastr.error('Error! Passport Front Image is required');
                        return false;
                    }
                    if(voter_card_no=="")
                    {
                        toastr.error('Error! Driving Licence no. field is required');
                        return false;
                    }
                    if(voter_front_image=="" && voter_front_image1=="")
                    {
                        toastr.error('Error! Driving Licence Front Image is required');
                        return false;
                    }
                    if(voter_back_image=="" && voter_back_image1=="")
                    {
                        toastr.error('Error! Driving Licence Back Image is required');
                        return false;
                    }
                }
            }

        }

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

        $(document).ready(function(){
            var select_kyc1 = [];
            $('input[type="checkbox"]:checked').each(function () {
                select_kyc1.push($(this).val());
            });
            if(select_kyc1[0]=='Immi Card')
            {
                $(".immi_proof").show();
                $(".personalimmi_proof").show();
            }
            if(select_kyc1[0]=='Aadhar Card')
            {
                $(".aadhar_proof").show();
            }
            if(select_kyc1[0]=='Personal ID')
            {
                $(".personal_proof").show();
                $(".personalimmi_proof").show();
            }
            if(select_kyc1[0]=='Passport' || select_kyc1[1]=='Passport')
            {
                $(".passport_proof").show();
            }
            if(select_kyc1[0]=='Driving License' || select_kyc1[1]=='Driving License' || select_kyc1[1]=='Driving License')
            {
                $(".driving_proof").show();
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
    </script>
@endpush