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
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',[$restaurant['restaurant_id']])}}">{{('Restaurant')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'review']) }}">{{('Review')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'outlet']) }}">{{('Outlets')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'booktable']) }}">{{('Booked Tables')}}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
    <!-- End Page Header -->
    
    <div class="tab-content">
        <div class="tab-pane fade show active" id="product">
            <div class="row pt-2">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="flex-start">
                                <div class="mx-1"><h3>{{('Booked Tables')}}</h3></div>
                                <div><h3><span style="color: red;">({{$booktable->total()}})</span></h3></div>
                            </div>
                        </div>
                        <div class="table-responsive datatable-custom">
                            <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                                    "columnDefs": [{ "targets": [0], "orderable": false }], "order": [], "info": { "totalQty": "#datatableWithPaginationInfoTotalQty" }, "search": "#datatableSearch", "entries": "#datatableEntries", "pageLength": 25, "isResponsive": false, "isShowPaging": false, "paging":false }'>
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{('SL#')}}</th>
                                        <th>{{('Username')}}</th>
                                        <th>{{('Booked Person Name')}}</th>
                                        <th>{{('Email')}}</th>
                                        <th>{{('Phone')}}</th>
                                        <th>{{('Booking Date')}}</th>
                                        <th>{{('Persons')}}</th>
                                        <th>{{('Date')}}</th>
                                    </tr>
                                </thead>

                                <tbody id="set-rows">
                                @foreach($booktable as $k=>$r)
                                <tr>
                                    <td>{{$booktable->firstItem()+$k}}</td>
                                    <td>{{$r->name}}</td>
                                    <td>{{$r->firstname}} {{$r->lastname}}</td>
                                    <td>{{$r->email}}</td>
                                    <td>{{$r->phone}}</td>
                                    <td>{{ \Carbon\Carbon::parse( $r->date_time )->format('d/m/Y H:i A') }}</td>
                                    <td>{{$r->person}}</td>
                                    <td>{{ \Carbon\Carbon::parse( $r->created_at )->format('d/m/Y') }}</td>
                                </tr>

                            @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                    {{$booktable->links()}}
                </div>
                @if(count($booktable)==0)
                    <div class="text-center p-4">
                        <img class="mb-3" src="{{asset('back-end/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                        <p class="mb-0">{{('No data to show')}}</p>
                    </div>
                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
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

        // Call the dataTables jQuery plugin
        $(document).on('ready', function() {
            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function() {
                new HsNavScroller($(this)).init()
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
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
                //         '<img class="mb-3" src="{{ asset('assets/admin') }}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                //         '<p class="mb-0">No data to show</p>' +
                //         '</div>'
                // }
            });

            $('#export-copy').click(function() {
                datatable.button('.buttons-copy').trigger()
            });

            $('#export-excel').click(function() {
                datatable.button('.buttons-excel').trigger()
            });

            $('#export-csv').click(function() {
                datatable.button('.buttons-csv').trigger()
            });

            $('#export-pdf').click(function() {
                datatable.button('.buttons-pdf').trigger()
            });

            $('#export-print').click(function() {
                datatable.button('.buttons-print').trigger()
            });

            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function() {
                var tagify = $.HSCore.components.HSTagify.init($(this));
            });
        });

    </script>
@endpush
