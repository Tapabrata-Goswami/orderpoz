@extends('Admin.app')
@section('title',('Dashboard'))
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .grid-card {
            border: 2px solid #00000012;
            border-radius: 10px;
            padding: 10px;
        }

        .label_1 {
            /*position: absolute;*/
            font-size: 10px;
            background: #FF4C29;
            color: #ffffff;
            width: 80px;
            padding: 2px;
            font-weight: bold;
            border-radius: 6px;
            text-align: center;
        }

        .center-div {
            text-align: center;
            border-radius: 6px;
            padding: 6px;
            border: 2px solid #8080805e;
        }

        .icon-card {
            background-color: #22577A;
            border-width: 30px;
            border-style: solid;
            border-color: red;
        }
    </style>
@endpush

@section('content')
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header" style="padding-bottom: 0!important;border-bottom: 0!important;margin-bottom: 1.25rem!important;">
                <div class="flex-between align-items-center">
                    <div>
                        <h1 class="page-header-title" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">{{('Dashboard')}}</h1>
                        <p>{{('Welcome')}} {{auth('admin')->user()->name}}.</p>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            @if(\App\CPU\Helpers::module_permission_check('order_section'))
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row flex-between gx-2 gx-lg-3 mb-2">
                        <div>
                            <h4><i style="font-size: 30px" class="tio-chart-bar-4"></i>Dashboard order statistics</h4>
                        </div>
                        <div class="col-12 col-md-4" style="width: 20vw">
                            <select class="custom-select" name="statistics_type" onchange="order_stats_update(this.value)">
                                <option value="overall" selected="">
                                    Overall statistics
                                </option>
                                <option value="today">
                                    Todays Statistics
                                </option>
                                <option value="this_month">
                                    This Months Statistics
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row gx-2 gx-lg-3" id="order_stats">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">

                            <a class="card card-hover-shadow h-100" href="{{route('panel.Order.list', ['new'])}}" style="background: #FFFFFF">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div style="text-align: left;">
                                            <h6 class="card-subtitle" style="color: #EF3F3E!important;">Pending</h6>
                                            <span class="card-title h2" style="color: #EF3F3E!important;">
                                            {{App\Models\order_detail::where('order_status',0)->count();}}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: #EF3F3E;"></i>
                                        </div>
                                    </div>

                                </div>
                            </a>

                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">

                            <a class="card card-hover-shadow h-100" href="{{route('panel.Order.list', ['accepted'])}}" style="background: #FFFFFF;">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div style="text-align: left;">
                                            <h6 class="card-subtitle" style="color: #EF3F3E!important;">Accepted</h6>
                                            <span class="card-title h2" style="color: #EF3F3E!important;">
                                            {{App\Models\order_detail::where('order_status',1)->count();}}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-checkmark-circle-outlined" style="font-size: 30px;color: #EF3F3E"></i>
                                        </div>
                                    </div>

                                </div>
                            </a>

                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">

                            <a class="card card-hover-shadow h-100" href="{{route('panel.Order.list', ['completed'])}}" style="background: #FFFFFF">
                                <div class="card-body">
                                    <div class="flex-between align-items-center gx-2 mb-1">
                                        <div style="text-align: left;">
                                            <h6 class="card-subtitle" style="color: #EF3F3E!important;">Completed</h6>
                                            <span class="card-title h2" style="color: #EF3F3E!important;">
                                            {{App\Models\order_detail::where('order_status',3)->count();}}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-checkmark-circle" style="font-size: 30px;color: #EF3F3E"></i>
                                        </div>
                                    </div>

                                </div>
                            </a>

                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">

                            <a class="card card-hover-shadow h-100" href="{{route('panel.Order.list', ['cancelled'])}}" style="background: #FFFFFFff">
                                <div class="card-body">
                                    <div class="flex-between align-items-center gx-2 mb-1">
                                        <div style="text-align: left;">
                                            <h6 class="card-subtitle" style="color: #EF3F3E!important;">Cancelled/Rejected</h6>
                                            <span class="card-title h2" style="color: #EF3F3E!important;">
                                            {{App\Models\order_detail::where('order_status',4)->orwhere('order_status',5)->count();}}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-remove-from-trash" style="font-size: 30px;color: #EF3F3E"></i>
                                        </div>
                                    </div>

                                </div>
                            </a>

                        </div>

                    </div>
                </div>
            </div>
            @endif

            {{--<div class="row gx-2 gx-lg-3">
                <div class="col-lg-12 mb-3 mb-lg-12">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Body -->
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 mb-3 border-bottom">
                                    <h5 class="card-header-title float-left mb-2">
                                        <i style="font-size: 30px" class="tio-chart-pie-1"></i>
                                        {{('Order amount statistics')}}
                                    </h5>
                                    <!-- Legend Indicators -->
                                    
                                    <!-- End Legend Indicators -->
                                </div>
                                <div class="col-md-4 col-12 graph-border-1">
                                    <div class="mt-2 center-div">
                                    <span class="h6 mb-0">
                                        <i class="legend-indicator bg-primary"
                                           style="background-color: #FFC074!important;"></i>
                                        {{('Total order amount')}} : {{App\Models\order_detail::sum('grand_total');}}$
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 graph-border-1">
                                    <div class="mt-2 center-div">
                                      <span class="h6 mb-0">
                                          <i class="legend-indicator bg-success"
                                             style="background-color: #B6C867!important;"></i>
                                         {{('Completed order amount')}} : {{App\Models\order_detail::where('order_status',3)->sum('grand_total');}}$
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 graph-border-1">
                                    <div class="mt-2 center-div">
                                      <span class="h6 mb-0">
                                          <i class="legend-indicator bg-danger"
                                             style="background-color: #01937C!important;"></i>
                                        {{('Cancelled order amount')}} : {{App\Models\order_detail::where('order_status',4)->sum('grand_total');}}$
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->

                            
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>
            </div>--}}

            <div class="row gx-2 gx-lg-3 mt-2">
                <div class="col-lg-6 mb-3">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Header -->
                        <div class="card-header">
                            <h5 class="card-header-title">
                                <i class="tio-company"></i> {{('Total overview')}}
                            </h5>
                            <i class="tio-chart-pie-1" style="font-size: 45px"></i>
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body" id="business-overview-board" style="direction: ltr">
                            <!-- Chart -->
                            <div class="chartjs-custom mx-auto">
                                <canvas id="business-overview" class="mt-2"></canvas>
                            </div>
                            <!-- End Chart -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>
                @if(\App\CPU\Helpers::module_permission_check('order_section'))
                <div class="col-lg-6 mb-3">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Header -->
                        <div class="card-header">
                            <h5 class="card-header-title">
                                <i class="tio-company"></i> {{('Top by order received')}}
                            </h5>
                            <i class="tio-award-outlined" style="font-size: 45px"></i>
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <div class="row">
                                @php($top = App\Models\order_detail::select('restaurant_id', DB::raw('COUNT(o_id) as count'))
                                ->groupBy('restaurant_id')
                                ->orderBy("count", 'desc')
                                ->take(6)
                                ->get())
                                @foreach($top as $key=>$t)
                                @php($restaurant=\App\Models\restaurant::where('restaurant_id',$t['restaurant_id'])->first())
                                <div class="col-6 col-md-4 mt-2" onclick="location.href='#'" style="padding-left: 6px;padding-right: 6px;cursor: pointer">
                                    <div class="grid-card" style="min-height: 170px">
                                        <div class="label_1 row-center">
                                            <div class="px-1">{{('Order')}} : </div>
                                            <div>{{$t['count']}}</div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <img style="border-radius: 50%;width: 60px;height: 60px;border:2px solid #80808082;" onerror="this.src='{{asset('back-end/assets/back-end/img/160x160/img1.jpg')}}'" src="@if(empty($restaurant['restaurant_image'])) {{asset('back-end/assets/back-end/img/160x160/img1.jpg')}} @else {{asset('image')}}/{{$restaurant['restaurant_image']}} @endif">
                                        </div>
                                        <div class="text-center mt-2">
                                            <span style="font-size: 10px">{{$restaurant['restaurant_name']??'Not exist'}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Body -->

                    </div>
                    <!-- End Card -->
                </div>
                @endif
                @if(\App\CPU\Helpers::module_permission_check('restaurant_section'))
                <div class="col-lg-6 mb-3">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Header -->
                        <div class="card-header">
                            <h5 class="card-header-title">
                                <i class="tio-align-to-top"></i> {{('Top Selling Items')}}
                            </h5>
                            <i class="tio-gift" style="font-size: 45px"></i>
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <div class="row">
                            @php($top_sell = App\Models\order_menu_item::select('order_menu_items.*', DB::raw('SUM(menu_qty) as count'))
                                ->groupBy('restaurant_cat_id')
                                ->orderBy("count", 'desc')
                                ->take(6)
                                ->get())
                                @foreach($top_sell as $key=>$item)
                                    
                                    <div class="col-md-4 col-6 mt-2"
                                        onclick="location.href='{{route('panel.Item.list')}}'"
                                        style="cursor: pointer;padding-right: 6px;padding-left: 6px">
                                        <div class="grid-card">
                                            <div class="label_1 row-center">
                                                <div class="px-1">{{('sold')}} : </div>
                                                <div>{{$item['count']}}</div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <img style="height: 90px;width:90px;"
                                                    src="{{asset('image')}}/{{$item['menu_image']}}"
                                                    onerror="this.src='{{asset('back-end/assets/back-end/img/160x160/img1.jpg')}}'"
                                                    alt="{{$item->menu_title}} image">
                                            </div>
                                            <div class="text-center mt-2">
                                                <span class=""
                                                    style="font-size: 10px">{{$item->menu_title}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                @endforeach
                            </div>
                        </div>
                        <!-- End Body -->


                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-lg-6 mb-3">
                    <!-- Card -->
                    <div class="card h-100">
                       <!-- Header -->
                        <div class="card-header">
                            <h5 class="card-header-title">
                                <i class="tio-star"></i> Newly Added Restaurants
                            </h5>
                            <i class="tio-shop" style="font-size: 45px"></i>
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table">
                                        <tbody>
                                        @php($new_restaurant = App\Models\restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->orderby('restaurants.restaurant_id','DESC')->get()->take(10))
                                        @foreach($new_restaurant as $key=>$new_res)
                                            <tr onclick="location.href='{{route('panel.Restaurant.list')}}'"
                                                style="cursor: pointer">
                                                <td scope="row">
                                                    <img height="35" width="38" style="border-radius: 5px"
                                                        src="@if(empty($new_res['restaurant_image'])) {{asset('back-end/assets/back-end/img/160x160/img1.jpg')}} @else {{asset('image')}}/{{$new_res['restaurant_image']}} @endif"
                                                        onerror="this.src='{{asset('back-end/assets/back-end/img/160x160/img1.jpg')}}'"
                                                        alt="{{$new_res->restaurant_name}} image">
                                                    <span class="ml-2">
                                                    {{$new_res['restaurant_name']??'Not exist'}}
                                                </span>
                                                </td>
                                                
                                                <td>
                                                    <span style="font-size: 14px">
                                                        {{$new_res['country_name']}} <i class="tio-city"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- End Body -->

                    </div>
                    <!-- End Card -->
                </div>
                @endif
                <div class="col-lg-6 mb-3">
                    <!-- Card -->
                    <div class="card h-100">
                        
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-lg-6 mb-3">
                    <!-- Card -->
                    <div class="card h-100">
                        
                    </div>
                    <!-- End Card -->
                </div>

            </div>
        </div>
    
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-12 mb-2 mb-sm-0">
                        <h3 class="text-center" style="color: gray">{{('Hi')}} {{auth('admin')->user()->name}}, {{('Welcome to Dashboard')}}.</h3>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
        </div>
@endsection

@push('script')
    <script src="{{asset('back-end/assets')}}/back-end/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{asset('back-end/assets')}}/back-end/vendor/chart.js.extensions/chartjs-extensions.js"></script>
    <script
        src="{{asset('back-end/assets')}}/back-end/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js"></script>
@endpush

@push('script_2')
    <script>
        // INITIALIZATION OF CHARTJS
        // =======================================================
        Chart.plugins.unregister(ChartDataLabels);

        $('.js-chart').each(function () {
            $.HSCore.components.HSChartJS.init($(this));
        });

        var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));
    </script>

    <script>
        var ctx = document.getElementById('business-overview');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    '{{('user')}} ( {{App\Models\User::count();}} )',
                    '{{('restaurant')}} ( {{App\Models\restaurant::count();}} )',
                    '{{('category')}} ( {{App\Models\category::count();}} )',
                    '{{('order')}} ( {{App\Models\order_detail::count();}} )',
                    '{{('items')}} ( {{App\Models\menu_item::count();}} )',
                ],
                datasets: [{
                    label: '{{('business')}}',
                    data: ['{{App\Models\User::count();}}', '{{App\Models\restaurant::count();}}', '{{App\Models\category::count();}}', '{{App\Models\order_detail::count();}}', '{{App\Models\menu_item::count();}}'],
                    backgroundColor: [
                        '#E1E8EB',
                        '#C84B31',
                        '#346751',
                        '#343A40',
                        '#7D5A50',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        function order_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('panel.order-stats')}}',
                data: {
                    statistics_type: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    $('#order_stats').html(data.view)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }

        function business_overview_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '#',
                data: {
                    business_overview: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    console.log(data.view)
                    $('#business-overview-board').html(data.view)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }
    </script>

@endpush



@section('title', ('Dashboard'))
