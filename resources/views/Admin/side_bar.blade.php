<style>
    .navbar-vertical .nav-link {
        color: #ffffff;
    }

    .navbar .nav-link:hover {
        color: #EF3F3E;
    }

    .navbar .active > .nav-link, .navbar .nav-link.active, .navbar .nav-link.show, .navbar .show > .nav-link {
        color: #EF3F3E;
    }

    .navbar-vertical .active .nav-indicator-icon, .navbar-vertical .nav-link:hover .nav-indicator-icon, .navbar-vertical .show > .nav-link > .nav-indicator-icon {
        color: #EF3F3E;
    }
    
    .nav-subtitle {
        display: block;
        /* color: #ffffff; */
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03125rem;
    }

    .nav-indicator-icon {
        margin-left: {{Session::get('direction') === "rtl" ? '6px' : ''}};
    }
</style>

<div id="sidebarMain" class="d-none">
    <aside
        style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-brand-wrapper justify-content-between side-logo">
                    <!-- Logo -->
                    @php($e_commerce_logo=\App\Models\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
                    <a class="navbar-brand" href="{{url('admin.dashboard.index')}}" aria-label="Front">
                        <img style="max-height: 50px" onerror="this.src='{{asset('back-end/assets/back-end/img/900x400/img1.jpg')}}'" class="navbar-brand-logo-mini for-web-logo" src="{{asset("back-end/assets/company/$e_commerce_logo")}}" alt="Logo">
                    </a>
                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content mt-2">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        
                        <li class="navbar-vertical-aside-has-menu {{Request::is('panel')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('panel.dashboard')}}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{('Dashboard')}}
                                </span>
                            </a>
                        </li>
                        @if (\App\CPU\Helpers::module_permission_check('subadmin_section'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Subadmin*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-user-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <span class="text-truncate">Sub Admin</span>
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('panel/Subadmin*')?'block':'none'}}">
                                   <li class="nav-item {{Request::is('panel/Subadmin/add-subadmin')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Subadmin.add-subadmin')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">Add Sub Admin</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Subadmin/list')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Subadmin.list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">List Sub Admin</span>
                                        </a>
                                    </li>
                                </ul>
                        </li>
                        @endif
                        <!-- End Dashboards -->
                        <!-- POS -->
                      
                        <!-- End POS -->
                        @if (\App\CPU\Helpers::module_permission_check('category_section'))
                            <li class="nav-item {{(Request::is('admin/Category'))?'scroll-here':''}}">
                                <small class="nav-subtitle" title="">{{('Category & Items Section')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            <!-- Order -->

                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Category/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('panel.Category.list')}}">
                                    <i class="tio-filter-list nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Common Category')}}</span>
                                </a>
                            </li>
                        @endif    
                    <!--Category Section ends-->
                    @if(\App\CPU\Helpers::module_permission_check('user_section'))
                        <li class="nav-item {{(Request::is('panel/User/list*') || Request::is('panel/User/lp-point-list*') || Request::is('panel/Partner/list*'))?'scroll-here':''}}">
                                <small class="nav-subtitle" title="">{{('User Section')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/User/list*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('panel.User.list')}}">
                                    <i class="tio-poi-user nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('User')}}</span>
                                </a>
                            </li>
                        @endif
                        <!--User Section ends-->
                        @if(\App\CPU\Helpers::module_permission_check('restaurant_section'))
                            <li class="nav-item {{(Request::is('panel/Restaurant*')|| Request::is('panel/Category/catlist*') || Request::is('panel/Item/list*')) ?'scroll-here':''}}">
                                <small class="nav-subtitle" title="">{{('Restaurant management')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            <!-- Pages -->

                            <li class="navbar-vertical-aside-has-menu {{(Request::is('panel/Restaurant*') || Request::is('panel/Category/catlist*') || Request::is('panel/Item/list*'))?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-shop nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <span class="text-truncate">{{('Restaurant')}}</span>
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{(Request::is('panel/Restaurant*') || Request::is('panel/Category/catlist*') || Request::is('panel/Item/list*'))?'block':'none'}}">
                                    <li class="nav-item {{Request::is('panel/Restaurant/add-restaurant')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Restaurant.add-restaurant')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('Add Restaurant')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Restaurant/list')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Restaurant.list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('List')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Category/catlist')?'active':''}}">
                                        <a class="nav-link" href="{{route('panel.Category.catlist')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('Restaurant Category')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Item/list')?'active':''}}">
                                        <a class="nav-link" href="{{route('panel.Item.list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('Restaurant Item')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    <!--Tournament management ends-->
                        @if(\App\CPU\Helpers::module_permission_check('order_section'))
                            <li class="nav-item {{(Request::is('panel/Booking*'))?'scroll-here':''}}">
                                <small class="nav-subtitle" title="">{{('Order Section')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Booking*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-shopping-cart-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Restaurant Order')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('panel/Order*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('panel/Order/list/new')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Order.list', ['new'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('New Order')}}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                    {{ \App\Models\order_detail::where('order_status',0)->count() }}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Order/list/accepted')?'active':''}}">
                                        <a class="nav-link" href="{{route('panel.Order.list', ['accepted'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                                {{('Accepted')}}
                                                <span class="badge badge-soft-success badge-pill ml-1">
                                                    {{ \App\Models\order_detail::where('order_status',1)->count() }}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Order/list/picked')?'active':''}}">
                                        <a class="nav-link" href="{{route('panel.Order.list', ['picked'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                                {{('Picked')}}
                                                <span class="badge badge-soft-warning badge-pill ml-1">
                                                    {{ \App\Models\order_detail::where('order_status',2)->count() }}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Order/list/rejected')?'active':''}}">
                                        <a class="nav-link" href="{{route('panel.Order.list', ['rejected'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                                {{('Rejected')}}
                                                <span class="badge badge-danger badge-pill ml-1">
                                                    {{ \App\Models\order_detail::where('order_status',5)->count() }}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Order/list/cancelled')?'active':''}}">
                                        <a class="nav-link" href="{{route('panel.Order.list', ['cancelled'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                                {{('Cancelled')}}
                                                <span class="badge badge-danger badge-pill ml-1">
                                                    {{ \App\Models\order_detail::where('order_status',4)->count() }}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Order/list/completed')?'active':''}}">
                                        <a class="nav-link" href="{{route('panel.Order.list', ['completed'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                                {{('Completed')}}
                                                <span class="badge badge-success badge-pill ml-1">
                                                    {{ \App\Models\order_detail::where('order_status',3)->count() }}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ Request::is('panel/Order/list/all') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('panel.Order.list', ['all']) }}"
                                            title="{{('all') }} {{('bookings') }}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                                {{('all') }}
                                                <span class="badge badge-info badge-pill ml-1">
                                                    {{ \App\Models\order_detail::count() }}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <!--Tournament management ends-->
                        @if(\App\CPU\Helpers::module_permission_check('slider_section'))
                            <li class="nav-item {{(Request::is('panel/Slider*')) || (Request::is('panel/Offer*'))?'scroll-here':''}}">
                                <small class="nav-subtitle" title="">{{('Slider & Offer Section')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Slider*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('panel.Slider.list')}}">
                                    <i class="tio-vkontakte nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Slider')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Offer*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('panel.Offer.list')}}">
                                    <i class="tio-gift nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Offer')}}</span>
                                </a>
                            </li>
                        @endif
                    <!--Slider ends here-->
                        @if(\App\CPU\Helpers::module_permission_check('order_section'))
                            <li class="nav-item {{(Request::is('panel/Report*'))?'scroll-here':''}}">
                                <small class="nav-subtitle" title="">{{('Report Section')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Report/order-report*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('panel.Report.order-report')}}">
                                    <i class="tio-chart-bar-1 nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Order Report')}}</span>
                                </a>
                            </li>
                            {{--<li class="navbar-vertical-aside-has-menu {{Request::is('panel/Detail/other*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                    href="{{route('panel.Detail.other')}}">
                                    <i class="tio-airdrop nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Other Settings')}}</span>
                                </a>
                            </li>--}}
                        @endif
                            <!-- report -->
                            @if((\App\CPU\Helpers::module_permission_check('blog_section')) || (\App\CPU\Helpers::module_permission_check('notification_section')) || (\App\CPU\Helpers::module_permission_check('others')))
                            <li class="nav-item {{(Request::is('panel/Detail*')) || (Request::is('panel/Country*'))?'scroll-here':''}}">
                                <small class="nav-subtitle" title="">{{('Settings')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            @endif
                            @if(\App\CPU\Helpers::module_permission_check('blog_section'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Blog*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('panel.Blog.list')}}">
                                    <i class="tio-gift nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Blog')}}</span>
                                </a>
                            </li>
                            @endif
                            @if(\App\CPU\Helpers::module_permission_check('notification_section'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Detail/notification*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('panel.Detail.notification')}}">
                                    <i class="tio-notifications-alert nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Notification')}}</span>
                                </a>
                            </li>
                            @endif
                            @if(\App\CPU\Helpers::module_permission_check('others'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Country/list*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('panel.Country.list')}}">
                                    <i class="tio-notifications-alert nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Country')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{(Request::is('panel/Detail/tc*') || Request::is('panel/Detail/privacy*') || Request::is('panel/Detail/refund*') || Request::is('panel/Detail/contact*'))?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-pages-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <span class="text-truncate">{{('Page Setup')}}</span>
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{(Request::is('panel/Detail/tc*') || Request::is('panel/Detail/privacy*') || Request::is('panel/Detail/about*') || Request::is('panel/Detail/refund*') || Request::is('panel/Detail/contact*'))?'block':'none'}}">
                                    <li class="nav-item {{Request::is('panel/Detail/tc')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Detail.tc')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('Terms & Condition')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Detail/about')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Detail.about')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('About')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Detail/privacy')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Detail.privacy')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('Privacy & Policy')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Detail/refund')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Detail.refund')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('Refund Policy')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Detail/contact-us')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Detail.contact-us')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('Contact-Us')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('panel/Detail/web-contact-list')?'active':''}}">
                                        <a class="nav-link " href="{{route('panel.Detail.web-contact-list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{('Web Contact List')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('panel/Detail/other*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('panel.Detail.other')}}">
                                    <i class="tio-settings-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{('Other Settings')}}</span>
                                </a>
                            </li>
                            @endif
                        <li class="nav-item" style="padding-top: 50px">
                            <div class="nav-divider"></div>
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>