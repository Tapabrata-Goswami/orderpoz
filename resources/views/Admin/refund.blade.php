@extends('Admin.app')

@section('title', ('Refund Policy'))

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
                <li class="breadcrumb-item" aria-current="page">{{('Refund Policy')}}</li>
            </ol>
        </nav>
        
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('panel.Detail.change-refund')}}" method="POST" enctype="multipart/form-data" id="mobile-info">
                @csrf
                    <div class="card">
                        <div class="card-header">
                        <h5>{{ ('Refund Policy')}}</h5>
                        </div>
                        <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group lang_form" id="form">
                                        <textarea name="refund_policy" class="form-control ckeditor" cols="100" rows="2" >@if(!empty($refund)){{$refund->refund_policy}}@endif</textarea>
                                    </div>
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
        alignment: {
            options: [ 'left', 'right' ]
        },
    });

    $(".js-example-theme-single").select2({
            theme: "classic"
        });
    $(".js-example-responsive").select2({
            width: 'resolve'
        });
</script>
@endpush
