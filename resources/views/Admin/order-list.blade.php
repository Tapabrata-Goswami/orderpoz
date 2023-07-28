@extends('Admin.app')

@section('title',('Booking List'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: transparent;
        }
        .select2-container--default .select2-selection--multiple {
            border-color: #e7eaf300;
            padding: 0 .875rem;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
    @php($parcel_order = Request::is('panel/Order/list*'))
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('Dashboard')}}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{('Order')}}</li>
            </ol>
        </nav>
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center mb-3">
                <div class="col-9">
                    <h1 class="page-header-title text-capitalize">{{$status}} {{('Bookings')}}<span class="badge badge-soft-dark ml-2">{{ $orders->total() }}</span></h1>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header">
                <div class="row justify-content-between align-items-center flex-grow-1">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <form action="javascript:" id="search-form">
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                       placeholder="{{('search')}}" aria-label="{{('search')}}" required>
                                <input type="hidden" name="parcel_order" value="{{$parcel_order}}">
                                <button type="submit" class="btn btn-primary">{{('Search')}}</button>

                            </div>
                            <!-- End Search -->
                        </form>
                    </div>

                    <div class="col-lg-6">
                        <div class="d-sm-flex justify-content-sm-end align-items-sm-center">
                            <!-- Datatable Info -->
                            <div id="datatableCounterInfo" class="mr-2 mb-2 mb-sm-0" style="display: none;">
                                <div class="d-flex align-items-center">
                                      <span class="font-size-sm mr-3">
                                        <span id="datatableCounter">0</span>
                                        {{('selected')}}
                                      </span>
                                    {{--<a class="btn btn-sm btn-outline-danger" href="javascript:;">
                                        <i class="tio-delete-outlined"></i> Delete
                                    </a>--}}
                                </div>
                            </div>
                            <!-- End Datatable Info -->

                            <!-- Unfold -->
                            <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle" href="javascript:;"
                                   data-hs-unfold-options='{
                                     "target": "#usersExportDropdown",
                                     "type": "css-animation"
                                   }'>
                                    <i class="tio-download-to mr-1"></i> {{('export')}}
                                </a>

                                <div id="usersExportDropdown"
                                        class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                    <span class="dropdown-header">{{('options') }}</span>
                                    <a id="export-copy" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('back-end/assets') }}/back-end/svg/illustrations/copy.svg"
                                            alt="Image Description">
                                        {{('copy') }}
                                    </a>
                                    <a id="export-print" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('back-end/assets') }}/back-end/svg/illustrations/print.svg"
                                            alt="Image Description">
                                        {{('print') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">{{('download') }}
                                        {{('options') }}</span>
                                    <a id="export-excel" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('back-end/assets') }}/back-end/svg/components/excel.svg"
                                            alt="Image Description">
                                        {{('excel') }}
                                    </a>
                                    <a id="export-csv" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('back-end/assets') }}/back-end/svg/components/placeholder-csv-format.svg"
                                            alt="Image Description">
                                        .{{('csv') }}
                                    </a>
                                    <a id="export-pdf" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{ asset('back-end/assets') }}/back-end/svg/components/pdf.svg"
                                            alt="Image Description">
                                        {{('pdf') }}
                                    </a>
                                </div>
                            </div>
                            <!-- End Unfold -->
                            <!-- Unfold -->
                            <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white" href="javascript:;"
                                   onclick="$('#datatableFilterSidebar,.hs-unfold-overlay').show(500)">
                                    <i class="tio-filter-list mr-1"></i> Filters <span class="badge badge-success badge-pill ml-1" id="filter_count"></span>
                                </a>
                            </div>
                            <!-- End Unfold -->
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable"
                       class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       style="width: 100%"
                       data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "isResponsive": false,
                     "isShowPaging": false,
                     "paging": false
                   }'>
                    <thead class="thead-light">
                    <tr>
                        <th class="">{{('#')}}</th>
                        <th class="table-column-pl-0">{{('Order Id')}}</th>
                        <th>{{('Username')}}</th>
                        <th>{{('Restaurant Name')}}</th>
                        <th>{{('Order Type')}}</th>
                        <th>{{('Order')}} {{('Status')}}</th>
                        <th>{{('Payment Type')}}</th>
                        <th>{{('Total Amount')}}</th>
                        <th>{{('Order Date')}}</th>
                        <th>{{('Actions')}}</th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    @foreach($orders as $key=>$order)

                        <tr class="status-{{$order['order_status']}} class-all">
                            <td class="">
                                {{$key+$orders->firstItem()}}
                            </td>
                            <td class="table-column-pl-0">
                                <a href="{{route('panel.Order.detail',[$order['o_id']])}}">{{$order['order_id']}}</a>
                            </td>
                            
                            <td>{{$order['name']}}</td>
                            <td>{{$order['restaurant_name']}}</td>
                            <td>{{$order['order_type']}}</td>
                            <td class="text-capitalize">
                                @if($order['order_status']=='0')
                                    <span class="badge badge-soft-info ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-info"></span>{{('New')}}
                                    </span>
                                @elseif($order['order_status']=='1')
                                    <span class="badge badge-soft-primary ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-primary"></span>{{('Accepted')}}
                                    </span>
                                @elseif($order['order_status']=='2')
                                    <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-warning"></span>{{('Picked')}}
                                    </span>
                                @elseif($order['order_status']=='5')
                                    <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-danger"></span>{{('Rejected')}}
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
                            </td>
                            <td>{{$order['payment_type']}}</td>
                            <td>{{$order['grand_total']}}{{$order['country_currency']}}</td>
                            <td>{{date('d M Y H:i A',strtotime($order['created_at']))}}</td>
                            <td>
                                @if($order['order_status']=='0')
                                <a class="btn btn-sm btn-info" onclick="status_change_alert('{{ route('panel.Order.status', ['order_id' => $order['order_id'], 'order_status' => '1']) }}','Change status to accepted ?', event)"><i class="tio-checkmark-circle-outlined"></i> {{('Accept')}}</a>
                                <a class="btn btn-sm btn-danger" onclick="status_change_alert('{{ route('panel.Order.status', ['order_id' => $order['order_id'], 'order_status' => '4']) }}','Change status to cancelled ?', event)"><i class="tio-remove-from-trash"></i> {{('Cancel')}}</a>
                                @elseif($order['order_status']=='1')
                                <a class="btn btn-sm btn-warning" onclick="status_change_alert('{{ route('panel.Order.status', ['order_id' => $order['order_id'], 'order_status' => '2']) }}','Change status to picked ?', event)"><i class="tio-poi-user"></i> {{('Pick')}}</a>
                                @elseif($order['order_status']=='2')
                                <a class="btn btn-sm btn-success" onclick="status_change_alert('{{ route('panel.Order.status', ['order_id' => $order['order_id'], 'order_status' => '3']) }}','Change status to out for completed ?', event)"><i class="tio-checkmark-circle"></i> {{('Complete')}}</a>
                                @endif
                                <a class="btn btn-sm btn-secondary" href="{{route('panel.Order.detail',['o_id'=>$order['o_id']])}}"><i class="tio-visible"></i> </a>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                {{$orders->links()}}
            </div>
            @if(count($orders)==0)
                <div class="text-center p-4">
                    <img class="mb-3" src="{{asset('back-end/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                    <p class="mb-0">{{('No data to show')}}</p>
                </div>
            @endif
            <!-- End Footer -->
        </div>
        <!-- End Card -->
        <!-- Order Filter Modal -->
        <div id="datatableFilterSidebar" class="hs-unfold-content_ sidebar sidebar-bordered sidebar-box-shadow" style="display: none">
            <div class="card card-lg sidebar-card sidebar-footer-fixed">
                <div class="card-header">
                    <h4 class="card-header-title">{{('Order')}} {{('Filter')}}</h4>

                    <!-- Toggle Button -->
                    <a class="js-hs-unfold-invoker_ btn btn-icon btn-xs btn-ghost-dark ml-2" href="javascript:;"
                    onclick="$('#datatableFilterSidebar,.hs-unfold-overlay').hide(500)">
                        <i class="tio-clear tio-lg"></i>
                    </a>
                    <!-- End Toggle Button -->
                </div>
                <?php 
                $filter_count=0;

                if(isset($from_date) && isset($to_date)) $filter_count += 1;
                
                ?>
                <!-- Body -->
                <form class="card-body sidebar-body sidebar-scrollbar" action="{{route('panel.Order.filter')}}" method="POST" id="order_filter_form">
                    @csrf
                    <small class="text-cap mb-3">{{('Date')}} {{('Between')}}</small>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" style="margin:0;">
                                <input type="date" name="from_date" class="form-control" id="date_from" value="{{isset($from_date)?$from_date:''}}">
                            </div>
                        </div>
                        <div class="col-12 text-center">----TO----</div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="date" name="to_date" class="form-control" id="date_to" value="{{isset($to_date)?$to_date:''}}">
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer sidebar-footer">
                        <div class="row gx-2">
                            <div class="col">
                                <button type="reset" class="btn btn-block btn-white" id="reset">Clear all filters</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-block btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Footer -->
                </form>
            </div>
        </div>
        <!-- End Order Filter Modal -->
@endsection

@push('script_2')
    <!-- <script src="{{asset('back-end/assets')}}/js/bootstrap-select.min.js"></script> -->
    <script>
        function status_change_alert(url, message, e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href=url;
                }
            })
        }

        $(document).on('ready', function () {
            @if($filter_count>0)
            $('#filter_count').html({{$filter_count}});
            @endif
            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });

            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'excel',
                        className: 'd-none'
                    },
                    {
                        extend: 'csv',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        className: 'd-none'
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                // language: {
                //     zeroRecords: '<div class="text-center p-4">' +
                //         '<img class="mb-3" src="{{asset('assets/admin')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                //         '<p class="mb-0">No data to show</p>' +
                //         '</div>'
                // }
            });

            $('#export-copy').click(function () {
                datatable.button('.buttons-copy').trigger()
            });

            $('#export-excel').click(function () {
                datatable.button('.buttons-excel').trigger()
            });

            $('#export-csv').click(function () {
                datatable.button('.buttons-csv').trigger()
            });

            // $('#export-pdf').click(function () {
            //     datatable.button('.buttons-pdf').trigger()
            // });

            $('#export-print').click(function () {
                datatable.button('.buttons-print').trigger()
            });

            $('#datatableSearch').on('mouseup', function (e) {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function () {
                    var newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
            });

            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function () {
                var tagify = $.HSCore.components.HSTagify.init($(this));
            });

            $("#date_from").on("change", function () {
                $('#date_to').attr('min',$(this).val());
            });

            $("#date_to").on("change", function () {
                $('#date_from').attr('max',$(this).val());
            });

        });

        $('#reset').on('click', function(){
            // e.preventDefault();
            location.href = '{{url('/')}}/panel/Order/filter/reset';
        });

    </script>

    <script>
        $('#search-form').on('submit', function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get({
                url: '{{route('panel.Order.search')}}',
                data: $(this).serialize(),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('.card-footer').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
@endpush
