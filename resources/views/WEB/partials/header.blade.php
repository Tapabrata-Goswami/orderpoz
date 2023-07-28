<!-- header start -->
<header class="light_header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="menu">
                        <div class="brand-logo">
                            <a href="{{url('/')}}">
                                <img src="{{asset('front-end/assets')}}/images/icon/footer-logo.png" alt=""
                                    class="img-fluid blur-up lazyload">
                            </a>
                        </div>
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <div class="menu-overlay"></div>
                                    <ul class="nav-menu">
                                        <li class="back-btn">
                                            <div class="mobile-back text-end">
                                                <span>Back</span>
                                                <i aria-hidden="true" class="fa fa-angle-right ps-2"></i>
                                            </div>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{url('/')}}" class="nav-link menu-title">Home</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{url('about-us')}}" class="nav-link menu-title">about us</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{url('blog-list')}}" class="nav-link menu-title">Blogs</a>
                                        </li>
                                        {{--<li class="dropdown">
                                            <a href="{{url('terms-condition')}}" class="nav-link menu-title">terms & co.</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{url('privacy-policy')}}" class="nav-link menu-title">privacy</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{url('faq')}}" class="nav-link menu-title">FAQ</a>
                                        </li>--}}
                                        <li class="dropdown">
                                            <a href="{{url('contact-us')}}" class="nav-link menu-title">support</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!-- <nav> -->
                            
                        <!-- </nav> -->
                        @if(Request::routeIs('home') || Request::routeIs('about-us') || Request::routeIs('terms-condition') || Request::routeIs('privacy-policy') || Request::routeIs('contact-us') || Request::routeIs('blog-list') || Request::routeIs('blog-detail') || Request::routeIs('restaurant.restaurant-registration'))
                        <a href="{{route('restaurant.restaurant-registration')}}" class="btn btn-curve">become a partner</a>
                        @else
                        <ul class="header-right header_view">
                            @include('WEB.partial-pages.header-view-page')
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--  header end -->