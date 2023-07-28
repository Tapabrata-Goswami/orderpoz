@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))
<style>
  @media (max-width: 769px) {
    .cartmobile
  {
    position: fixed;
    left: 0%;
    bottom: 0px;
    width: 100%;
  }
  .single-section .single-sidebar .newsletter-sec{
    padding: 0px!important;
  }
}
  </style>
@section('content')

  <!-- breadcrumb start -->
  <section class="breadcrumb-section order-food-section pt-0">
    <img src="{{asset('image')}}/{{$restaurant->restaurant_image}}" class="bg-img img-fluid blur-up lazyload" alt="">
    <div class="breadcrumb-content restaurant-name">
      <div>
        
        <div class="rest-order-content">
          <div>
            <!-- <img src="{{asset('image')}}/{{$restaurant->restaurant_image}}" class="img-fluid blur-up lazyload" alt=""> -->
            <h3>{{$restaurant->restaurant_name}}</h3>
            {{--<h6>{{$cat_name}}</h6>--}}
            <ul>
              <li><td>Rating ({{$restaurant->total_rating}})</td><td class="rating">
                    @foreach(range(1,5) as $i)
                        @if($restaurant->total_rating >0)
                            @if($restaurant->total_rating >0.9)
                                <i class="fas fa-star" style="color: gold;"></i>
                            @elseif($restaurant->total_rating >0.2 && $restaurant->total_rating < 0.9)
                                <i class="fas fa-star-half-alt" style="color: gold;"></i>
                            @endif
                        @endif
                        @php $restaurant->total_rating--; @endphp
                    @endforeach
                  </td> </li>
              <!-- <li>30 mins</li>
              <li>$25 for 2</li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb end -->


  <!-- section start -->
  <section class="single-section small-section bg-inner" style="position: relative;">
    <div class="container">
      <div class="row">
        <div class="col-xl-9 col-lg-8">
          <div class="description-section tab-section">
            <div class="menu-top menu-up">
              <ul class="nav nav-tabs" id="top-tab" role="tablist">
                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active" href="#order">order
                    online</a></li>
                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#overview">overview</a>
                </li>
                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#gallery">gallery</a>
                </li>
                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#location">location</a>
                </li>
                @if($restaurant->book_table==1)
                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#book">book a table</a>
                </li>
                @endif
                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#review">reviews</a>
                </li>
              </ul>
            </div>
            <div class="description-details tab-content" id="top-tabContent">
              <div class="menu-part p-0 tab-pane fade show active" id="order">
                <div class="">
                  <div class="container p-0" data-sticky_parent>
                    <div class="row m-0">
                      <div class="col-xl-3 col-lg-4 d-lg-block d-none p-0">
                        <div class="product_img_scroll" data-sticky_column>
                          <nav id="order-menu" class="order-menu">
                            {{--<div class="search-bar">
                              <div class="search">
                                <input type="text" placeholder="Search Dishes..">
                                <i class="fas fa-search"></i>
                              </div>
                            </div>--}}
                            <nav class="nav nav-pills flex-column" id="navbar">
                              <ul data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                                @foreach($restaurant_category as $cat)
                                  <!-- @php $restaurant_menu1 = App\Models\restaurant_category::where('restaurant_id',$cat->restaurant_id)->where('cat_id',$cat->cat_id)->orderby('restaurant_cat_id','DESC')->get(); @endphp -->
                                  <li><a class="nav-link dropchange" href="#cat{{$cat->restaurant_cat_id}}">{{$cat->cat_name}}</a>
                                    <!-- <nav class="nav nav-pills flex-column">
                                      @foreach($restaurant_menu1 as $menu1)
                                      <a class="nav-link ms-3" href="#{{$menu1->menu_title}}">{{$menu1->menu_title}}</a>
                                      @endforeach
                                    </nav> -->
                                  </li>
                                @endforeach
                              </ul>
                            </nav>
                          </nav>
                        </div>
                      </div>
                      <div class="col-xl-9 col-lg-8 p-0">
                        <div class="pro_sticky_info" data-sticky_column>
                          <div data-spy="scroll" data-bs-target="#order-menu">
                            <div class="order-menu-section">
                            @foreach($restaurant_category as $cat1)
                              @php $restaurant_menu = App\Models\restaurant_category::where('restaurant_id',$cat1->restaurant_id)->where('cat_id',$cat1->cat_id)->where('rest_menu_status',1)->orderby('restaurant_cat_id','DESC')->get(); @endphp
                              <div id="cat{{$cat1->restaurant_cat_id}}" class="order-section">
                                <div class="order-title">
                                  <h5>{{$cat1->cat_name}}</h5>
                                  <h6>{{$restaurant_menu->count()}} items</h6>
                                </div>
                                <div class="order-items">
                                  
                                @foreach($restaurant_menu as $menu)
                                <form id="add-to-cart-form{{$menu['restaurant_cat_id']}}" class="mb-2">
                                @csrf
                                <input type="hidden" name="restaurant_cat_id" value="{{ $menu->restaurant_cat_id }}">
                                  <div class="items @if($menu['is_veg']=='0') non-veg @else veg @endif">
                                    <h6>{{$menu->menu_title}}</h6>
                                    <p>{{$menu->menu_description}}</p>
                                    <h5>{{$restaurant->country_currency}}{{$menu->menu_price}}</h5>
                                    <div class="addtocart_btn">
                                      @if(App\Models\item_add_on::where('menu_id',$menu->restaurant_cat_id)->exists())
                                      <button class="add_cart" type="button" data-bs-toggle="modal" data-bs-target="#customized{{$menu->restaurant_cat_id}}" title="Add to cart" tabindex="0">Add*
                                        <span>customized</span>
                                      </button>
                                      @else
                                      <button class="add-button add_cart"
                                        title="Add to cart" onclick="addToCart({{$menu['restaurant_cat_id']}},'{{$restaurant->restaurant_name_code}}')" type="button" tabindex="0"> add
                                      </button>
                                      @endif
                                      
                                    </div>
                                  </div>
                                
                                <!-- cart customized modal -->
                                  <div class="modal fade customized" id="customized{{$menu->restaurant_cat_id}}" tabindex="-1" role="dialog"
                                      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalCenterTitle">{{$menu->menu_title}}</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="size-option">
                                                      <div class="item">
                                                          <h5>Items</h5>
                                                          @php $add_ons=App\Models\item_add_on::where('menu_id',$menu->restaurant_cat_id)->get(); @endphp
                                                            @foreach($add_ons as $add_on)
                                                              <div class="form-check">
                                                                  <input class="form-check-input radio_animated" type="radio" name="add_on_name" id="exampleRadios{{$add_on->add_on_id}}" value="{{$add_on->add_on_name}}" checked>
                                                                  <label class="form-check-label" for="exampleRadios{{$add_on->add_on_id}}">
                                                                      {{$add_on->add_on_name}}
                                                                  </label>
                                                              </div>
                                                            @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button class="btn add__button btn-solid add_cart" title="Add to cart" onclick="addToCart({{$menu['restaurant_cat_id']}},'{{$restaurant->restaurant_name_code}}')" type="button" tabindex="0"> add to cart
                                                </button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- cart customized modal -->
                                  </form>
                                @endforeach
                                </div>
                              </div>
                            @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="menu-part about tab-pane fade " id="overview">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="about-sec">
                        <h6>Phone number: {{$restaurant->country_code}} {{$restaurant->restaurant_mobile}}</h6>
                        <h6>Email Id: {{$restaurant->restaurant_email}}</h6>
                      </div>
                      <div class="about-sec">
                        <h6>cuisine</h6>
                        <ul>
                          @foreach($restaurant_category as $cuisine)
                          <li>{{$cuisine->cat_name}}</li>
                          @endforeach
                        </ul>
                      </div>
                      <div class="about-sec">
                        <h6>outlets</h6>
                        <ul>
                          @foreach($restaurant_outlet as $outlet)
                          <li>{{$outlet->outlet_gps_address}} ({{$outlet->outlet_area}})</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="about-sec mt-sm-0 mt-2">
                        <h6>opening hours</h6>
                        <ul>
                          @foreach($restaurant_time_slot as $time_slot)
                          @if($time_slot->is_close==1)<li><b>{{$time_slot->day}}</b>: {{ \Carbon\Carbon::parse( $time_slot->from_time )->format('h:i A') }} to {{ \Carbon\Carbon::parse( $time_slot->to_time )->format('h:i A') }}</li>
                          @endif
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="about-sec mt-3">
                        <h6>About</h6>
                        <ul>
                          <p>{{$restaurant->restaurant_about}}</p>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="menu-part tab-pane fade" id="gallery">
                <div class="container-fluid p-0 ratio3_2">
                  <div class="row  zoom-gallery">
                    @foreach($restaurant_gallery as $gallery)
                    <div class="col-lg-4 col-sm-6">
                      <div class="overlay">
                        <a href="{{asset('image')}}/{{$gallery->gallery_image}}">
                          <div class="overlay-background">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                          </div>
                          <img src="{{asset('image')}}/{{$gallery->gallery_image}}" alt="" class="img-fluid blur-up lazyload bg-img">
                        </a>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="menu-part tab-pane fade map" id="location" style="height:400px;">
                {{--<iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.9147718689!2d-74.11976358820196!3d40.69740344169578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2s{{$restaurant['restaurant_gps_address']}}!5e0!3m2!1sen!2sin!4v1568001991098!5m2!1sen!2sin"
                  style="border:0;" allowfullscreen=""></iframe>--}}
                  <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=660&amp;height=448&amp;hl=en&amp;q={{$restaurant['restaurant_gps_address']}}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><style>.mapouter{position:relative;text-align:right;width:770px;height:340px;}.gmap_canvas {overflow:hidden;background:none!important;width:770px;height:340px;}.gmap_iframe {width:770px!important;height:340px!important;}@media (max-width: 767px){ .gmap_iframe { width: 320px!important;}}</style>
              </div>
              <div class="menu-part tab-pane fade" id="book">
                <div class="table-book">
                  <form id="booktable" method="post">
                    @csrf
                    <div class="row form-group">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="firstname" placeholder="First name">
                        <input type="hidden" class="form-control" name="restaurant_id" value="{{$restaurant->restaurant_id}}" placeholder="First name">
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="lastname" placeholder="Last name">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="email" class="form-control" name="email" id="inputEmail4"
                          placeholder="Email">
                      </div>
                      <div class="col-sm-6">
                        <input type="number" class="form-control" name="phone" placeholder="Phone No:">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="datetime-local" class="form-control" name="date_time" placeholder="Choose Date & Time">
                      </div>
                      <div class="col-sm-6">
                        <input type="number" name="person" class="form-control" placeholder="Person">
                      </div>
                    </div>
                    <div class="text-end">
                      <button class="btn btn-solid" name="submit-table" type="button" onclick="booktable()">submit</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="menu-part tab-pane fade review" id="review">
                @foreach($restaurant_review as $review)
                <div class="review-box">
                  <div class="rating">
                    @foreach(range(1,5) as $i)
                        @if($review->restaurant_rate >0)
                            @if($review->restaurant_rate >0.9)
                                <i class="fas fa-star"></i>
                            @elseif($review->restaurant_rate >0.2 && $review->restaurant_rate < 0.9)
                                <i class="fas fa-star-half-alt"></i>
                            @endif
                        @endif
                        @php $review->restaurant_rate--; @endphp
                    @endforeach
                  </div>
                  <h6>by {{$review->name}}, {{ \Carbon\Carbon::parse( $review->created_at )->format('M d, Y') }}</h6>
                  <p>{{$review->restaurant_review}}</p>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <!-- <div class="special-section related-box ratio3_2 grid-box">
            <div class="slider-3 no-arrow">
              <div>
                <div class="special-box p-0">
                  <div class="special-img">
                    <a href="#">
                      <img src="{{asset('front-end/assets')}}/images/restaurant/dishes/7.jpg"
                        class="img-fluid blur-up lazyload bg-img" alt="">
                    </a>
                  </div>
                  <div class="special-content restaurant-detail">
                    <a href="#">
                      <h5>italian restro
                        <span class="positive">4.5 <i class="fas fa-star"></i></span>
                      </h5>
                    </a>
                    <ul>
                      <li>fast food, cafe, italian</li>
                      <li>11.30am - 11.30pm (mon-sun)</li>
                      <li>cost $25 for two</li>
                    </ul>
                  </div>
                  <div class="label-offer">Recommended</div>
                </div>
              </div>
              <div>
                <div class="special-box p-0">
                  <div class="special-img">
                    <a href="#">
                      <img src="{{asset('front-end/assets')}}/images/restaurant/dishes/10.jpg"
                        class="img-fluid blur-up lazyload bg-img" alt="">
                    </a>
                  </div>
                  <div class="special-content restaurant-detail">
                    <a href="#">
                      <h5>italian restro
                        <span class="positive">4.5 <i class="fas fa-star"></i></span>
                      </h5>
                    </a>
                    <ul>
                      <li>fast food, cafe, italian</li>
                      <li>11.30am - 11.30pm (mon-sun)</li>
                      <li>cost $25 for two</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div>
                <div class="special-box p-0">
                  <div class="special-img">
                    <a href="#">
                      <img src="{{asset('front-end/assets')}}/images/restaurant/dishes/12.jpg"
                        class="img-fluid blur-up lazyload bg-img" alt="">
                    </a>
                  </div>
                  <div class="special-content restaurant-detail">
                    <a href="#">
                      <h5>italian restro
                        <span class="nagative">3.2 <i class="fas fa-star"></i></span>
                      </h5>
                    </a>
                    <ul>
                      <li>fast food, cafe, italian</li>
                      <li>11.30am - 11.30pm (mon-sun)</li>
                      <li>cost $25 for two</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div>
                <div class="special-box p-0">
                  <div class="special-img">
                    <a href="#">
                      <img src="{{asset('front-end/assets')}}/images/restaurant/dishes/13.jpg"
                        class="img-fluid blur-up lazyload bg-img" alt="">
                    </a>
                  </div>
                  <div class="special-content restaurant-detail">
                    <a href="#">
                      <h5>italian restro
                        <span class="nagative">2.8 <i class="fas fa-star"></i></span>
                      </h5>
                    </a>
                    <ul>
                      <li>fast food, cafe, italian</li>
                      <li>11.30am - 11.30pm (mon-sun)</li>
                      <li>cost $25 for two</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
        <div class="col-xl-3 col-lg-4" >
          <div class="sticky-cls-top">
            <div class="single-sidebar order-cart-right cart_items">
              @include('WEB.partial-pages.cart-items',['restaurant_name_code'=>$restaurant->restaurant_name_code,'checkout'=>0,'cart'=>$cart])
            </div>
            <div class="single-sidebar p-0 cartmobile" style="margin-top: 0px;">
              <div class="newsletter-sec">
                <div class="checkout">
                    <a href="{{url('restaurant-checkout')}}/{{$restaurant->restaurant_name_code}}" class="btn btn-solid w-100">checkout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade edit-profile-modal" id="login_model" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
              <div class="card-body" style="border: 0px;">
                  <form>
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-12 col-sm-8 col-12">
                                  <div class="account-sign-in signindiv">
                                      <form method="post" enctype="multipart/form-data" id="singinform">
                                          @csrf
                                          <div id="singin_div">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Mobile No.*</label>
                                                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="04 xxxx xxxx" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="13">
                                                  <input type="hidden" class="form-control" name="country_id" id="country_id" value="{{$restaurant->country_id}}">
                                              </div>
                                          
                                              <button type="button" class="w-100 btn btn-solid" onclick="sendotp()">Submit</button>
                                          </div> 
                                          <div id="otp_div" style="display:none;">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">OTP*</label>
                                                  <input id="otp" name="otp" type="number" class="form-control" placeholder="Enter OTP">
                                              </div>

                                              <a href="#" style="color:black;" class="resend-link" onclick="sendotp()">Resend OTP?</a>

                          <button class="w-100 btn btn-solid" type="button" onclick="login('{{$restaurant->restaurant_name_code}}')">Sign In Now</button>
                                          </div>
                                      </form>
                                      
                                  </div>
                                  <div class="account-sign-in signupdiv" style="display:none;">
                                      <div class="title" style="text-align: center; border-bottom: 1px solid rgba(239, 63, 62, 0.09);">
                                          <h3>Register</h3>
                                      </div>
                                      <form method="post" enctype="multipart/form-data" class="singupform">
                                          @csrf
                                          <div id="singup_div">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Name*</label>
                                                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Mobile No.*</label>
                                                  <input type="number" class="form-control" name="phone" id="phone" placeholder="04 xxxx xxxx" maxlength="10">
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Address*</label>
                                                  <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
                                                  <input type="hidden" name="lat" id="lat" class="form-control" placeholder="Enter lat" required>
                                                  <input type="hidden" name="lng" id="lng" class="form-control" placeholder="Enter lng"  required>
                                              </div>
                                          
                                              <button type="button" class="w-100 btn btn-solid" onclick="sendotpreg()">Submit</button>
                                          </div> 
                                          <div id="otp_div_reg" style="display:none;">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">OTP*</label>
                                                  <input id="otp_reg" name="otp_reg" type="number" class="form-control" placeholder="Enter OTP">
                                              </div>

                                              <a href="#" style="color:black;" class="resend-link" onclick="sendotp()">Resend OTP?</a>

                          <button class="w-100 btn btn-solid" type="button" onclick="register()">Register</button>
                                          </div>
                                      </form>
                                      <div class="button-bottom">
                                              
                                              <div class="divider">
                                                  <h6>or</h6>
                                              </div>
                                              <button type="button" class="w-100 btn btn-solid btn-outline" onclick="signinshow()"><a  style="color: unset;">Sign In Now</a></button>
                                          </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  <!-- section end -->


  <!-- cart mobile -->
  <div class="cart">
    <a href="javascript:void(0)"><i class="fas fa-shopping-cart"></i></a>
  </div>
  <!-- cart mobile -->

  @endsection
  @push('script')
  <script src="{{asset('front-end/assets')}}/js/scrollyspy.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&libraries=places"></script>
<script>


  initMap();
  function initMap(){
  const map = new google.maps.Map(
    document.getElementById("location1"),
    {
      center: { lat: -33.866, lng: 151.196 },
      zoom: 15,
    }
  );

  const request = {
    placeId: "ChIJN1t_tDeuEmsRUsoyG83frY4",
    fields: ["name", "formatted_address", "place_id", "geometry"],
  };

  const infowindow = new google.maps.InfoWindow();
  const service = new google.maps.places.PlacesService(map);

  service.getDetails(request, (place, status) => {
    if (
      status === google.maps.places.PlacesServiceStatus.OK &&
      place &&
      place.geometry &&
      place.geometry.location
    ) {
      const marker = new google.maps.Marker({
        map,
        position: place.geometry.location,
      });

      google.maps.event.addListener(marker, "click", () => {
        const content = document.createElement("div");

        const nameElement = document.createElement("h2");

        nameElement.textContent = place.name;
        content.appendChild(nameElement);

        const placeIdElement = document.createElement("p");

        placeIdElement.textContent = place.place_id;
        content.appendChild(placeIdElement);

        const placeAddressElement = document.createElement("p");

        placeAddressElement.textContent = place.formatted_address;
        content.appendChild(placeAddressElement);

        infowindow.setContent(content);
        infowindow.open(map, marker);
      });
    }
  });
}


  function booktable() {
        
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
      $.post({
          url: '{{ route('book-table') }}',
          data: $('#booktable').serializeArray(),
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
              else if (response.status == 1) {
                document.getElementById("booktable").reset();
                  toastr.success(response.message, {
                      CloseButton: true,
                      ProgressBar: true
                  });
                  return false;
              } else if (response.status == 0) {
                  Swal.fire({
                      icon: 'error',
                      title: 'Cart',
                      text: response.message
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
    <script>
      $(document).ready(function() {
      // local url of page (minus any hash, but including any potential query string)
      $('.dropchange').on('click', function (e) {
          e.preventDefault();
          $('.dropchange').css({ 'color': 'black', 'font-weight': '600','background-color': 'unset'});
          $(this).css({ 'color': '#ef3f3e', 'font-weight': '600','background-color': '#f9f9f9' });
          //$('.dropchange').removeClass('active-color');
          //$(this).addClass('active-color');
          var target = this.hash;
          if (target != '') {
              var $target = $(target);
              $('html, body').stop().animate({
                  'scrollTop': $target.offset().top - 30
              }, 900, 'swing', function () {
                  //window.location.hash = target;
              });
          }
      });
    });
  </script>
  @endpush