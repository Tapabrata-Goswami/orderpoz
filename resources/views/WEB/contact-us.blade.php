@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))

@section('content')

    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        <img src="{{asset('front-end/assets')}}/images/inner-bg.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="breadcrumb-content">
            <div>
                <h2>Contact Us</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="title-breadcrumb">ORDERPOZ</div>
    </section>
    <!-- breadcrumb end -->

    <!-- get in touch section start -->
    <section class="small-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="get-in-touch">
                        <h3>get in touch</h3>
                        <form action="{{route('contact-store')}}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="firstname" id="name" placeholder="first name" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="lastname" id="last-name" placeholder="last name" required="">
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="number" class="form-control" name="contact_phone" id="review" placeholder="phone number" required="">
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="text" class="form-control" name="contact_email" id="email" placeholder="email address" required="">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" name="contact_message" placeholder="Write Your Message"
                                        id="exampleFormControlTextarea1" rows="6"></textarea>
                                </div>
                                <div class="col-md-12 submit-btn">
                                    <button class="btn btn-solid" type="submit">Send Your Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 contact_right contact_section">
                    <div class="row">
                        <div class="col-md-12 col-6">
                            <div class="contact_wrap">
                                <div class="title_bar">
                                    <i class="fas fa-envelope"></i>
                                    <h4>email address</h4>
                                </div>
                                <div class="contact_content">
                                    <ul>
                                        <li>{{$detail->contact_email}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-6">
                            <div class="contact_wrap">
                                <div class="title_bar">
                                    <i class="fas fa-phone-alt"></i>
                                    <h4>phone</h4>
                                </div>
                                <div class="contact_content">
                                    <ul>
                                        <li>{{$detail->contact_mobile}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- get in touch section end -->
    @endsection