
@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))

@section('content')
<style>
    .animat span {
  position: relative;
  top: -10px;
  display: inline-block;
  animation: bounce .5s ease infinite alternate;
  font-family: 'Titan One', cursive;
  font-size: 35px;
  color: #FFF;
  text-shadow: 0 1px 0 #CCC,
               0 2px 0 #CCC,
               0 3px 0 #CCC,
               0 4px 0 #CCC,
               0 5px 0 #CCC,
               0 6px 0 transparent,
               0 7px 0 transparent,
               0 8px 0 transparent,
               0 9px 0 transparent,
               0 10px 10px rgba(0, 0, 0, .4);
}

.animat span:nth-child(2) { animation-delay: .1s; }
.animat span:nth-child(3) { animation-delay: .2s; }
.animat span:nth-child(4) { animation-delay: .3s; }
.animat span:nth-child(5) { animation-delay: .4s; }
.animat span:nth-child(6) { animation-delay: .5s; }
.animat span:nth-child(7) { animation-delay: .6s; }
.animat span:nth-child(8) { animation-delay: .7s; }

@keyframes bounce {
  100% {
    top: -20px;
    text-shadow: 0 1px 0 #CCC,
                 0 2px 0 #CCC,
                 0 3px 0 #CCC,
                 0 4px 0 #CCC,
                 0 5px 0 #CCC,
                 0 6px 0 #CCC,
                 0 7px 0 #CCC,
                 0 8px 0 #CCC,
                 0 9px 0 #CCC,
                 0 50px 25px rgba(0, 0, 0, .2);
  }
}
    </style>
    <!-- section start -->
    {{--<section class="order-food-section  pt-0">
        <img src="{{asset('front-end/assets')}}/images/restaurant/background/1.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="order-food">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="book-table section-b-space p-0 single-table">
                            <h3>The food you love, delivered with care</h3>
                            <div class="table-form">
                                <form>
                                    <div class="row w-100">
                                        <div class="form-group col-md-4">
                                            <input type="text" placeholder="enter your location" class="form-control">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <input type="text" placeholder="what are you craving?" class="form-control">
                                        </div>
                                        <div class="search col-md-3">
                                            <a href="#" class="btn btn-rounded color1">find food</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <!-- section end -->
<!-- home section start -->
    <section class="home_section hotel_layout slide-1 p-0">
        @foreach($slider as $slide)
        <div>
            <div class="home">
                <img src="{{asset('image')}}/{{$slide->slider_image}}" onerror="this.src='{{asset('front-end/assets')}}/images/restaurant/background/1.jpg'" class="img-fluid blur-up lazyload bg-img" alt="">
                {{--<div class="home-content">
                    <div>
                        <h1>{{$slide->restaurant_name}}</h1>
                        <h5>{{$slide->restaurant_name}}</h5>
                        <h2>Welcome</h2>
                        <a href="{{route('restaurant-order',['restaurant_name_code'=>$slide['restaurant_name_code']])}}" class="btn btn-solid ">book now</a>
                    </div>
                </div>--}}
            </div>
        </div>
        @endforeach
    </section>
    <!-- home section end -->

    <!-- collection banner -->
    {{--<section class="p-t-0 section-b-space ratio_40">
        <div class="container">
            <div class="row partition2">
                <div class="col-md-12">
                    <a href="{{url('restaurant-order')}}">
                        <div class="collection-banner p-left text-start">
                            <div class="img-part">
                                <img src="{{asset('front-end/assets')}}/images/restaurant/dishes/17.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="contain-banner">
                                <div>
                                    <h4>0% Comission based company</h4>
                                    <h2>0% Comission based company</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{url('restaurant-order')}}">
                        <div class="collection-banner p-right text-end">
                            <div class="img-part">
                                <img src="{{asset('front-end/assets')}}/images/restaurant/dishes/16.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="contain-banner">
                                <div>
                                    <h4>only $12</h4>
                                    <h2>tasty burger</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>--}}
    <!-- collection banner end -->

    <section class="discount-banner" style="padding: 0 0;    margin: 55px 0;">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10" style="margin-left: 10.33333%;">
                    <div class="banner-content col-12 row">
                        <h2 class="animat" style="width: 29%;margin: 35px 0;font-size: calc(30px + (95 - 30) * ((36vw - 320px) / (1920 - 320)));"><span>C</span><span>o</span><span>m</span><span>i</span><span>s</span><span>s</span><span>i</span><span>o</span><span>n</span></h2> 
                        <h2 class="animat" style="width: 13%;margin: 35px 0;font-size: calc(30px + (95 - 30) * ((36vw - 320px) / (1920 - 320)));"><span>f</span><span>r</span><span>e</span><span>e</span></h2> 
                        <h2 class="animat" style="width: 17%;margin: 35px 0;font-size: calc(30px + (95 - 30) * ((36vw - 320px) / (1920 - 320)));"><span>o</span><span>r</span><span>d</span><span>e</span><span>r</span></h2> 
                        <h2 class="animat" style="width: 20%;margin: 35px 0;font-size: calc(30px + (95 - 30) * ((36vw - 320px) / (1920 - 320)));"><span>o</span><span>n</span><span>l</span><span>i</span><span>n</span><span>e</span></h2> 
                        <h2 class="animat" style="width: 20%;margin: 35px 0;font-size: calc(30px + (95 - 30) * ((36vw - 320px) / (1920 - 320)));"><span>s</span><span>y</span><span>s</span><span>t</span><span>e</span><span>m</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- how to start section start -->
    <section class="section-b-space process-steps parallax-img">
        <img src="{{asset('front-end/assets')}}/images/restaurant/bg-4.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
        <div class="parallax-effect">
            <div class="food-img food1">
                <img src="{{asset('front-end/assets')}}/images/restaurant/food/1.png">
            </div>
            <div class="food-img food2">
                <img src="{{asset('front-end/assets')}}/images/restaurant/food/2.png">
            </div>
            <div class="food-img food3">
                <img src="{{asset('front-end/assets')}}/images/restaurant/food/3.png">
            </div>
            <div class="food-img food4">
                <img src="{{asset('front-end/assets')}}/images/restaurant/food/4.png">
            </div>
        </div>
        <div class="container">
            <div class="title-1 detail-title">
                <h2 class="pt-0">easy step for booking</h2>
                <p class="font-design">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci alias aperiam
                    at, aut commodi corporis dolorum ducimus labore magnam mollitia natus porro possimus quae sit
                    tenetur veniam veritatis voluptate voluptatem!</p>
            </div>
            <div class="step-bg invert-lines">
                <div class="row">
                    <div class="col-md-3">
                        <div class="step-box">
                            <div>
                                <img src="{{asset('front-end/assets')}}/images/icon/order-steps/1.png" class="img-fluid blur-up lazyload"
                                    alt="">
                                <h4>Order Food through website or app</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-box">
                            <div>
                                <img src="{{asset('front-end/assets')}}/images/icon/order-steps/2.png" class="img-fluid blur-up lazyload"
                                    alt="">
                                <h4>User receives confirmation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-box">
                            <div>
                                <img src="{{asset('front-end/assets')}}/images/icon/order-steps/3.png" class="img-fluid blur-up lazyload"
                                    alt="">
                                <h4>order processing & food preparation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-box">
                            <div>
                                <img src="{{asset('front-end/assets')}}/images/icon/order-steps/4.png" class="img-fluid blur-up lazyload"
                                    alt="">
                                <h4>food is on its way to deliver Or ready to pick</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- how to start section end -->

    <!-- blog 3 start -->
    <section class="blog_section section-b-space ratio_55">
        <div class="container">
            <div class="title-1">
                <span class="title-label">new</span>
                <h2>our blog</h2>
            </div>
            <div class="slide-3 no-arrow">
                @foreach($blog as $b)
                <div>
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
        </div>
    </section>

    <!-- app section start -->
    <section class="app-section section-b-space app-dark position-cls process-steps parallax-img">
        <img src="{{asset('front-end/assets')}}/images/restaurant/dishes/17.jpg" class="bg-img img-fluid blur-up lazyload bg-top" alt="">
        <div class="container">
            <div class="row order-cls">
                <div class="col-lg-7">
                    <div class="app-content">
                        <div>
                            <h2 class="title">The best food
                                <span>app for your mobile.</span></h2>
                            <p>Quisque sollicitudin feugiat risus, eu posuere ex euismod eu. Phasellus hendrerit, massa
                                efficitur dapibus pulvinar, sapien eros sodales ante, euismod aliquet nulla metus a
                                mauris.
                            </p>
                            <h3>dowload app now...</h3>
                            <div class="app-buttons">
                                <a href="https://www.apple.com/ios/app-store/" class="btn btn-curve"><i
                                        class="fab fa-apple"></i> app store</a>
                                <a href="https://play.google.com/store?hl=en" class="btn btn-curve white-btn"><i
                                        class="fab fa-android"></i> play store</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="app-image">
                        <div>
                            <div class="image">
                                <div class="circle"></div>
                                <img src="{{asset('front-end/assets')}}/images/cab/app/1.png" alt="" class="img-fluid blur-up lazyload">
                            </div>
                            <div class="image">
                                <div class="circle b-round"></div>
                                <img src="{{asset('front-end/assets')}}/images/cab/app/2.png" alt="" class="img-fluid blur-up lazyload">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- app section end -->

    <section class="subscribe_section medium-section pt-10">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="subscribe-detail">
                        <div>
                            <h2>subscribe our news <span>our news</span></h2>
                            <p>Subscribe and receive our newsletters to follow the news about our fresh and fantastic items</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="input-section">
                        <input type="text" class="form-control" placeholder="Enter Your Email" aria-label="Recipient's username">
                        <a href="#" class="btn btn-rounded btn-sm color1">subscribe</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog 3 end -->
    @endsection