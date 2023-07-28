@extends('Admin.app')

@section('title', ('Sub Admin List'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">  <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Sub Admin')}}</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="d-md-flex_ align-items-center justify-content-between mb-2">
        <div class="row">
            <div class="col-md-8">
                <h3 class="h3 mb-0 text-black-50">{{('Sub Admin')}} {{('List')}}</h3>
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
                                <div>{{('Sub Admin Table')}} ({{ $subadmin->total() }})</div>
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
                                           placeholder="{{('Search Subadmin')}}" aria-label="Search Subadmin"
                                           value="{{ $search }}">
                                    <button type="submit" class="btn btn-primary">{{('Search')}}</button>
                                </div>
                            </form>
                            <!-- End Search -->
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{route('panel.Subadmin.add-subadmin')}}" class="btn btn-primary  float-right">
                                <i class="tio-add-circle"></i>
                                <span class="text">{{('Add New Sub Admin')}}</span>
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
                                                src="{{ asset('assets/back-end') }}/svg/illustrations/copy.svg"
                                                alt="Image Description">
                                            {{('copy') }}
                                        </a>
                                        <a id="export-print" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('assets/back-end') }}/svg/illustrations/print.svg"
                                                alt="Image Description">
                                            {{('print') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <span class="dropdown-header">{{('download') }}
                                            {{('options') }}</span>
                                        <a id="export-excel" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('assets/back-end') }}/svg/components/excel.svg"
                                                alt="Image Description">
                                            {{('excel') }}
                                        </a>
                                        <a id="export-csv" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('assets/back-end') }}/svg/components/placeholder-csv-format.svg"
                                                alt="Image Description">
                                            .{{('csv') }}
                                        </a>
                                        <a id="export-pdf" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="{{ asset('assets/back-end') }}/svg/components/pdf.svg"
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
                                <th>{{('Name')}}</th>
                                <th>{{('Email')}}</th>
                                <th>{{('Modules')}}</th>
                                <th>{{('Created')}}</th>
                                <th>{{('Active/Inactive')}}</th>
                                <th>{{('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subadmin as $key=>$s)
                                <tr>
                                    <td scope="row">{{$key+$subadmin->firstItem()}}</td>
                                    <td>{{ isset($s['name']) ? $s['name'] : 'N/A' }}</td>
                                    <td>{{ isset($s['email']) ? $s['email'] : 'N/A' }}</td>
                                    <td class="text-capitalize">
                                            @if($s['module_access']!=null)
                                                @foreach((array)json_decode($s['module_access']) as $m)
                                                    {{str_replace('_',' ',$m)}} <br>
                                                @endforeach
                                            @endif
                                        </td>
                                    <td>{{ \Carbon\Carbon::parse( $s->created_at )->format('d/m/Y') }}</td>
                                   <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox{{$s->id}}">
                                            <input type="checkbox" onclick="status_change_alert('{{route('panel.Subadmin.status-update',[$s->id ,$s->status?0:1])}}', '{{('You want to change this Subadmin status')}}', event)" class="toggle-switch-input" id="stocksCheckbox{{$s->id}}" {{$s->status?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                       <a class="btn btn-white btn-sm"
                                            href="{{route('panel.Subadmin.edit',[$s['id']])}}" title="Edit Subadmin">
                                            <i class="tio-edit"></i>
                                        </a>
                                        <a class="btn btn-white btn-sm" href="javascript:"
                                            onclick="status_change_alert('{{route('panel.Subadmin.delete-subadmin',[$s->id])}}','{{('Want to delete this subadmin ?')}}',event)">
                                            <i class="tio-delete-outlined text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$subadmin->links()}}
                </div>
                @if(count($subadmin)==0)
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
