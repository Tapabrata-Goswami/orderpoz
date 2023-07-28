@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))

@section('content')
<style>
    p {
        color:black;
    }
    </style>
    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        <img src="{{asset('front-end/assets')}}/images/inner-bg.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="breadcrumb-content">
            <div>
                <h2>Terms & Condition</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Terms & Condition</li>
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
                <h2>our restaurant<span>restaurant</span></h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                        <div>
                            {!! nl2br(@$detail['tc']) !!}
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about 3 end -->
    @endsection