@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))

@section('content')
    <!-- section start -->
    <section class="bg-inner section-b-space success-section">
        <div class="container">
            <div class="row success-detail mt-0">
                <div class="col">
                    <img src="{{asset('front-end/assets')}}/images/restaurant/order-success.png" class="img-fluid blur-up lazyload" alt="">
                    <h2>You Place The Order Successfully ! get ready for delicious food.</h2>
                    <p>Your order is placed successfully. We start our delivery process and you will receive your food soon.</p>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- section End -->

    @endsection