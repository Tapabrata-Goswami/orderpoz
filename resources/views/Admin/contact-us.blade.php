@extends('Admin.app')

@section('title', ('Contact-Us'))

@push('css_or_js')
    <link href="{{asset('back-end/assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="{{asset('back-end/assets/back-end/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .tox-tinymce-aux{
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('Contact-Us')}}</li>
            </ol>
        </nav>
        
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('panel.Detail.change-contact-us')}}" method="POST" enctype="multipart/form-data" id="mobile-info">
                @csrf
                    <div class="card">
                        <div class="card-header">
                        <h5>{{ ('Contact Us')}}</h5>
                        </div>
                        <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{('Contact Mobile No.')}}</label>
                                    <input type="text" name="contact_mobile" id="contact_mobile" class="form-control" placeholder="Enter Mobile No." value="@if(!empty($contact)){{$contact->contact_mobile}}@endif" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="10" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="name">{{('Contact Email Id')}}</label>
                                    <input type="email" name="contact_email" id="contact_email" class="form-control" placeholder="Enter Email Id" value="@if(!empty($contact)){{$contact->contact_email}}@endif" required>
                                </div>
                            </div>   
                        </div>
                    </div>

                    <hr>
                        <button type="submit" class="btn btn-primary">{{('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });

    $(".js-example-theme-single").select2({
            theme: "classic"
        });
    $(".js-example-responsive").select2({
            width: 'resolve'
        });
</script>
@endpush
