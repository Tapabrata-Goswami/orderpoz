@extends('Admin.app')

@section('title', ('Order Report'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="media mb-3">
                <!-- Avatar -->
                <div class="avatar avatar-xl avatar-4by3 {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">
                    <img class="avatar-img" src="{{asset('back-end/assets/back-end')}}/svg/illustrations/order.png"
                         alt="Image Description">
                </div>
                <!-- End Avatar -->

                <div class="media-body">
                    <div class="row">
                        <div class="col-lg mb-3 mb-lg-0 {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                             style="display: block; text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <div>
                                <h1 class="page-header-title">{{('Order')}} {{('Report')}}  {{('Overview')}}</h1>
                            </div>

                            <div class="row align-items-center">
                                <div class="flex-between col-auto">
                                    <h5 class="text-muted {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}">{{('Restaurant')}}
                                        :</h5>
                                    <h5 class="text-muted">@if($restaurant_id==0) All Restaurant @else {{App\Models\restaurant::where('restaurant_id',$restaurant_id)->first()->restaurant_name;}} @endif</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="row align-items-center g-0">
                                        <h5 class="text-muted col-auto {{Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'}}">{{('Date')}}</h5>

                                        <!-- Flatpickr -->
                                        <h5 class="text-muted">( {{$from}} - {{$to}}
                                            )</h5>
                                        <!-- End Flatpickr -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-auto">
                            <div class="d-flex">
                                <a class="btn btn-icon btn-primary rounded-circle" href="{{route('panel.dashboard')}}">
                                    <i class="tio-home-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Media -->

            <!-- Nav -->
            <!-- Nav -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}"></i>
              </a>
            </span>

                <span class="hs-nav-scroller-arrow-next" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"></i>
              </a>
            </span>

                <ul class="nav nav-tabs page-header-tabs" id="projectsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:">{{('Overview')}}</a>
                    </li>
                </ul>
            </div>
            <!-- End Nav -->
        </div>
        <!-- End Page Header -->

        <div class="row border-bottom border-right border-left border-top">
            <div class="col-lg-12">
                <form action="{{route('panel.Report.order-data')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">{{('Show data by date range')}}</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <input type="date" value="{{$from}}" name="from_date" id="from_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <input type="date" name="to_date" value="{{$to}}" id="to_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <select class="form-control js-select2-custom" name="restaurant_id" style="width: 100%" required>
                                    <option value="" selected disabled>{{('Select Restaurant')}}</option>
                                    @foreach($restaurant as $p)
                                        <option value="{{$p->restaurant_id}}"
                                        @if(!empty($restaurant))
                                            @if($restaurant_id == $p->restaurant_id)
                                                selected
                                            @endif
                                        @endif>{{$p->restaurant_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-block">{{('Show')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @if($restaurant_id==0)
                @php
                $cancelled=0;
                    $pending=\App\Models\order_detail::where('order_status','0')->whereDate('created_at', Carbon\Carbon::today())->count();

                    $accepted=\App\Models\order_detail::where('order_status','1')->whereDate('created_at', Carbon\Carbon::today())->count();

                    $cancel=\App\Models\order_detail::whereDate('created_at', Carbon\Carbon::today())->where('order_status','4')->count();
                    $reject=\App\Models\order_detail::whereDate('created_at', Carbon\Carbon::today())->where('order_status','5')->count();
                    $cancelled=$reject + $cancel;

                    $completed=\App\Models\order_detail::where('order_status','3')->whereDate('created_at', Carbon\Carbon::today())->count();
                @endphp
            @else
                @php
                $cancelled=0;
                    $pending=\App\Models\order_detail::where('restaurant_id',$restaurant_id)->where('order_status','0')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();

                    $accepted=\App\Models\order_detail::where('restaurant_id',$restaurant_id)->where('order_status','1')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();

                    $cancel=\App\Models\order_detail::where('restaurant_id',$restaurant_id)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->where('order_status','4')->count();
                    $reject=\App\Models\order_detail::where('restaurant_id',$restaurant_id)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->where('order_status','5')->count();

                    $cancelled=$reject + $cancel;

                    $completed=\App\Models\order_detail::where('restaurant_id',$restaurant_id)->where('order_status','3')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->count();
                @endphp
            @endif
            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-6">
            
            <!-- Card -->
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- Media -->
                                <a href="{{route('panel.Order.list', ['new'])}}">
                                <div class="media">
                                    <i class="tio-shopping-cart text-info nav-icon"></i>

                                    <div class="media-body">
                                        <h4 class="mb-1">{{('New Order')}}</h4>
                                    </div>
                                </div>
                                </a>
                                <!-- End Media -->
                            </div>

                            <div class="col-auto">
                                <h3><span class="font-size text-info">
                                    <i class="tio-trending-up"></i> {{$pending}}
                                </span></h3>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-6">
            <!-- Card -->
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- Media -->
                                <a href="{{route('panel.Order.list', ['accepted'])}}">
                                <div class="media">
                                    <i class="tio-checkmark-circle-outlined text-warning nav-icon"></i>

                                    <div class="media-body">
                                        <h4 class="mb-1">{{('Accepted')}}</h4>
                                    </div>
                                </div>
                                </a>
                                <!-- End Media -->
                            </div>

                            <div class="col-auto">
                                <h3><span class="font-size text-warning">
                                    <i class="tio-trending-up"></i> {{$accepted}}
                                </span></h3>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-6">
            <!-- Card -->
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- Media -->
                                <a href="{{route('panel.Order.list', ['cancelled'])}}">
                                <div class="media">
                                    <i class="tio-remove-from-trash text-danger nav-icon"></i>

                                    <div class="media-body">
                                        <h4 class="mb-1">{{('Cancel/Reject')}}</h4>
                                    </div>
                                </div>
                                </a>
                                <!-- End Media -->
                            </div>

                            <div class="col-auto">
                                <h3><span class="font-size text-danger">
                                    <i class="tio-trending-up"></i> {{$cancelled}}
                                </span></h3>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-6">
            <!-- Card -->
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- Media -->
                                <a href="{{route('panel.Order.list', ['completed'])}}">
                                <div class="media">
                                    <i class="tio-checkmark-circle text-success nav-icon"></i>

                                    <div class="media-body">
                                        <h4 class="mb-1">{{('Completed')}}</h4>
                                    </div>
                                </div>
                                </a>
                                <!-- End Media -->
                            </div>

                            <div class="col-auto">
                                <h3><span class="font-size text-success">
                                    <i class="tio-trending-up"></i> {{$completed}}
                                </span></h3>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Stats -->
        <hr>

        <div class="row">
            <div class="col-lg-12 mb-3 mb-lg-12">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title">{{('Weekly')}} {{('Report')}} </h4>

                        <!-- Nav -->
                        <ul class="nav nav-segment" id="eventsTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="this-week-tab" data-toggle="tab" href="#this-week"
                                   role="tab">
                                    {{('This')}} {{('week')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="last-week-tab" data-toggle="tab" href="#last-week" role="tab">
                                    {{('Last')}} {{('week')}}
                                </a>
                            </li>
                        </ul>
                        <!-- End Nav -->
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body card-body-height">
                    @php
                        $orders= \App\Models\order_detail::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->paginate(30);
                    @endphp
                    <!-- Tab Content -->
                        <div class="tab-content" id="eventsTabContent">
                            <div class="tab-pane fade show active" id="this-week" role="tabpanel"
                                 aria-labelledby="this-week-tab">
                                <!-- Card -->
                                @foreach($orders as $order)
                                    <a class="card card-border-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} border-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}-primary shadow-none rounded-0"
                                       href="{{route('panel.Order.detail',['o_id'=>$order['o_id']])}}">
                                        <div class="card-body py-0">
                                            <div class="row">
                                                <div class="col-sm mb-2 mb-sm-0">
                                                    <h2 class="font-weight-normal mb-1">#{{$order['order_id']}} <small
                                                            class="font-size-sm text-body text-uppercase">{{('Order')}} {{('ID')}}</small>
                                                    </h2>
                                                    <h5 class="text-hover-primary mb-0">{{('Booking')}} {{('Amount')}}
                                                        : {{$order['grand_total']}}₹</h5>
                                                    <small
                                                        class="text-body">{{date('d M Y',strtotime($order['created_at']))}}</small>
                                                </div>

                                                <div class="col-sm-auto align-self-sm-end">
                                                    <!-- Avatar Group -->
                                                    <div class="">
                                                        {{('Status')}} : @if($order['order_status']=='0')
                                                                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-info"></span>{{('New')}}
                                                                </span>
                                                            @elseif($order['order_status']=='1')
                                                                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-info"></span>{{('Accepted')}}
                                                                </span>
                                                            @elseif($order['order_status']=='5')
                                                                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-warning"></span>{{('Rejected')}}
                                                                </span>
                                                            @elseif($order['order_status']=='4')
                                                                <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-danger"></span>{{('Cancelled')}}
                                                                </span>
                                                            @elseif($order['order_status']=='3')
                                                                <span class="badge badge-soft-success ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-success"></span>{{('Completed')}}
                                                                </span>
                                                            @endif
                                                        <br>
                                                    </div>
                                                    <!-- End Avatar Group -->
                                                </div>
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </a>
                                    <!-- End Card -->
                                    <hr>
                                @endforeach
                                <div class="card">
                                    <div class="card-footer">
                                        {!! $orders->links() !!}
                                    </div>
                                </div>
                            </div>

                            @php
                                $orders= \App\Models\order_detail::whereBetween('created_at', [now()->subDays(7)->startOfWeek(), now()->subDays(7)->endOfWeek()])->paginate(30);
                            @endphp

                            <div class="tab-pane fade" id="last-week" role="tabpanel" aria-labelledby="last-week-tab">
                                @foreach($orders as $order)
                                    <a class="card card-border-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} border-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}-primary shadow-none rounded-0"
                                       href="{{route('panel.Order.detail',['o_id'=>$order['o_id']])}}">
                                        <div class="card-body py-0">
                                            <div class="row">
                                                <div class="col-sm mb-2 mb-sm-0">
                                                    <h2 class="font-weight-normal mb-1">#{{$order['order_id']}} <small class="font-size-sm text-body text-uppercase">{{('Order ID')}}</small>
                                                    </h2>
                                                    <h5 class="text-hover-primary mb-0">{{('Booking')}} {{('Amount')}}
                                                        : {{$order['grand_total']}}₹</h5>
                                                    <small class="text-body">{{date('d M Y',strtotime($order['created_at']))}}</small>
                                                </div>

                                                <div class="col-sm-auto align-self-sm-end">
                                                    <!-- Avatar Group -->
                                                    <div class="text-capitalize">
                                                        {{('Status')}} <strong>
                                                            : @if($order['order_status']=='0')
                                                                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-info"></span>{{('New')}}
                                                                </span>
                                                            @elseif($order['order_status']=='1')
                                                                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-info"></span>{{('Accepted')}}
                                                                </span>
                                                            @elseif($order['order_status']=='5')
                                                                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-warning"></span>{{('Rejected')}}
                                                                </span>
                                                            @elseif($order['order_status']=='4')
                                                                <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-danger"></span>{{('Cancelled')}}
                                                                </span>
                                                            @elseif($order['order_status']=='3')
                                                                <span class="badge badge-soft-success ml-2 ml-sm-3">
                                                                <span class="legend-indicator bg-success"></span>{{('Completed')}}
                                                                </span>
                                                            @endif
                                                            <br></strong>
                                                    </div>
                                                    <!-- End Avatar Group -->
                                                </div>
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </a>
                                    <!-- End Card -->
                                    <hr>
                                @endforeach
                                <div class="card">
                                    <div class="card-footer">
                                        {!! $orders->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Tab Content -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>
@endsection

@push('script')

@endpush

@push('script_2')

    <script src="{{asset('assets/back-end')}}/vendor/chart.js/dist/Chart.min.js"></script>
    <script
        src="{{asset('assets/back-end')}}/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js"></script>
    <script src="{{asset('assets/back-end')}}/js/hs.chartjs-matrix.js"></script>

    <script>
        $(document).on('ready', function () {

            // INITIALIZATION OF FLATPICKR
            // =======================================================
            $('.js-flatpickr').each(function () {
                $.HSCore.components.HSFlatpickr.init($(this));
            });


            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function () {
                new HsNavScroller($(this)).init()
            });


            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format('MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);


            // INITIALIZATION OF CHARTJS
            // =======================================================
            $('.js-chart').each(function () {
                $.HSCore.components.HSChartJS.init($(this));
            });

            var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));

            // Call when tab is clicked
            $('[data-toggle="chart"]').click(function (e) {
                let keyDataset = $(e.currentTarget).attr('data-datasets')

                // Update datasets for chart
                updatingChart.data.datasets.forEach(function (dataset, key) {
                    dataset.data = updatingChartDatasets[keyDataset][key];
                });
                updatingChart.update();
            })


            // INITIALIZATION OF MATRIX CHARTJS WITH CHARTJS MATRIX PLUGIN
            // =======================================================
            function generateHoursData() {
                var data = [];
                var dt = moment().subtract(365, 'days').startOf('day');
                var end = moment().startOf('day');
                while (dt <= end) {
                    data.push({
                        x: dt.format('YYYY-MM-DD'),
                        y: dt.format('e'),
                        d: dt.format('YYYY-MM-DD'),
                        v: Math.random() * 24
                    });
                    dt = dt.add(1, 'day');
                }
                return data;
            }

            $.HSCore.components.HSChartMatrixJS.init($('.js-chart-matrix'), {
                data: {
                    datasets: [{
                        label: 'Commits',
                        data: generateHoursData(),
                        width: function (ctx) {
                            var a = ctx.chart.chartArea;
                            return (a.right - a.left) / 70;
                        },
                        height: function (ctx) {
                            var a = ctx.chart.chartArea;
                            return (a.bottom - a.top) / 10;
                        }
                    }]
                },
                options: {
                    tooltips: {
                        callbacks: {
                            title: function () {
                                return '';
                            },
                            label: function (item, data) {
                                var v = data.datasets[item.datasetIndex].data[item.index];

                                if (v.v.toFixed() > 0) {
                                    return '<span class="font-weight-bold">' + v.v.toFixed() + ' hours</span> on ' + v.d;
                                } else {
                                    return '<span class="font-weight-bold">No time</span> on ' + v.d;
                                }
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                            position: 'bottom',
                            type: 'time',
                            offset: true,
                            time: {
                                unit: 'week',
                                round: 'week',
                                displayFormats: {
                                    week: 'MMM'
                                }
                            },
                            ticks: {
                                "labelOffset": 20,
                                "maxRotation": 0,
                                "minRotation": 0,
                                "fontSize": 12,
                                "fontColor": "rgba(22, 52, 90, 0.5)",
                                "maxTicksLimit": 12,
                            },
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            type: 'time',
                            offset: true,
                            time: {
                                unit: 'day',
                                parser: 'e',
                                displayFormats: {
                                    day: 'ddd'
                                }
                            },
                            ticks: {
                                "fontSize": 12,
                                "fontColor": "rgba(22, 52, 90, 0.5)",
                                "maxTicksLimit": 2,
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    }
                }
            });


            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function () {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });


            // INITIALIZATION OF CIRCLES
            // =======================================================
            $('.js-circle').each(function () {
                var circle = $.HSCore.components.HSCircles.init($(this));
            });
        });
    </script>

    <script>
        $('#from_date,#to_date').change(function () {
            let fr = $('#from_date').val();
            let to = $('#to_date').val();
            if (fr != '' && to != '') {
                if (fr > to) {
                    $('#from_date').val('');
                    $('#to_date').val('');
                    toastr.error('{{('Invalid date range')}}!', Error, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            }

        })
    </script>
@endpush
