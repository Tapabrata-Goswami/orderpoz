<!-- footer start -->
<footer>
        <div class="footer section-b-space section-t-space parallax-img bg-size blur-up lazyloaded" >
            <div class="container">
                <div class="row order-row">
                    <div class="col-xl-3 col-md-6 order-cls">
                        <div class="footer-title mobile-title">
                            <h5>contact us</h5>
                        </div>
                        <div class="footer-content">
                            <div class="contact-detail">
                                <div class="footer-logo">
                                    <img src="{{asset('front-end/assets')}}/images/icon/footer-logo.png" alt=""
                                        class="img-fluid blur-up lazyload">
                                </div>
                                <p>{!! nl2br(@substr(App\Models\detail::where('id',1)->first()->about_us, 0, 100)) !!}...
                                <!-- {{substr(App\Models\detail::where('id',1)->first()->about_us, 0, 100)}}... -->
                                </p>
                                <ul class="contact-list">
                                    <li><i class="fas fa-phone-alt"></i> {{App\Models\detail::where('id',1)->first()->contact_mobile}}</li>
                                    <li><i class="fas fa-envelope"></i> {{App\Models\detail::where('id',1)->first()->contact_email}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3">
                        <div class="footer-space">
                            <div class="footer-title">
                                <h5>about</h5>
                            </div>
                            <div class="footer-content">
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="{{route('about-us')}}">about us</a></li>
                                        <li><a href="{{url('faq')}}">FAQ</a></li>
                                        <li><a href="{{route('terms-condition')}}">terms & co.</a></li>
                                        <li><a href="{{route('privacy-policy')}}">privacy</a></li>
                                        <li><a href="{{route('contact-us')}}">support</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-4 col-md-6">
                        <div class="footer-title">
                            <h5>our location</h5>
                        </div>
                        <div class="footer-content">
                            <div class="footer-map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583091352!2d-74.11976373946229!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1563449626439!5m2!1sen!2sin"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div> --}}
                    {{--<div class="col-xl-2 col-md-3 order-cls">
                        <div class="footer-space">
                            <div class="footer-title">
                                <h5>useful links</h5>
                            </div>
                            <div class="footer-content">
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="#">home</a></li>
                                        <li><a href="#">our vehical</a></li>
                                        <li><a href="#">latest video</a></li>
                                        <li><a href="#">services</a></li>
                                        <li><a href="#">booking deal</a></li>
                                        <li><a href="#">emergency call</a></li>
                                        <li><a href="#">mobile app</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <div class="col-xl-7 col-md-6">
                        <div class="footer-title">
                            <h5>new posts</h5>
                        </div>
                        <div class="footer-content">
                            <div class="footer-blog">
                                @php($blog1 = App\Models\blog::where('blog_status',1)->orderby('blog_id','DESC')->get()->take(2))
                                @foreach($blog1 as $b1)
                                <div class="media">
                                    <div class="img-part rounded5">
                                        <a href="{{route('blog-detail',[$b1['blog_id']])}}"><img src="{{asset('image')}}/{{$b1->blog_image}}"
                                                class="img-fluid blur-up lazyload" alt="" style="height:96px;width:96px;"></a>
                                    </div>
                                    <div class="media-body">
                                        <h5>{!! nl2br(@substr($b1->blog_title, 0, 30)) !!}...</h5>
                                        <p>{!! nl2br(@substr($b1->blog_description, 0, 150)) !!}...</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-footer">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="footer-social">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="copy-right">
                            <p>Copyright 2023 <b>ORDERPOZ</b> . All rights reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
