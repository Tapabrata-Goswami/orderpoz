@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))
@push('css_or_js')
<script src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>
<style>
    .pac-container{
        z-index: 10000;
    }
    .star-rating {
  direction: rtl;
  display: inline-block;
  padding: 20px;
  color: lightgrey;
  font-size: 25px;
  cursor: default;}

  input[type="radio"] {
    display: none;
    
  }

  input[type="radio"]:checked ~ label {
    color: #f2b600;
  }
</style>
@endpush
@section('content')
    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        <img src="{{asset('front-end/assets')}}/images/inner-bg.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="breadcrumb-content">
            <div>
                <h2>dashboard</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="title-breadcrumb">ORDERPOZ</div>
    </section>
    <!-- breadcrumb end -->


    <!-- section start-->
    <section class="small-section dashboard-section bg-inner" data-sticky_parent>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="pro_sticky_info" data-sticky_column>
                        <div class="dashboard-sidebar">
                            <div class="profile-top">
                                <div class="profile-image">
                                    <img src="{{asset('image')}}/{{auth()->user()->image}}" class="img-fluid blur-up lazyload" alt="" onerror="this.src='{{asset('front-end/assets')}}/images/img1.jpg'">
                                    <a class="profile-edit" data-bs-toggle="modal" data-bs-target="#edit-profile">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                                            </path>
                                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                        </svg>
                                    </a>
                                </div>
                                <div class="profile-detail">
                                    <h5><i class="fas fa-user"></i> {{auth()->user()->name}}</h5>
                                    <h6><i class="fas fa-phone-square-alt"></i> {{auth()->user()->mobile}}</h6>
                                    <h6><i class="fas fa-envelope-open"></i> {{auth()->user()->email}}</h6>
                                    <h6><i class="fas fa-address-book"></i> {{auth()->user()->gps_address}}</h6>
                                </div>
                            </div>
                            <div class="faq-tab">
                                <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active"
                                            href="#dashboard">dashboard</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#booktable">booked table</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                            href="#bookings">orders</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="product_img_scroll" data-sticky_column>
                        <div class="faq-content tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="dashboard">
                                <div class="dashboard-main">
                                    <div class="dashboard-intro">
                                        <h5>welcome! <span>{{auth()->user()->name}}</span></h5>
                                    </div>
                                    <div class="counter-section">
                                        <div class="row">
                                            <div class="col-xl-2 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="{{asset('front-end/assets')}}/images/icon/new-order.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3>{{App\Models\order_detail::where('order_status',0)->where('user_id',auth()->user()->id)->count();}}</h3>
                                                    <h5>New</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="{{asset('front-end/assets')}}/images/icon/accept-order.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3>{{App\Models\order_detail::where('order_status',1)->where('user_id',auth()->user()->id)->count();}}</h3>
                                                    <h5>Accepted</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="{{asset('front-end/assets')}}/images/icon/picked-order.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3>{{App\Models\order_detail::where('order_status',2)->where('user_id',auth()->user()->id)->count();}}</h3>
                                                    <h5>Picked</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="{{asset('front-end/assets')}}/images/icon/complete-order.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3>{{App\Models\order_detail::where('order_status',3)->where('user_id',auth()->user()->id)->count();}}</h3>
                                                    <h5>Completed</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="{{asset('front-end/assets')}}/images/icon/cancel-order.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3>{{App\Models\order_detail::where('order_status',4)->where('user_id',auth()->user()->id)->count();}}</h3>
                                                    <h5>Cancelled</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-sm-6">
                                                <div class="counter-box">
                                                    <img src="{{asset('front-end/assets')}}/images/icon/reject-order.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <h3>{{App\Models\order_detail::where('order_status',5)->where('user_id',auth()->user()->id)->count();}}</h3>
                                                    <h5>Rejected</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-info">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div id="chart">
                                                    <div class="detail-left" style="position: absolute;">
                                                        <ul>
                                                            <li><span class="new" style="background-color: #379cf9;"></span> New</li>
                                                            <li><span class="accepted" style="background-color: #a264ff;"></span> Accepted</li>
                                                            <li><span class="picked" style="background-color: #EFA335;"></span> On the Way</li>
                                                            <li><span class="completed" style="background-color: #8AC642;"></span> Completed</li>
                                                            <li><span class="cancelled" style="background-color: #fa4962;"></span> Cancelled</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="activity-box">
                                                    <h6>recent activity</h6>
                                                    <ul>
                                                    @php $notiuser = App\Models\local_notification_user::where('noti_user_id',auth()->user()->id)->orderby('user_noti_id','DESC')->get()->take(6); @endphp
                                                        
                                                    @if(App\Models\local_notification_user::where('noti_user_id',auth()->user()->id)->orderby('user_noti_id','DESC')->exists())

                                                        @foreach($notiuser as $noti)
                                                        <li style="height: 55px;text-transform: unset;">
                                                            {{$noti->noti_msg}}
                                                            <span style="color: grey;">{{ \Carbon\Carbon::parse( $noti->created_at )->format('M d, Y') }}</span>
                                                        </li>
                                                        @endforeach
                                                        @else
                                                        <div style="text-align: center;">
                                                            <img src="{{asset('front-end/assets')}}/images/icon/no-data.png" class="img-fluid blur-up lazyload" alt="">
                                                        </div>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="booktable">
                                <div class="checkout-process">
                                    <div class="checkout-box">
                                        <h4 class="title">Booked Tables:</h4>
                                        <div class="row address-sec">
                                        @if(App\Models\book_table::leftjoin('restaurants','restaurants.restaurant_id','book_tables.restaurant_id')->where('user_id',auth()->user()->id)->exists())
                                        @php $tables = App\Models\book_table::leftjoin('restaurants','restaurants.restaurant_id','book_tables.restaurant_id')->where('user_id',auth()->user()->id)->orderby('date_time','ASC')->get(); @endphp
                                        @foreach($tables as $table)
                                            <div class="select-box col-xl-12 col-md-6" style="padding-bottom: 10px;">
                                                <div class="address-box">
                                                    <div class="top">
                                                        <h6>{{$table->restaurant_name}}</h6>
                                                    </div>
                                                    <div class="middle">
                                                        <div class="address">
                                                            <p>{{$table->restaurant_gps_address}}</p>
                                                        </div>
                                                        <div class="number">
                                                            <p>User Name: <span>{{$table->firstname}} {{$table->lastname}}</span></p>
                                                            <p>Email: <span>{{$table->email}}</span></p>
                                                            <p>Phone: <span>{{$table->phone}}</span></p>
                                                            <p>Person: <span>{{$table->person}}</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="bottom">
                                                    <p><b style="color:black;">Booked Date: <span>{{ date('d M Y H:i A' . config('timeformat'), strtotime($table['date_time'])) }}</span></b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @else
                                        <div class="select-box col-xl-12 col-md-6" style="padding-bottom: 10px;text-align: center;">
                                            <img src="{{asset('front-end/assets')}}/images/no-result.png" style="width:30%;">
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bookings">
                                <div class="dashboard-box orlist">
                                    <div class="dashboard-title">
                                        <h4>my order list</h4>
                                    </div>
                                    @if($order_list->count()>0)
                                    @foreach($order_list as $list)
                                    @php $k=1; @endphp
                                    @php($product=App\Models\order_menu_item::where('order_id',$list->order_id)->get())
                                    <div class="dashboard-detail">
                                        <div class="booking-box">
                                            <div class="date-box">
                                                <span class="day">order id</span>
                                                <span class="month">#{{$list->order_id}}</span>
                                            </div>
                                            <div class="detail-middle">
                                                <div class="media">
                                                    <div class="media-body">
                                                    <p class="date">restaurant name: <h6 class="media-heading date">{{$list->restaurant_name}}</h6></p>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="date">amount paid: <span style="font-weight: 700;color: black;">{{$list->country_currency}}{{$list->grand_total}}</span></p>
                                                    </div>
                                                    <div class="icon">
                                                        <span data-inverted="" data-inverted="" data-tooltip="@foreach($product as $pro) @if($k==1)  @else , @endif {{$pro->menu_title}} ({{$pro->menu_qty}}) @php($k++)@endforeach" data-position="top center"><i class="fas fa-eye"></i></span>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="date">order date: <h6 class="media-heading date">{{date('d M Y h:i A',strtotime($list['created_at']))}}</h6></p>
                                                    </div>
                                                    <div class="icon">
                                                        <span data-inverted="" data-inverted="" data-tooltip="{{$list->outlet_gps_address}}" data-position="top center"><i class="fas fa-map-marked-alt" ></i></span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="detail-last">
                                                <!-- <a href="#"><i class="fas fa-window-close" data-bs-toggle="tooltip"
                                                        data-placement="top" title="cancle booking"></i></a> -->
                                                
                                               @if ($list->order_status == 0) <span class="badge bg-info">New</span>
                                               <a href="#" onclick="cancel_order({{$list->order_id}},event)"><span class="badge bg-danger"><i class="fas fa-times-circle" style="color: white;"></i></span></a>
                                                @elseif ($list->order_status == 1) <span class="badge bg-secondary">Accepted</span>
                                                @elseif ($list->order_status == 2) <span class="badge bg-primary">Picked</span>
                                                @elseif ($list->order_status == 3) <span class="badge bg-success">Completed</span>
                                                    @if(App\Models\restaurant_review::where('order_id',$list->order_id)->doesntExist())
                                                    <a class="profile-edit" data-bs-toggle="modal" data-bs-target="#review-rating{{$list->order_id}}"><span class="badge bg-warning"><i class="fas fa-star" style="color: white;"></i></span></a>
                                                    @endif
                                                @else <span class="badge bg-danger">Cancelled</span>
                                                @endif
                                                <a href="{{url('order-detail')}}/{{$list->order_id}}" target="_blank"><span class="badge bg-secondary">Detail</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- add card modal start -->
                                    <div class="modal fade edit-profile-modal ratingmodel" id="review-rating{{$list->order_id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Review & Rating</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                </div>
                                                <form method="POST" class="ratingform{{$list->order_id}}">
                                                    @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="first">Rating</label>
                                                            <div class="star-rating">
                                                            <input id="star-5{{$list->order_id}}" type="radio" name="restaurant_rate" value="5" />
                                                            <label for="star-5{{$list->order_id}}" >
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-4{{$list->order_id}}" type="radio" name="restaurant_rate" value="4" />
                                                            <label for="star-4{{$list->order_id}}" >
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-3{{$list->order_id}}" type="radio" name="restaurant_rate" value="3" />
                                                            <label for="star-3{{$list->order_id}}" >
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-2{{$list->order_id}}" type="radio" name="restaurant_rate" value="2" />
                                                            <label for="star-2{{$list->order_id}}" >
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-1{{$list->order_id}}" type="radio" name="restaurant_rate" value="1" />
                                                            <label for="star-1{{$list->order_id}}" >
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="last">Enter Review</label>
                                                            <textarea name="restaurant_review" class="form-control" cols="100" rows="2" ></textarea>
                                                            <input type="hidden" name="order_id" value="{{$list->order_id}}" id="order_id" />
                                                            <input type="hidden" name="restaurant_id" value="{{$list->restaurant_id}}" id="restaurant_id" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" onclick="rating({{$list->order_id}})" class="btn btn-solid">submit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="dashboard-detail" style="margin: 50px;text-align:center;"><img src="{{asset('front-end/assets')}}/images/no-order.png"></div>
                                    @endif
                                </div>
                                <!-- <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>past booking</h4>
                                    </div>
                                    <div class="dashboard-detail">
                                        <div class="booking-box">
                                            <div class="date-box">
                                                <span class="day">tue</span>
                                                <span class="date">14</span>
                                                <span class="month">aug</span>
                                            </div>
                                            <div class="detail-middle">
                                                <div class="media">
                                                    <div class="icon">
                                                        <i class="fas fa-plane"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">dubai to paris</h6>
                                                        <p>amount paid: <span>$2500</span></p>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">ID: aSdsadf5s1f5</h6>
                                                        <p>order date: <span>20 oct, 2020</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-last">
                                                <span class="badge bg-success">past</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-detail">
                                        <div class="booking-box">
                                            <div class="date-box">
                                                <span class="day">tue</span>
                                                <span class="date">14</span>
                                                <span class="month">aug</span>
                                            </div>
                                            <div class="detail-middle">
                                                <div class="media">
                                                    <div class="icon">
                                                        <i class="fas fa-hotel"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">sea view hotel</h6>
                                                        <p>amount paid: <span>$2500</span></p>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">ID: aSdsadf5s1f5</h6>
                                                        <p>order date: <span>20 oct, 2020</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-last">
                                                <span class="badge bg-success">past</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-detail">
                                        <div class="booking-box">
                                            <div class="date-box">
                                                <span class="day">tue</span>
                                                <span class="date">14</span>
                                                <span class="month">aug</span>
                                            </div>
                                            <div class="detail-middle">
                                                <div class="media">
                                                    <div class="icon">
                                                        <i class="fas fa-taxi"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">paris to Toulouse</h6>
                                                        <p>amount paid: <span>$2500</span></p>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">ID: aSdsadf5s1f5</h6>
                                                        <p>order date: <span>20 oct, 2020</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-last">
                                                <span class="badge bg-success">past</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <!-- <div class="tab-pane fade" id="bookmark">
                                <div class="dashboard-box">
                                    <div class="dashboard-title">
                                        <h4>my bookmark</h4>
                                    </div>
                                    <div class="product-wrapper-grid ratio3_2 special-section grid-box">
                                        <div class="row content grid">
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/tour/tour/7.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>Beautiful bali</h5>
                                                            </a>
                                                            <h6>6N 7D</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/tour/tour/8.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>best of europe</h5>
                                                            </a>
                                                            <h6>6N 7D</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/hotel/room/13.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>sea view hotel</h5>
                                                            </a>
                                                            <h6>$250/ night</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/restaurant/environment/3.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>italian restro</h5>
                                                            </a>
                                                            <h6>fast food | $25 for two</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/flights/flight-breadcrumb2.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>dubai to paris</h5>
                                                            </a>
                                                            <h6>egyptair | $2500</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/tour/tour/12.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>simply mauritius</h5>
                                                            </a>
                                                            <h6>6N 7D</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/tour/tour/13.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>canadian delight</h5>
                                                            </a>
                                                            <h6>6N 7D</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/tour/tour/14.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>Egyptian Wonders</h5>
                                                            </a>
                                                            <h6>6N 7D</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 grid-item">
                                                <div class="special-box">
                                                    <div class="special-img">
                                                        <a href="#">
                                                            <img src="{{asset('front-end/assets')}}/images/tour/tour/15.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                                        </a>
                                                        <div class="content_inner">
                                                            <a href="#">
                                                                <h5>South Africa</h5>
                                                            </a>
                                                            <h6>6N 7D</h6>
                                                        </div>
                                                        <div class="top-icon">
                                                            <a href="#" class="" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Remove from Wishlist"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section end-->
    

    <!-- edit profile modal start -->
    <div class="modal fade edit-profile-modal" id="edit-profile" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('edit-profile')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->name}}" placeholder="Enter name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last">Mobile</label>
                                <input type="text" class="form-control" id="mobile" placeholder="Enter mobile" value="{{auth()->user()->mobile}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{auth()->user()->email}}"/>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" name="gps_address" id="gps_address" placeholder="Enter address" value="{{auth()->user()->gps_address}}">
                                <input type="hidden" class="form-control" name="gps_lat" id="gps_lat" value="{{auth()->user()->gps_lat}}">
                                <input type="hidden" class="form-control" name="gps_lng" id="gps_lng" value="{{auth()->user()->gps_lng}}">
                            </div>
                            <div class="form-group col-md-12 row">
                                <label>Image</label>
                                <div class="col-sm-7">                        
                                    <input type="file" name="image" id="imgInp" class="form-control" >
                                </div>
                                <div class="col-lg-3">
                                    <img class="img_people" id="blah" src="{{asset('image')}}/{{auth()->user()->image}}" width="100px" height="100px" onerror="this.src='{{asset('front-end/assets')}}/images/img2.jpg'">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-solid">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- edit profile modal start -->


    <!-- edit address modal start -->
    <div class="modal fade edit-profile-modal" id="edit-address" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change email address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="old">old email</label>
                                <input type="email" class="form-control" id="old">
                            </div>
                            <div class="form-group col-12">
                                <label for="new">enter new email</label>
                                <input type="email" class="form-control" id="new">
                            </div>
                            <div class="form-group col-12">
                                <label for="comfirm">confirm your email</label>
                                <input type="email" class="form-control" id="comfirm">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit address modal start -->


    <!-- edit phone no modal start -->
    <div class="modal fade edit-profile-modal" id="edit-phone" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change phone no</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="ph-o">old phone no</label>
                                <input type="number" class="form-control" id="ph-o">
                            </div>
                            <div class="form-group col-12">
                                <label for="ph-n">enter new phone no</label>
                                <input type="number" class="form-control" id="ph-n">
                            </div>
                            <div class="form-group col-12">
                                <label for="ph-c">confirm your phone no</label>
                                <input type="number" class="form-control" id="ph-c">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit phone no modal start -->


    <!-- edit password modal start -->
    <div class="modal fade edit-profile-modal" id="edit-password" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change email address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="p-o">old password</label>
                                <input type="email" class="form-control" id="p-o">
                            </div>
                            <div class="form-group col-12">
                                <label for="p-n">enter new password</label>
                                <input type="email" class="form-control" id="p-n">
                            </div>
                            <div class="form-group col-12">
                                <label for="p-c">confirm your password</label>
                                <input type="email" class="form-control" id="p-c">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->


    <!-- edit password modal start -->
    <div class="modal fade edit-profile-modal" id="edit-card" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">edit your card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">name on card</label>
                            <input type="text" class="form-control" id="name" placeholder="Mark jecno">
                        </div>
                        <div class="form-group">
                            <label for="number">card number</label>
                            <input type="text" class="form-control" id="number" placeholder="7451 2154 2115 2510">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="expiry">expiry date</label>
                                <input type="text" class="form-control" id="expiry" placeholder="12/23">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cvv">cvv</label>
                                <input type="password" maxlength="3" class="form-control" id="cvv"
                                    placeholder="&#9679;&#9679;&#9679;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">update card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->


    <!-- add card modal start -->
    <div class="modal fade edit-profile-modal" id="add-card" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">add new card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="a-month">card type</label>
                            <select id="a-month" class="form-control">
                                <option selected>add new card...</option>
                                <option>credit card</option>
                                <option>debit card</option>
                                <option>debit card with ATM pin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="a-na">name on card</label>
                            <input type="text" class="form-control" id="a-na">
                        </div>
                        <div class="form-group">
                            <label for="a-n">card number</label>
                            <input type="text" class="form-control" id="a-n">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="a-e">expiry date</label>
                                <input type="text" class="form-control" id="a-e">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="a-c">cvv</label>
                                <input type="password" maxlength="3" class="form-control" id="a-c">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">add card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->

    <!-- edit password modal start -->
    @endsection
    @push('script')
    <script src="{{asset('front-end/assets')}}/js/apexcharts.js"></script>
    <!-- <script src="{{asset('front-end/assets')}}/js/chart.js"></script> -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&libraries=places&country=ind"></script>

    <script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        //alert("sdfsdfsdf");
        var places = new google.maps.places.Autocomplete(document.getElementById('gps_address'));
        google.maps.event.addListener(places, 'place_changed', function () {
        var place = places.getPlace();
        var address = place.formatted_address;
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();

        document.getElementById("gps_lat").value = latitude;
        document.getElementById("gps_lng").value = longitude;

        });
    });
    </script>
    <script>
        var options = {
    chart: {
        height: 350,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function (w) {
                        // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                        return {{App\Models\order_detail::where('user_id',auth()->user()->id)->count()}};
                    }
                }
            }
        }
    },
    series: [{{App\Models\order_detail::where('order_status',0)->where('user_id',auth()->user()->id)->count()}}, {{App\Models\order_detail::where('order_status',1)->where('user_id',auth()->user()->id)->count()}}, {{App\Models\order_detail::where('order_status',2)->where('user_id',auth()->user()->id)->count()}}, {{App\Models\order_detail::where('order_status',3)->where('user_id',auth()->user()->id)->count()}}, {{App\Models\order_detail::where('order_status',4)->where('user_id',auth()->user()->id)->count()}}],
    labels: ['New' , 'Accepted', 'On The Way' , 'Completed' , 'Cancelled'],
    colors:['#379cf9', '#a264ff', '#EFA335', '#8AC642' ,'#fa4962'],
    stroke: {
        lineCap: "round",
    }

}

var chart = new ApexCharts(
    document.querySelector("#chart"),
    options
);

chart.render();

    function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    }
    }

    $("#imgInp").change(function(){
    readURL(this);
    });

    function cancel_order(order_id,e) 
    {
        e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Want to Cancelled this order',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                
                $.post({
                    url: '{{ route('cancel-order') }}',
                    data: {order_id:order_id},
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (response) {
                    console.log(response);
                    if (response == 200) {
                            toastr.success('Success! Order cancelled successfully',{
                            CloseButton: true,
                            ProgressBar: true,
                            timer: 1500
                            });
                            
                            $(".orlist").load(" .orlist");
                            return false;
                        }
                        else if (response == 404) {
                            toastr.error('Error! Order not found',{
                            CloseButton: true,
                            ProgressBar: true,
                            timer: 1500
                            });
                            return false;
                        }
                    },
                    complete: function () {
                        $('#loading').hide();
                        }
                });
            }
        })
    }

    function rating(order_id)
    {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
            url: '{{ route('review-rating') }}',
            data: $('.ratingform' + order_id).serializeArray(),
            beforeSend: function () {
            $('#loading').show();
            },
            success: function (response) {
            console.log(response);
            if (response.errors) {
                for (var i = 0; i < response.errors.length; i++) {
                    toastr.error(response.errors[i].message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            }
            else if (response == 200) {
                toastr.success('Success! Review submited',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                $('.ratingmodel').modal('hide');
                $(".orlist").load(" .orlist");
                return false;
            }
            else if (response == 400) {
                toastr.error('Error! Something went wrong',{
                CloseButton: true,
                ProgressBar: true,
                timer: 1500
                });
                return false;
            }
            },
            complete: function () {
            $('#loading').hide();
            }
        });
    }
</script>
@endpush