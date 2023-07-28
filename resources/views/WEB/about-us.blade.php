@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))

@section('content')

    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        <img src="{{asset('front-end/assets')}}/images/inner-bg.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="breadcrumb-content">
            <div>
                <h2>about</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">about</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="title-breadcrumb">ORDERPOZ</div>
    </section>
    <!-- breadcrumb end -->

    <!-- about 3 start -->
    <section class="about_section section-b-space">
        <div class="container">
            <div class="title-3">
                <span class="title-label">history of</span>
                <h2>our restaurant<span>restaurant</span></h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="about_img">
                        <div class="side-effect"><span></span></div>
                        <img src="{{asset('front-end/assets')}}/images/restaurant/about.jpg" class="img-fluid blur-up lazyload" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about_content">
                        <div>
                            {!! nl2br(@$detail['about_us']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about 3 end -->
    @endsection