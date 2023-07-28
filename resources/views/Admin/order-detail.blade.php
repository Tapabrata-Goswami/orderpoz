@extends('Admin.app')

@section('title', 'Order Details')

@push('css_or_js')
    <style>
        .item-box {
            height: 250px;
            width: 150px;
            padding: 3px;
        }

        .header-item {
            width: 10rem;
        }

    </style>
@endpush

@section('content')
    <?php
    $campaign_order = isset($order->details[0]->campaign) ? true : false;
    ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item">
                                <a class="breadcrumb-link" href="{{ route('panel.Order.list', ['status' => 'all']) }}">
                                    {{('Order') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{('Order') }}
                                {{('Details') }}</li>
                        </ol>
                    </nav>

                    <div class="d-sm-flex align-items-sm-center">
                        <h1 class="page-header-title">{{('Order') }} #{{ $order['order_id'] }}</h1>

                        @if ($order['order_status'] == '0')
                            <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">
                                <span class="legend-indicator bg-info text"></span>{{('New') }}
                            </span>
                        @elseif($order['order_status'] == '1')
                            <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize">
                                <span class="legend-indicator bg-info"></span>{{('Accepted') }}
                            </span>
                        @elseif($order['order_status'] == '5')
                            <span class="badge badge-danger ml-2 ml-sm-3 text-capitalize">
                                <span class="legend-indicator bg-warning"></span>{{('Rejected') }}
                            </span>
                        @elseif($order['order_status'] == '4')
                            <span class="badge badge-danger ml-2 ml-sm-3 text-capitalize">
                                <span class="legend-indicator bg-warning"></span>{{('Cancelled') }}
                            </span>
                        @elseif($order['order_status'] == '3')
                            <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize">
                                <span class="legend-indicator bg-success"></span>{{('Completed') }}
                            </span>
                        @else
                            <span class="badge badge-soft-danger ml-2 ml-sm-3 text-capitalize">
                                <span
                                    class="legend-indicator bg-danger"></span>{{ str_replace('_', ' ', $order['order_status']) }}
                            </span>
                        @endif
                        <span class="badge badge-danger ml-2 ml-sm-3 text-capitalize">
                            {{ $order['order_type'] }}
                        </span>
                        <span class="ml-2 ml-sm-3">
                            <i class="tio-date-range"></i>
                            {{ date('d M Y H:i A' . config('timeformat'), strtotime($order['created_at'])) }}
                        </span>

                        {{--<div class="hs-unfold float-right">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{('Status') }}
                                </button>
                                
                                <div class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item {{ $order['order_status'] == '0' ? 'active' : '' }}"
                                        onclick="route_alert('{{ route('panel.Order.status', ['o_id' => $order['o_id'], 'order_status' => '0']) }}','Change status to new ?')"
                                        href="javascript:">{{('New') }}</a>
                                    <a class="dropdown-item {{ $order['order_status'] == '1' ? 'active' : '' }}"
                                        onclick="route_alert('{{ route('panel.Order.status', ['o_id' => $order['o_id'], 'order_status' => '1']) }}','Change status to accepted ?')"
                                        href="javascript:">{{('accepted') }}</a>
                                    <a class="dropdown-item {{ $order['order_status'] == '2' ? 'active' : '' }}"
                                        onclick="route_alert('{{ route('panel.Order.status', ['o_id' => $order['o_id'], 'order_status' => '5']) }}','Change status to rejected ?')"
                                        href="javascript:">{{('Rejected') }}</a>
                                    <a class="dropdown-item {{ $order['order_status'] == '3' ? 'active' : '' }}"
                                        onclick="route_alert('{{ route('panel.Order.status', ['o_id' => $order['o_id'], 'order_status' => '4']) }}','Change status to cancelled ?')"
                                        href="javascript:">{{('Cancelled') }}</a>
                                    <a class="dropdown-item {{ $order['order_status'] == '4' ? 'active' : '' }}"
                                        onclick="route_alert('{{ route('panel.Order.status', ['o_id' => $order['o_id'], 'order_status' => '3']) }}','Change status to out for completed ?')"
                                        href="javascript:">{{('Completed') }}</a>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>

                <div class="col-sm-auto">
                    <a class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle mr-1"
                        href="{{ route('panel.Order.detail', [$order['o_id'] - 1]) }}" data-toggle="tooltip"
                        data-placement="top" title="Previous order">
                        <i class="tio-arrow-backward btn"></i>
                    </a>
                    <a class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                        href="{{ route('panel.Order.detail', [$order['o_id'] + 1]) }}" data-toggle="tooltip"
                        data-placement="top" title="Next order">
                        <i class="tio-arrow-forward btn"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <!-- Card -->
                <div class="card mb-3 mb-lg-5">
                    <!-- Header -->
                    <div class="card-header" style="display: block!important;">
                        <div class="row">
                            <div class="col-12 pb-2 d-flex justify-content-between">
                                <h4 class="card-header-title">
                                    {{('Item') }} {{('Details') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        
                    <div class="table-responsive datatable-custom">
                                <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                                        "columnDefs": [{ "targets": [0], "orderable": false }], "order": [], "info": { "totalQty": "#datatableWithPaginationInfoTotalQty" }, "search": "#datatableSearch", "entries": "#datatableEntries", "pageLength": 25, "isResponsive": false, "isShowPaging": false, "paging":false }'>
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{('Category')}}</th>
                                        <th>{{('Item Name')}}</th>
                                        <th>{{('Price')}}</th>
                                        <th>{{('QTY')}}</th>
                                        <th>{{('Total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_menu_item as $key=>$o_list)
                                        <tr>
                                            <td>{{($o_list['cat_name'])}}</td>
                                            <td>{{($o_list['menu_title'])}} @if($o_list['add_on_name'] != 'N/A') ({{($o_list['add_on_name'])}}) @endif</td>
                                            <!-- <td>{{ Str::limit($o_list['menu_title'], 20, '...') }}</td> -->
                                            <td>{{($o_list['per_menu_price'])}}{{$order['country_currency']}}</td>
                                            <td>{{ $o_list['menu_qty'] }}</td>
                                            <td>{{ $o_list['total_menu_price'] }}{{$order['country_currency']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>

                        <div class="row justify-content-md-end mb-3">
                            <div class="col-md-9 col-lg-8">
                                <dl class="row text-sm-right">
                                    <dt class="col-sm-6">{{('Basic Amount')}}:</dt>
                                    <dd class="col-sm-6">+ {{ isset($order['basic_amount']) ? $order['basic_amount'] : '0.00' }}{{$order['country_currency']}} <hr></dd>

                                    <dt class="col-sm-6">{{('Shipping Charge') }}:</dt>
                                    <dd class="col-sm-6">+ {{ isset($order['shipping_charge']) ? $order['shipping_charge'] : '0.00' }}{{$order['country_currency']}} <hr></dd>

                                    <dt class="col-sm-6">{{('Offer Code') }}:</dt>
                                    <dd class="col-sm-6">{{ isset($order['coupon_code']) ? $order['coupon_code'] : 'N/A' }}</dd>

                                    <dt class="col-sm-6">{{('Offer Amount') }}:</dt>
                                    <dd class="col-sm-6">- {{ isset($order['coupon_amount']) ? $order['coupon_amount'] : '0.00' }}{{$order['country_currency']}} <hr></dd>

                                    <dt class="col-sm-6">{{('Final Amount') }}:</dt>
                                    <dd class="col-sm-6">
                                        <b class="badge badge-danger" style="font-size: 100%;">{{$order->grand_total}}{{$order['country_currency']}}</b>
                                    </dd>
                                </dl>
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-4">
                <!-- Customer Card -->
                <div class="card mb-2">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title">{{('User') }}</h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <a class="media align-items-center deco-none" href="#">
                        <div class="avatar avatar-circle mr-3">

                            <img class="avatar-img" style="width: 75px"
                                onerror="this.src='{{ asset('back-end/assets/back-end/img/160x160/img1.jpg') }}'"
                                src="{{ asset('image/'.$order->image) }}"
                                alt="Image Description">

                        </div>
                        <div class="media-body">
                            <span class="text-body text-hover-primary">{{$order['name']}}</span><br>
                            <span class="badge badge-ligh">{{ App\Models\order_detail::where('user_id',$order['id'])->count() }} {{('Orders') }}</span>
                        </div>
                        </a>
                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <h5>{{('Contact') }} {{('Info') }}</h5>
                        </div>

                        <ul class="list-unstyled list-unstyled-py-2">
                            @if($order['order_type']=='Pickup')
                                <li>
                                    <i class="tio-user mr-2"></i>
                                    {{ $order['name'] }}
                                </li>
                                <li>
                                    <i class="tio-online mr-2"></i>
                                    {{ $order['email'] }}
                                </li>
                                <li>
                                    <a class="deco-none" href="tel:{{ $order['mobile'] }}">
                                        <i class="tio-android-phone-vs mr-2"></i>
                                        {{ $order['mobile'] }}
                                    </a>
                                </li>
                                <li>
                                    <i class="tio-city mr-2"></i>
                                    <a target="_blank" href="https://maps.google.com/maps?z=12&t=m&q=loc:{{$order['gps_lat']}}+{{$order['gps_lng']}}">{{ $order['gps_address'] }}</a>
                                </li>
                            @else
                                <li>
                                    <i class="tio-user mr-2"></i>
                                    {{ $order['user_name'] }}
                                </li>
                                <li>
                                    <i class="tio-online mr-2"></i>
                                    {{ $order['user_email'] }}
                                </li>
                                <li>
                                    <a class="deco-none" href="tel:{{ $order['user_mobile'] }}">
                                        <i class="tio-android-phone-vs mr-2"></i>
                                        {{ $order['user_mobile'] }}
                                    </a>
                                </li>
                                <li>
                                    <i class="tio-city mr-2"></i>
                                    {{ $order['house_flat_no'] }}, {{ $order['road_area_name'] }}-{{ $order['pincode'] }}
                                </li>
                                <li>
                                    <i class="tio-city mr-2"></i>
                                    <a target="_blank" href="https://maps.google.com/maps?z=12&t=m&q=loc:{{$order['gps_lat']}}+{{$order['gps_lng']}}">{{ $order['gps_address'] }}</a>
                                </li>
                            @endif
                        </ul>

                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
                <!-- Restaurant Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title">{{('Restaurant') }}</h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <a class="media align-items-center deco-none"
                            href="@if(\App\CPU\Helpers::module_permission_check('restaurant_section')){{ route('panel.Restaurant.detail', [$order['restaurant_id']]) }}@else#@endif">
                            <div class="avatar avatar-circle mr-3">
                                <img class="avatar-img" style="width: 75px"
                                    onerror="this.src='{{ asset('back-end/assets/back-end/img/160x160/img1.jpg') }}'"
                                    src="{{ asset('image/'.$order->restaurant_image)}}"
                                    alt="Image Description">
                            </div>
                            <div class="media-body">
                                <span
                                    class="text-body text-hover-primary text-break">{{ $order->restaurant_name }} ({{ $order->outlet_area }})</span><br>
                                <span class="badge badge-ligh">{{ App\Models\order_detail::where('restaurant_id',$order['restaurant_id'])->count() }}
                                    {{('Restaurant Orders') }}</span>
                            </div>
                        </a>
                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <h5>{{('Restaurant') }} {{('info') }}</h5>
                        </div>

                        <ul class="list-unstyled list-unstyled-py-2">
                            <li>
                                <i class="tio-online mr-2"></i>
                                {{$order['restaurant_email']}}
                            </li>
                            <li>
                                <i class="tio-android-phone-vs mr-2"></i>
                                {{ $order['restaurant_mobile'] }}
                                </a>
                            </li>
                            <li>
                                <i class="tio-city mr-2"></i>
                                <a target="_blank" href="https://maps.google.com/maps?z=12&t=m&q=loc:{{$order['outlet_gps_lat']}}+{{$order['outlet_gps_lng']}}">{{ $order['outlet_gps_address'] }}</a>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>

@endsection

@push('script_2')

    
    
@endpush
