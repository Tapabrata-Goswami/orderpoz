@extends('Admin.app')

@section('title', ('Sub Admin'))

@push('css_or_js')
    <link href="{{asset('assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
<style>
    .footer {
        position: fixed !important;
    }
</style>
@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('Sub Admin')}}</a>
                </li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="{{route('panel.Subadmin.store')}}" method="POST"
                      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                      enctype="multipart/form-data"
                      id="subadmin_form">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Sub Admin Form</h4>
                        </div>
                        
                        
                        <div class="card-body">
                            <div id="Product-form">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Name </label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Subadmin Name" value="@if(!empty($subadmin)){{$subadmin->name}}@endif" required>
                                            <input type="hidden" name="id" value="@if(!empty($subadmin)){{$subadmin->id}}@endif" id="id">
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="email">Email </label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Subadmin Email" value="@if(!empty($subadmin)){{$subadmin->email}}@endif" required>
                                        </div>
                                        
                                    </div>
                                </div>

                                {{--<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="mobile">Mobile </label>
                                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Enter Subadmin Mobile" value="@if(!empty($subadmin)){{$subadmin->mobile}}@endif" required>
                                        </div>
                                        
                                    </div>
                                </div>--}}
                                
                               @if(!empty($subadmin->password))
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                        <label class="input-label"for="exampleFormControlInput1">@if(!empty($subadmin)) {{('Password')}} <small>( enter if you want to change )</small> @else {{('Password')}} @endif</label>
                                        <input type="text" name="password" class="form-control" placeholder="Enter Password" value="">
                                </div>
                                    </div>
                                </div>
                                @else
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                        <label class="input-label"for="exampleFormControlInput1">@if(!empty($subadmin)) {{('Password')}} <small>( enter if you want to change )</small> @else {{('Password')}} @endif</label>
                                        <input type="text" name="password" class="form-control" placeholder="Enter Password" value="" required>
                                </div>
                                    </div>
                                </div>
                                @endif
                                

                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <label for="exampleFormControlInput1">{{ ('Module Permission') }} </label>
                                    <select name="module_access[]" id="module_access" data-maximum-selection-length="50" class="form-control js-select2-custom" required multiple=true data-toggle="tooltip" title="{{('Module Permission') }}">
                                        <option value="category_section" @if(!empty($subadmin)) {{in_array('category_section',(array)json_decode($subadmin['module_access']))?'selected':''}}
                                        @endif>Category Section</option>
                                        <option value="user_section" @if(!empty($subadmin)) {{in_array('user_section',(array)json_decode($subadmin['module_access']))?'selected':''}}
                                        @endif>User Section</option>
                                        <option value="restaurant_section" @if(!empty($subadmin)) {{in_array('restaurant_section',(array)json_decode($subadmin['module_access']))?'selected':''}}
                                        @endif>Restaurant Section</option>
                                        <option value="order_section" @if(!empty($subadmin)) {{in_array('order_section',(array)json_decode($subadmin['module_access']))?'selected':''}}
                                        @endif>Order Section</option>
                                        <option value="slider_section" @if(!empty($subadmin)) {{in_array('slider_section',(array)json_decode($subadmin['module_access']))?'selected':''}}
                                        @endif>Slider & Offer Section</option>
                                        <option value="blog_section" @if(!empty($subadmin)) {{in_array('blog_section',(array)json_decode($subadmin['module_access']))?'selected':''}}
                                        @endif>Blog Section</option>
                                        <option value="notification_section" @if(!empty($subadmin)) {{in_array('notification_section',(array)json_decode($subadmin['module_access']))?'selected':''}}
                                        @endif>Notification Section</option>
                                        <option value="others" @if(!empty($subadmin)) {{in_array('others',(array)json_decode($subadmin['module_access']))?'selected':''}}
                                        @endif>Other Section</option>
                                    </select>
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
<script>
    function getRequest(route, id, type) {
        $.get({
            url: route,
            dataType: 'json',
            success: function (data) {
                if (type == 'select') {
                    $('#city_id').empty().append(data.select_tag);
                }
            },
        });
    }
</script>
@endpush
