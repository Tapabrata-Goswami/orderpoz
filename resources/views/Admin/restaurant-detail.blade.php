@extends('Admin.app')

@section('title',('Restaurant Detail'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('back-end/assets/back-end/css/croppie.css')}}" rel="stylesheet">
    <style>
        .flex-item{
            padding: 10px;
            flex: 20%;
        }

        /* Responsive layout - makes a one column-layout instead of a two-column layout */
        @media (max-width: 768px) {
            .flex-item{
                flex: 50%;
            }
        }

        @media (max-width: 480px) {
            .flex-item{
                flex: 100%;
            }
        }
    </style>
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Restaurant Detail')}}</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
        <div>
            <a href="{{route('panel.Restaurant.list')}}" class="btn btn-primary mt-3 mb-3">{{('Back to Restaurant list')}}</a>
        </div>
    </div>
    <!-- Page Header -->
    <div class="page-header">
        <div class="flex-between row mx-1 row">
            <div class="col-6">
                <h1 class="page-header-title">{{ $restaurant->restaurant_name? $restaurant->restaurant_name : "Restaurant Name : Update Please" }}</h1>
            </div>
            <div class="col-6">
                <a href="{{route('panel.Restaurant.edit',[$restaurant->restaurant_id])}}" class="btn btn-primary float-right">
                    <i class="tio-edit"></i> {{('Edit Restaurant')}}
                </a>
            </div>
        </div>
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('panel.Restaurant.detail',[$restaurant['restaurant_id']])}}">{{('Restaurant')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'review']) }}">{{('Review')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'outlet']) }}">{{('Outlets')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'booktable']) }}">{{('Booked Tables')}}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
    <!-- End Page Header -->

    <div class="card my-2">
        <div class="card-body">
            <div class="row pt-4">
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            {{('Restaurant')}} {{('Info')}}
                        </div>
                        <div class="card-body ">
                            <div class="text-center">
                                <div class="avatar avatar-xxl avatar-circle avatar-border-lg">
                                    <img class="avatar-img" onerror="this.src='{{asset('back-end/assets/back-end/img/160x160/img1.jpg')}}'" src="{{asset('image')}}/{{$restaurant->restaurant_image}}" alt="Image Description">
                                </div>
                            
                                <ul class="list-unstyled list-unstyled-py-3 text-dark mb-3">
                                    <li>
                                        <i class="tio-user-outlined nav-icon"></i>
                                        {{$restaurant->restaurant_name}}
                                    </li>
                                    <li>
                                        <i class="tio-online nav-icon"></i>
                                        {{$restaurant->restaurant_email}}
                                    </li>
                                    <li>
                                        <i class="tio-android-phone-vs nav-icon"></i>
                                        {{$restaurant->restaurant_mobile}}
                                    </li>
                                    <li>
                                        <i class="tio-city nav-icon"></i>
                                        {{$restaurant->country_name}}
                                    </li>
                                </ul>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header text-capitalize">
                                    {{('Restaurant Info')}} <br>
                                    @if($restaurant->restaurant_status=='1')
                                            <a href="{{route('panel.Restaurant.status-update',[$restaurant->restaurant_id,0])}}"><button type="submit" class="btn btn-outline-danger">{{('Inactive')}}</button></a>
                                    @elseif($restaurant->restaurant_status=='0')
                                            <a href="{{route('panel.Restaurant.status-update',[$restaurant->restaurant_id,1])}}"><button type="submit" class="btn btn-outline-success">{{('Active')}}</button></a>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled list-unstyled-py-3 text-dark mb-3">
                                        <li class="pb-1 pt-1">{{('Restaurant Status')}}: {!! $restaurant->restaurant_status=='1'?'<label class="badge badge-success">Active</label>':'<label class="badge badge-danger">Inactive</label>' !!}</li>
                                        <li class="pb-1 pt-1">
                                            {{('Restaurant Category')}} : <b>@php
                                            $cnt=1;
                                            $cat_list= App\Models\restaurant_category::leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->where('restaurant_categories.restaurant_id',$restaurant['restaurant_id'])->groupby('restaurant_categories.cat_id')->get();
                                            
                                            @endphp
                                            @foreach($cat_list as $key=>$list)
                                                <span class="badge badge-soft-danger">
                                                <span class="legend-indicator bg-danger"></span>{{$list->cat_name}}</span>
                                            @endforeach </b>
                                        </li>
                                        <li class="pb-1 pt-1">
                                            {{('Restaurant Address')}}  : <a target="_blank" href="https://maps.google.com/maps?z=12&t=m&q=loc:{{$restaurant['restaurant_lat']}}+{{$restaurant['restaurant_lng']}}"><b>{{ isset($restaurant['restaurant_gps_address']) ? $restaurant['restaurant_gps_address'] : 'N/A' }} </b></a>
                                        </li>
                                        <li class="pb-1 pt-1">
                                            {{('License No.')}}: <b>{{ $restaurant['license_no'] }} </b>
                                        </li>
                                        <li class="pb-1 pt-1">
                                            {{('Contact Person Name')}}: <b>{{ $restaurant['restaurant_contact_person'] }} </b>
                                        </li>
                                        <li class="pb-1 pt-1">
                                            {{('Restaurant Phone No.')}}: <b>{{ $restaurant['restaurant_phone'] }} </b>
                                        </li>
                                        @if($restaurant['country_id']==1)
                                        <li class="pb-1 pt-1">
                                            {{('Aadhar No.')}}: <b>{{ $restaurant['aadhar_no'] }} </b>
                                        </li>
                                        @endif
                                        <li class="pb-1 pt-1">
                                            @if($restaurant['country_id']==1){{('Pancard No.')}}@else {{('Immi No.')}} @endif: <b>{{ $restaurant['pancard_no'] }} </b>
                                        </li>
                                        <li class="pb-1 pt-1">
                                        @if($restaurant['country_id']==1){{('VoterId No.')}}@else {{('Driving Lincese No.')}} @endif: <b>{{ $restaurant['voter_card_no'] }} </b>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
            </div>
            
            <div class="row pt-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Restaurant TimeSlot</h4>
                                </div>
                                <div class="card-body" id="schedule">
                                    @include('Admin.view.restaurant-timeslot',['restaurant_id'=>$restaurant->restaurant_id])
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
                    <div>
                        <div class="row" id="coba">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <img style="width: 100%;height:150px;" height="auto" onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}'" src="{{asset("image/$restaurant->aadhar_front_image")}}" alt="Aadhar image">
                                        <a href="#" class="btn btn-danger btn-block">@if($restaurant->country_id==1){{('Aadhar Front')}}@else {{('Passport')}} @endif</a>
                                    </div>
                                </div>
                            </div>
                            @if($restaurant->country_id==1) 
                            <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <img style="width: 100%;height:150px;" height="auto" onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}'" src="{{asset("image/$restaurant->aadhar_back_image")}}" alt="Aadhar image">
                                        <a href="#" class="btn btn-danger btn-block">{{('Aadhar Back')}}</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <img style="width: 100%;height:150px;" height="auto" onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}'" src="{{asset("image/$restaurant->pancard_front_image")}}" alt="Pancard image">
                                        <a href="#" class="btn btn-danger btn-block">@if($restaurant->country_id==1){{('Pancard Front')}}@else {{('Immi Card')}} @endif</a>
                                    </div>
                                </div>
                            </div>
                            {{--<!-- <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <img style="width: 100%;height:150px;" height="auto" onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}'" src="{{asset("image/$restaurant->aadhar_back_image")}}" alt="Pancard image">
                                        <a href="#" class="btn btn-danger btn-block">{{('Pancard Back')}}</a>
                                    </div>
                                </div>
                            </div> -->--}}
                            <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <img style="width: 100%;height:150px;" height="auto" onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}'" src="{{asset("image/$restaurant->voter_front_image")}}" alt="Voterid image">
                                        <a href="#" class="btn btn-danger btn-block">@if($restaurant->country_id==1){{('Voter Id Front')}}@else {{('Driving Licence Front')}} @endif</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <img style="width: 100%;height:150px;" height="auto" onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}'" src="{{asset("image/$restaurant->voter_back_image")}}" alt="Voterid image">
                                        <a href="#" class="btn btn-danger btn-block">@if($restaurant->country_id==1){{('Voter Id Back')}}@else {{('Driving Licence Back')}} @endif</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Restaurant Images</h4>
                                </div>
                                <div class="col-md-12 row">
                                    @php 
                                        $restaurant_img= App\Models\restaurant_gallery::where('restaurant_id',$restaurant['restaurant_id'])->get(); 
                                    @endphp
                                    @foreach($restaurant_img as $img)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <img style="width: 100%" src="{{asset('image')}}/{{$img->gallery_image}}" onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}"  alt="Turf image">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Restaurant About</h4>
                                </div>
                                <div class="card-body" id="schedule">
                                    {{ $restaurant['restaurant_about'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($restaurant_time_slot as $time_slot)
<div class="modal fade" id="exampleModal{{$time_slot->time_slot_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{('Create Schedule')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:" method="post" class="add-schedule{{$time_slot->time_slot_id}}">
                    @csrf
                    <input type="hidden" name="time_slot_id" value="{{$time_slot->time_slot_id}}" id="time_slot_id">
                    <input type="hidden" name="restaurant_id" value="{{$restaurant->restaurant_id}}">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{('Start time')}}:</label>
                        <input type="time" class="form-control" value="{{$time_slot->from_time}}" name="from_time" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">{{('End time')}}:</label>
                        <input type="time" class="form-control" value="{{$time_slot->to_time}}" name="to_time" required>
                    </div>
                    <div class="text-right">
                        <button type="button" onclick="addslot({{$time_slot->time_slot_id}})" class="btn btn-primary">{{('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('script_2')
    <!-- Page level plugins -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&callback=initMap&v=3.49" ></script>
    <script>
        const myLatLng = { lat: {{$restaurant->tour_lat}}, lng: {{$restaurant->tour_lng}} };
        let map;
        initMap();
        function initMap() {
                 map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: myLatLng,
            });
            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "{{$restaurant->tour_title}}",
            });
        }
    </script>
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });

            $('#column2_search').on('keyup', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('change', function () {
                datatable
                    .columns(3)
                    .search(this.value)
                    .draw();
            });

            $('#column4_search').on('keyup', function () {
                datatable
                    .columns(4)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

    function request_alert(url, message) {
        Swal.fire({
            title: '{{('are_you_sure')}}',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '{{('no')}}',
            confirmButtonText: '{{('yes')}}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        })
    }

    function addslot(time_slot_id)
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
            url: '{{ route('panel.Restaurant.add-time-slot') }}',
            data: $('.add-schedule' + time_slot_id).serializeArray(),
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
            } else {
                $('#schedule').empty().html(response.view);
                $('#exampleModal' + time_slot_id).modal('hide');
                toastr.success('{{('Timeslot added successfully')}}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }

    function onoffslot(time_slot_id,restaurant_id)
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
            url: '{{ route('panel.Restaurant.close-time-slot') }}',
            data: {time_slot_id:time_slot_id,restaurant_id:restaurant_id},
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
            } else {
                if ($('#stocksCheckbox2'+time_slot_id).is(":checked"))
                {
                    $('#mon'+time_slot_id).show();
                    $('#tue'+time_slot_id).show();
                    $('#wed'+time_slot_id).show();
                    $('#thu'+time_slot_id).show();
                    $('#fri'+time_slot_id).show();
                    $('#sat'+time_slot_id).show();
                    $('#sun'+time_slot_id).show();
                }
                else
                {
                    $('#mon'+time_slot_id).hide();
                    $('#tue'+time_slot_id).hide();
                    $('#wed'+time_slot_id).hide();
                    $('#thu'+time_slot_id).hide();
                    $('#fri'+time_slot_id).hide();
                    $('#sat'+time_slot_id).hide();
                    $('#sun'+time_slot_id).hide();
                }
                toastr.success('{{('Status changed')}}', {
                    CloseButton: true,
                    ProgressBar: true
                });

                location.reload();
            }
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }

    </script>
@endpush
