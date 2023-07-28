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


    <!-- blog section start -->
    <section class="section-b-space bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_section section-b-space ratio_55">
                        <div class="row">
                            @foreach($blog as $b)
                            <div class="col-lg-4 col-md-6">
                                <div class="blog-wrap">
                                    <div class="blog-image">
                                        <div>
                                            <img src="{{asset('image')}}/{{$b->blog_image}}" class="img-fluid blur-up lazyload bg-img"
                                                alt="">
                                        </div>
                                        <div class="blog-label">
                                            <div>
                                                <h3>{{ \Carbon\Carbon::parse( $b->created_at )->format('d') }}</h3>
                                                <h6>{{ \Carbon\Carbon::parse( $b->created_at )->format('M') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h6><i class="fas fa-user-alt"></i>{{$b->blog_person}}</h6>
                                        <a href="{{route('blog-detail',[$b['blog_id']])}}">
                                            <h5>{!! nl2br(@substr($b->blog_title, 0, 60)) !!}...</h5>
                                        </a>
                                        <p>{!! nl2br(@substr($b->blog_description, 0, 110)) !!}...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <nav aria-label="Page navigation example" class="pagination-section mt-0">
                            {!! $blog->links() !!}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog section end -->
    @endsection
    @push('script')
    @endpush