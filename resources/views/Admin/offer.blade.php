@extends('Admin.app')

@section('title', ('Offer List'))

@push('css_or_js')
    <link href="{{asset('back-end/assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="{{ asset('back-end/assets/back-end/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">  <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('panel.dashboard')}}">{{('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Offer')}}</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="d-md-flex_ align-items-center justify-content-between mb-2">
        <div class="row">
            <div class="col-md-8">
                <h3 class="h3 mb-0 text-black-50">{{('Offer')}} {{('List')}}</h3>
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
                                <div>{{('Offer Table')}} ({{ $coupon->total() }})</div>
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
                                           placeholder="{{('Search Offer')}}" aria-label="Search Offer"
                                           value="{{ $search }}" required>
                                    <button type="submit" class="btn btn-primary">{{('Search')}}</button>
                                </div>
                            </form>
                            <!-- End Search -->
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="javascript:" data-toggle="modal" data-target="#offer-modal" class="btn btn-primary">
                                <i class="tio-add-circle"></i>
                                <span class="text">{{('Add Offer')}}</span>
                            </a>
                        </div>

                        <div id="offer-modal" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-top-cover btn-secondary text-center">
                                        <figure class="position-absolute right-0 bottom-0 left-0" style="margin-bottom: -1px;">
                                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
                                                <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"/>
                                            </svg>
                                        </figure>

                                        <div class="modal-close">
                                            <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal" aria-label="Close">
                                                <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- End Header -->

                                    <div class="modal-top-cover-icon">
                                        <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">
                                            
                                            <i class="tio-add-circle"></i>
                                        </span>
                                    </div>

                                    <form action="{{route('panel.Offer.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            
                                            <div class="row mb-4">
                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                    {{('Country')}}
                                                </label>
                                                <div class="col-md-8 js-form-message">
                                                    <select name="country_id" id="country_id" class="form-control" required data-toggle="tooltip" title="{{('country') }}">
                                                    @foreach($country as $con)
                                                        <option value="{{$con->country_id}}">{{$con->country_name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                    {{('Offer Title')}}
                                                </label>
                                                <div class="col-md-8 js-form-message">
                                                    <input type="text" class="form-control" name="coupon_title" value="" required>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                    {{('Offer Code')}}
                                                </label>
                                                <div class="col-md-8 js-form-message">
                                                    <input type="text" class="form-control" name="coupon_code" value="" required>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                    {{('Offer Type')}}
                                                </label>
                                                <div class="col-md-8 js-form-message">
                                                    <select name="coupon_type" id="coupon_type" data-maximum-selection-length="50" class="form-control js-select2-custom" required >
                                                        <option value="">Select Offer Type</option>
                                                        <option value="0">Flat</option>
                                                        <option value="1">Percent</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                    {{('Discount')}}
                                                </label>
                                                <div class="col-md-8 js-form-message">
                                                    <input type="number" class="form-control" name="amount_percent" value="" required>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                    {{('Validity')}}
                                                </label>
                                                <div class="col-md-8 js-form-message">
                                                    <input type="date" class="form-control" name="coupon_validity" value="" required>
                                                </div>
                                            </div>

                                            {{-- <div class="row mb-4">
                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                    {{('Offer Description')}}
                                                </label>
                                                <div class="col-md-8 js-form-message">
                                                    <textarea name="coupon_description" class="form-control ckeditor" cols="100" rows="2" ></textarea>
                                                </div>
                                            </div> --}}

                                            <div class="row mb-4">
                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center" >{{('image')}}</label>
                                                <div class="col-md-8">
                                                <div class="custom-file">
                                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                                        accept=".jpg, .png, .jpeg|image/*" required>

                                                    <label class="custom-file-label" for="customFileEg1">{{('choose')}} {{('file')}}</label>

                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom:0%;">
                                                <center>
                                                    <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer"
                                                        @if(isset($coupon['coupon_image']))
                                                        src="{{asset('image')}}/{{$coupon['coupon_image']}}"
                                                        @else
                                                        src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                                        @endif
                                                        alt="image"/>
                                                </center>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">{{('close')}}</button>
                                            <button type="submit" class="btn btn-primary">{{('Add')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                                <th>{{('Country')}}</th>
                                <th>{{('Title')}}</th>
                                <th>{{('Code')}}</th>
                                <th>{{('Type')}}</th>
                                <th>{{('Discount')}}</th>
                                <th>{{('Image')}}</th>
                                {{-- <th>{{('Description')}}</th> --}}
                                <th>{{('Created')}}</th>
                                <th>{{('Active/Inactive')}}</th>
                                <th style="width: 5px" class="text-center">{{('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupon as $key=>$o)
                                <tr>
                                    <td>{{$key+$coupon->firstItem()}}</td>
                                    <td>{{$o['country_name']}}</td>
                                    <td>{{$o['coupon_title']}}</td>
                                    <td>{{$o['coupon_code']}}</td>
                                    <td>{!! $o->coupon_type=='1'?'Percent':'Flat' !!}</td>
                                    <td>{{$o['amount_percent']}}@if($o->coupon_type==1)% @else{{$o['country_currency']}} @endif</td>
                                    <td><img class="mb-3" src="{{asset('image')}}/{{$o['coupon_image']}}" style="width: 4rem;"></td>
                                    {{-- <td>{{$o['coupon_description']}}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse( $o->created_at )->format('d/m/Y') }}</td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox{{$o->coupon_id}}">
                                            <input type="checkbox" onclick="status_change_alert('{{route('panel.Offer.status-update',[$o->coupon_id,$o->coupon_status?0:1])}}', '{{('You want to change this offer status')}}', event)" class="toggle-switch-input" id="stocksCheckbox{{$o->coupon_id}}" {{$o->coupon_status?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <a class="btn btn-white btn-sm"
                                        href="javascript:" data-toggle="modal" data-target="#edit-modal{{$o->coupon_id}}" title="Edit Customer">
                                            <i class="tio-edit text-primary"></i>
                                        </a>
                                       
                                    </td>
                                </tr>

                                <div id="edit-modal{{$o->coupon_id}}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <!-- Header -->
                                        <div class="modal-top-cover btn-secondary text-center">
                                            <figure class="position-absolute right-0 bottom-0 left-0" style="margin-bottom: -1px;">
                                                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
                                                    <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"/>
                                                </svg>
                                            </figure>

                                            <div class="modal-close">
                                                <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal" aria-label="Close">
                                                    <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill="currentColor"
                                                                d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- End Header -->

                                        <div class="modal-top-cover-icon">
                                            <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">
                                                
                                                <i class="tio-add-circle"></i>
                                            </span>
                                        </div>

                                        <form action="{{route('panel.Offer.update')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                
                                                <div class="row mb-4">
                                                    <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                        {{('Country')}}
                                                    </label>
                                                    <div class="col-md-8 js-form-message">
                                                        <select name="country_id" id="country_id" class="form-control" required data-toggle="tooltip" title="{{('Country') }}">
                                                            @foreach($country as $con)
                                                                <option value="{{$con->country_id}}"
                                                                @if(!empty($coupon))
                                                                    @if($o->country_id == $con->country_id)
                                                                        selected
                                                                    @endif
                                                                @endif>{{$con->country_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                        {{('Offer Title')}}
                                                    </label>
                                                    <div class="col-md-8 js-form-message">
                                                        <input type="text" class="form-control" name="coupon_title" value="{{$o['coupon_title']}}" required>
                                                        <input type="hidden" class="form-control" name="coupon_id" value="{{$o['coupon_id']}}" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                        {{('Offer Code')}}
                                                    </label>
                                                    <div class="col-md-8 js-form-message">
                                                        <input type="text" class="form-control" name="coupon_code" value="{{$o['coupon_code']}}" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                        {{('Offer Type')}}
                                                    </label>
                                                    <div class="col-md-8 js-form-message">
                                                        <select name="coupon_type" id="coupon_type" data-maximum-selection-length="50" class="form-control js-select2-custom" required >
                                                            <option value="0"
                                                            @if(!empty($coupon))
                                                                @if($o->coupon_type == 0)
                                                                    selected
                                                                @endif
                                                            @endif>Flat</option>
                                                            <option value="1"
                                                            @if(!empty($coupon))
                                                                @if($o->coupon_type == 1)
                                                                    selected
                                                                @endif
                                                            @endif>Percent</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                        {{('Discount')}}
                                                    </label>
                                                    <div class="col-md-8 js-form-message">
                                                        <input type="number" class="form-control" name="amount_percent" value="{{$o['amount_percent']}}" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                        {{('Validity')}}
                                                    </label>
                                                    <div class="col-md-8 js-form-message">
                                                        <input type="date" class="form-control" name="coupon_validity" value="{{$o['coupon_validity']}}" required>
                                                    </div>
                                                </div>

                                                {{-- <div class="row mb-4">
                                                    <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">
                                                        {{('Offer Description')}}
                                                    </label>
                                                    <div class="col-md-8 js-form-message">
                                                        <textarea name="coupon_description" class="form-control ckeditor" cols="100" rows="2" >{{$o['coupon_description']}}</textarea>
                                                    </div>
                                                </div> --}}

                                                <div class="row mb-4">
                                                    <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center" >{{('image')}}</label>
                                                    <div class="col-md-8">
                                                    <div class="custom-file">
                                                        <input type="file" name="image" id="customFileEg2{{$o['coupon_id']}}" class="custom-file-input" accept=".jpg, .png, .jpeg|image/*" onchange="imagechange({{$o['coupon_id']}},this)">

                                                        <label class="custom-file-label" for="customFileEg2{{$o['coupon_id']}}">{{__('choose')}} {{__('file')}}</label>

                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom:0%;">
                                                    <center>
                                                        <img style="width: 150px;border: 1px solid; border-radius: 10px;" id="viewer2{{$o['coupon_id']}}"
                                                            @if(isset($o['coupon_image']))
                                                                src="{{asset('image')}}/{{$o['coupon_image']}}"
                                                            @else
                                                                src="{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}"
                                                            @endif
                                                            alt="image"/>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white" data-dismiss="modal">{{('close')}}</button>
                                                <button type="submit" class="btn btn-primary">{{('Add')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$coupon->links()}}
                </div>
                @if(count($coupon)==0)
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
    <!-- <script src="{{asset('back-end/assets')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('back-end/assets')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
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
                //         '<img class="mb-3" src="{{ asset('back-end/assets') }}/back-end/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
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

<script>
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

        function readURL2(id,input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer2'+id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function imagechange(id,img)
        {
            readURL2(id,img);
        }
    </script>

@endpush
