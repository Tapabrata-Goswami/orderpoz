@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))
@push('css_or_js')
@endpush
@section('content')
    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        <img src="{{asset('front-end/assets')}}/images/inner-bg.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="breadcrumb-content pt-0">
            <div>
                <h2>blog</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">blog</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="title-breadcrumb">ORDERPOZ</div>
    </section>
    <!-- breadcrumb end -->

    <!-- blog detail section start -->
    <section class="section-b-space bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="blog-single-detail">
                        <div class="top-image">
                            <img src="{{asset('image')}}/{{$blog->blog_image}}" alt="" class="img-fluid blur-up lazyload" style="width: 100%;height: 350px;">
                        </div>
                        <div class="title-part">
                            <ul class="post-detail">
                                <li>{{ \Carbon\Carbon::parse( $blog->created_at )->format('M d, Y') }}</li>
                                <li>Posted By : {{$blog->blog_person}}</li>
                            </ul>
                            <h3>{{$blog->blog_title}}</h3>
                        </div>
                        <div class="detail-part">
                            <p>{{$blog->blog_description}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sticky-cls-top">
                        <div class="blog-sidebar">
                            <div class="blog-wrapper">
                                <div class="sidebar-title">
                                    <h5>recent post</h5>
                                </div>
                                <div class="sidebar-content">
                                    <ul class="blog-post">
                                        @foreach($recent as $r)
                                        <li>
                                            <div class="media">
                                                <a href="{{route('blog-detail',[$r['blog_id']])}}"><img class="img-fluid blur-up lazyload"
                                                    src="{{asset('image')}}/{{$r->blog_image}}"
                                                    alt="Generic placeholder image" style="height:73px;"></a>
                                                <div class="media-body align-self-center">
                                                    <div>
                                                        <h6>{{ \Carbon\Carbon::parse( $r->created_at )->format('M d, Y') }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog detail section end -->
    @endsection
    @push('script')
    @endpush
