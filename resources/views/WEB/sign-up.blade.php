@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))

@section('content')
    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        <img src="{{asset('front-end/assets')}}/images/inner-bg.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="breadcrumb-content">
            <div>
                <h2>sign up</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">sign up</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="title-breadcrumb">ORDERPOZ</div>
    </section>
    <!-- breadcrumb end -->


    <!-- section start -->
    <section class="section-b-space animated-section dark-cls">
        <img src="{{asset('front-end/assets')}}/images/cab/grey-bg.jpg" alt="" class="img-fluid blur-up lazyload bg-img">
        <div class="animation-section">
            <div class="cross po-1"></div>
            <div class="cross po-2"></div>
            <div class="round po-4"></div>
            <div class="round po-5"></div>
            <div class="round r-y po-8"></div>
            <div class="square po-10"></div>
            <div class="square po-11"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 offset-sm-2 col-sm-8 col-12">
                    <div class="account-sign-in">
                        <div class="title">
                            <h3>sign up</h3>
                        </div>
                        <div class="login-with">
                            <h6>sign up with</h6>
                            <div class="login-social row">
                                <div class="col">
                                    <a class="boxes">
                                        <img src="{{asset('front-end/assets')}}/images/icon/social/facebook.png"
                                            class="img-fluid blur-up lazyload" alt="">
                                        <h6>facebook</h6>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="boxes">
                                        <img src="{{asset('front-end/assets')}}/images/icon/social/google.png"
                                            class="img-fluid blur-up lazyload" alt="">
                                        <h6>google</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="divider">
                                <h6>OR</h6>
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="email" class="form-control" id="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password">
                            </div>
                            <div class="button-bottom">
                                <button type="submit" class="w-100 btn btn-solid">create account</button>
                                <div class="divider">
                                    <h6>or</h6>
                                </div>
                                <button type="submit" class="w-100 btn btn-solid btn-outline"
                                    ><a href="{{url('login')}}" style="color: unset;">login</a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->
    @endsection