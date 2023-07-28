@extends('Admin.app')

@section('title', ('User Notification'))

@push('css_or_js')
    <link href="{{asset('back-end/assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="{{ asset('back-end/assets/back-end/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('User Notification')}}</a>
                </li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="{{route('panel.Detail.noti')}}" method="POST"
                      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                      enctype="multipart/form-data"
                      id="turf_form">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{('Custom Notification')}}</h4>
                        </div>
                        <div class="card-body">
                            <div id="Product-form">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="user_key">{{('Select')}} </label>
                                            <select class="form-control js-select2-custom" name="data" style="width: 100%" required>
                                                <option value="" selected disabled>{{('Select')}}</option>
                                                    <option value="user">User</option>
                                                    <option value="restaurant">Restaurant</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="user_key">{{('Message')}} </label>
                                            <input type="text" name="user_key" id="user_key" class="form-control" placeholder="Enter Message" value="@if(!empty($detail)){{$detail->user_key}}@endif" required>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-footer">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 20px">
                                <button type="submit" class="btn btn-primary">{{('Submit')}}</button>
                            </div>
                        </div>
                    </div>
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
</script>
<script src="{{asset('back-end/assets/js/spartan-multi-image-picker.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'turf_image[]',
                maxCount: 6,
                rowHeight: '120px',
                groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: "{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}",
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error("{{('please only input png or jpg type file')}}", {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error("{{('file size too big')}}", {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
@endpush