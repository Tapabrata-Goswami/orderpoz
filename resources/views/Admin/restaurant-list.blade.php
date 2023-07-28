@extends('Admin.app')

@section('title', ('Restaurant List'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">  <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Restaurant')}}</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="d-md-flex_ align-items-center justify-content-between mb-2">
        <div class="row">
            <div class="col-md-8">
                <h3 class="h3 mb-0 text-black-50">{{('Restaurant')}} {{('List')}}</h3>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row flex-between justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 mb-1 col-md-2">
                            <h5 class="flex-between">
                                <div>{{('Restaurant Table')}} ({{ $restaurant->total() }})</div>
                            </h5>
                        </div>
                        <div class="col-12 mb-1 col-md-5" style="width: 40vw">
                            <!-- Search -->
                            <form action="{{ url()->current() }}" method="GET">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                           placeholder="{{('Search Restaurant')}}" aria-label="Search Restaurant"
                                           value="{{ $search }}" required>
                                    <button type="submit" class="btn btn-primary">{{('Search')}}</button>
                                </div>
                            </form>
                            <!-- End Search -->
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{route('panel.Restaurant.add-restaurant')}}" class="btn btn-primary  float-right">
                                <i class="tio-add-circle"></i>
                                <span class="text">{{('Add New Restaurant')}}</span>
                            </a>
                        </div>

                        <div class="col-12 col-md-1">
                            <div class="d-sm-flex justify-content-sm-end align-items-sm-center">

                                <!-- Unfold -->
                                <div class="hs-unfold mr-2">
                                    <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle" href="javascript:;"
                                        data-hs-unfold-options='{
                                                "target": "#usersExportDropdown",
                                                "type": "css-animation"
                                            }'>
                                        <i class="tio-download-to mr-1"></i> {{('export') }}
                                    </a>

                                    <div id="usersExportDropdown"
                                        class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                        <span class="dropdown-header">{{('options') }}</span>
                                        <a id="export-copy" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('back-end/assets/back-end') }}/svg/illustrations/copy.svg"
                                                alt="Image Description">
                                            {{('copy') }}
                                        </a>
                                        <a id="export-print" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('back-end/assets/back-end') }}/svg/illustrations/print.svg"
                                                alt="Image Description">
                                            {{('print') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <span class="dropdown-header">{{('download') }}
                                            {{('options') }}</span>
                                        <a id="export-excel" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('back-end/assets/back-end') }}/svg/components/excel.svg"
                                                alt="Image Description">
                                            {{('excel') }}
                                        </a>
                                        <a id="export-csv" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('back-end/assets/back-end') }}/svg/components/placeholder-csv-format.svg"
                                                alt="Image Description">
                                            .{{('csv') }}
                                        </a>
                                        <a id="export-pdf" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('back-end/assets/back-end') }}/svg/components/pdf.svg"
                                                alt="Image Description">
                                            {{('pdf') }}
                                        </a>
                                    </div>
                                </div>
                                <!-- End Unfold -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive datatable-custom">
                        <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                                "columnDefs": [{ "targets": [0], "orderable": false }], "order": [], "info": { "totalQty": "#datatableWithPaginationInfoTotalQty" }, "search": "#datatableSearch", "entries": "#datatableEntries", "pageLength": 25, "isResponsive": false, "isShowPaging": false, "paging":false }'>
                            <thead class="thead-light">
                            <tr>
                                <th>{{('#')}}</th>
                                <th>{{('Restaurant Name')}}</th>
                                <th>{{('Mobile')}}</th>
                                <th>{{('Email')}}</th>
                                <th>{{('Category')}}</th>
                                <th>{{('Country')}}</th>
                                <th>{{('Image')}}</th>
                                <th>{{('Created')}}</th>
                                <th>{{('Book Table')}}</th>
                                <th>{{('Multiple')}}<br>{{('Outlet')}}</th>
                                <th>{{('Active/Inactive')}}</th>
                                <th>{{('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($restaurant as $key=>$t)
                                <tr>
                                    <td scope="row">{{$key+$restaurant->firstItem()}}</td>
                                    <td>{{ isset($t['restaurant_name']) ? $t['restaurant_name'] : 'N/A' }}<br><a href="{{route('restaurant-order',[$t['restaurant_name_code']])}}">{{route('restaurant-order',[$t['restaurant_name_code']])}}</a></td>
                                    <td>{{ isset($t['restaurant_mobile']) ? $t['restaurant_mobile'] : 'N/A' }}</td>
                                    <td>{{ isset($t['restaurant_email']) ? $t['restaurant_email'] : 'N/A' }}</td>
                                    <td>
                                        @php
                                        $cnt=1;
                                         $cat_list= App\Models\restaurant_category::leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->where('restaurant_categories.restaurant_id',$t['restaurant_id'])->groupby('restaurant_categories.cat_id')->get(); 
                                        
                                        @endphp
                                        @foreach($cat_list as $key=>$list)
                                            <span class="badge badge-soft-danger">
                                            <span class="legend-indicator bg-danger"></span>{{$list->cat_name}}</span>
                                            @if($cnt==3 || $cnt==6 || $cnt==9) <br> @endif
                                            @php $cnt++; @endphp
                                        @endforeach
                                    </td>
                                    <td>{{ isset($t['country_name']) ? $t['country_name'] : 'N/A' }}
                                    <td><img src="@if(empty($t['restaurant_image'])) {{asset('back-end/assets/back-end/img/160x160/img1.jpg')}} @else {{asset('image')}}/{{$t->restaurant_image}} @endif" style="width: 4rem;height: 4rem;"  onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}'"></td>
                                    <td>{{ \Carbon\Carbon::parse( $t->created_at )->format('d/m/Y') }}</td>

                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox{{$t->restaurant_id}}">
                                            <input type="checkbox" onclick="status_change_alert('{{route('panel.Restaurant.status-update-book-table',[$t->restaurant_id,$t->book_table?0:1])}}', '{{('You want to change this book a table status')}}', event)" class="toggle-switch-input" id="stocksCheckbox{{$t->restaurant_id}}" {{$t->book_table?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox1{{$t->restaurant_id}}">
                                            <input type="checkbox" onclick="status_change_alert('{{route('panel.Restaurant.status-update-multiple-outlet',[$t->restaurant_id,$t->is_outlet?0:1])}}', '{{('You want to change this multiple outlet status')}}', event)" class="toggle-switch-input" id="stocksCheckbox1{{$t->restaurant_id}}" {{$t->is_outlet?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox2{{$t->restaurant_id}}">
                                            <input type="checkbox" onclick="status_change_alert('{{route('panel.Restaurant.status-update',[$t->restaurant_id,$t->restaurant_status?0:1])}}', '{{('You want to change this restaurant status')}}', event)" class="toggle-switch-input" id="stocksCheckbox2{{$t->restaurant_id}}" {{$t->restaurant_status?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <a class="btn btn-white btn-sm"
                                            href="{{route('panel.Restaurant.edit',[$t['restaurant_id']])}}" title="Edit Restaurant">
                                            <i class="tio-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-white" href="{{route('panel.Restaurant.detail',[$t['restaurant_id']])}}" title="View Restaurant" target="_blank"><i class="tio-visible text-success"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$restaurant->links()}}
                </div>
                @if(count($restaurant)==0)
                    <div class="text-center p-4">
                        <img class="mb-3" src="{{asset('back-end/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                        <p class="mb-0">{{('No data to show')}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <!-- Page level custom scripts -->
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
