<!DOCTYPE html>
<html>
<body>
    <div>
		@php 

    $order = DB::table('order_details')->leftjoin('users','users.id','order_details.user_id')->leftjoin('restaurants','restaurants.restaurant_id','order_details.restaurant_id')->leftjoin('restaurant_outlets','restaurant_outlets.outlet_id','order_details.outlet_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->select('order_details.*','countries.*','restaurant_outlets.*', 'users.id', 'users.name','users.email','users.mobile','users.image', 'restaurants.restaurant_name', 'restaurants.restaurant_image','restaurants.restaurant_mobile','restaurants.restaurant_email','restaurants.license_no')->orderBy('order_details.o_id', 'desc')->where('order_id',session()->get('order_id'))->first();
    
        $order_menu_item = DB::table('order_menu_items')->leftjoin('categories','categories.cat_id','order_menu_items.cat_id')->select('order_menu_items.*', 'categories.cat_name')->orderBy('order_menu_items.order_item_id', 'desc')->where('order_id',session()->get('order_id'))->get();

    @endphp
		<div style="margin:50px">

<div id="m_6582685526045872348m_-5706462527362516307">
		<div style="width:100%;padding-left:1%">
                    <div style="margin-top:0px">
                              
                                  <span><b style="color:#92c500;font-weight:700">ORDER</b>POZ</span>
                               <span style="float:right;font-size:1.2em;color:#92c500">Tax Invoice/Bill of Supply/Cash Memo </span>    
                   </div>
                   <br>
                   
                   <div style="float:right;text-align:right;width:50%">                     
                     <b>Shipping Address : </b>  
                     @if($order->order_type=='Pickup')
                     <br>
                      <span>{{$order->name}}</span>
                     <br>
                    <span><a href="mailto:{{$order->email}}" target="_blank">{{$order->email}}</a></span>
                     <br>
                     <span>{{ $order->gps_address}} </span>
                     @else
                     <br>
                      <span>{{$order->user_name}}</span>
                     <br>
                    <span><a href="mailto:{{ $order->user_email }}" target="_blank">{{ $order->user_email}}</a></span>
                     <br>
                     <span>{{ $order->house_flat_no }}, {{ $order->road_area_name}}-{{ $order->pincode }} </span>
                     @endif
                   </div>
                   <div style="margin-top:30px">
                     <b>Sold By :</b>  
                      <br>{{ $order->restaurant_name }} ({{ $order->outlet_area }})
                      <br> {{ $order->outlet_gps_address }}
                                     
                   </div>
                                   
              </div>
              <div style="width:100%;padding-left:1%">
                
                  <!--  <div style="float:right;text-align:right;width:50%">
                     <b>Shipping Address : </b>  
                     <br>
                      <span>Nikunj</span>
                     <br>
                    <span><a href="mailto:pmunitech2022@gmail.com" target="_blank">pmunitech2022@gmail.com</a></span>
                     <br>
                      <span>12 ,Delhi â€“ Mumbai Expressway, Gujarat, India ,surat ,N/A ,<br>New Delhi - 110064 </span><br><br>
                      
                 </div> -->
                 <div style="width:50%">                
                      <br>Licence No: {{$order->license_no}}
                      <!-- <br>GST Registration No: 06ABJPY9479M1ZE   -->

                </div>
                    <br>
                   
                   <div style="float:left;text-align:left;width:50%">
                     <b>Order Number :  </b>  <span>#{{ $order->order_id }}</span>
                     <br>
                     <b>Order Date :  </b>  <span> {{ date('d M Y H:i A' . config('timeformat'), strtotime($order->created_at)) }}</span>
                     <br>
                     <b>Order Type :  </b>  <span>{{ $order->order_type }}<br>
                     <b>Payment Type :  </b>  <span>{{$order->payment_type}}
                        <!-- @if ($order->order_status == '0')
                           {{('New') }}
                        @elseif($order->order_status == '1')
                            {{('Accepted') }}
                        @elseif($order->order_status == '5')
                            {{('Rejected') }}
                        @elseif($order->order_status == '4')
                            {{('Cancelled') }}
                        @elseif($order->order_status == '3')
                           {{('Completed') }}
                        @endif -->
                     </span>
                  </span></div>
              </div>
          </div>
                        
<div style="width:100%;margin-top:50px">
				<table style="width:100%;border: 1px solid #0a0a0a;font-size:13px">
						<tbody><tr id="m_6582685526045872348m_-5706462527362516307th1" style="background-color:#cacaca;border-style:solid;border-width:1px">
							<th style="border-style:solid;border-width:1px;border-color:#000">Number</th>
							<th style="border-style:solid;border-width:1px;border-color:#000">Category</th>
							<th style="border-style:solid;border-width:1px;border-color:#000">Product</th>
							<th style="border-style:solid;border-width:1px;border-color:#000">Price</th>
							<th style="border-style:solid;border-width:1px;border-color:#000">Qty</th>
							<th style="border-style:solid;border-width:1px;border-color:#000">Total </th>
						</tr>
      @foreach($order_menu_item as $key=>$o_list)
      <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{($o_list->cat_name)}}</td>
      <td>{{($o_list->menu_title)}} @if($o_list->add_on_name != 'N/A') ({{($o_list->add_on_name)}}) @endif</td>
      <td>{{($o_list->per_menu_price)}}{{$order->country_currency}}</td>
      <td>{{ $o_list->menu_qty }}</td>
      <td>{{ $o_list->total_menu_price}}{{$order->country_currency}}</td>
    </tr>
    @endforeach
 
  
  
  <tr id="m_6582685526045872348m_-5706462527362516307th1" style="background-color:#ffffff;border-style:solid;border-width:1px">
             <!--  <th colspan="10" style="border-style:solid;border-width:1px;border-color:#000;padding:5px;text-align:left">Basic Amount: </th>
              <th>Rs.5.00</th> -->

              <td colspan="10" style="border-style:solid;border-width:1px;border-color:#000;padding:5px;text-align:left">Basic Amount <span style="
    float: right;
">{{ isset($order->basic_amount) ? $order->basic_amount : '0.00' }}{{$order->country_currency}}</span></td>
   
            </tr>
            <tr id="m_6582685526045872348m_-5706462527362516307th1" style="background-color:#ffffff;border-style:solid;border-width:1px">



 <td colspan="10" style="border-style:solid;border-width:1px;border-color:#000;padding:5px;text-align:left">Shipping Charges <span style="
    float: right;
">{{ isset($order->shipping_charge) ? $order->shipping_charge : '0.00' }}{{$order->country_currency}}</span></td>
   



            </tr>
         
            <tr id="m_6582685526045872348m_-5706462527362516307th1" style="background-color:#ffffff;border-style:solid;border-width:1px">
              <td colspan="10" style="border-style:solid;border-width:1px;border-color:#000;padding:5px;text-align:left">Offer Code <span style="
    float: right;
">{{ isset($order->coupon_code) ? $order->coupon_code : 'N/A' }}</span></td>
   
            </tr>
                        <tr id="m_6582685526045872348m_-5706462527362516307th1" style="background-color:#ffffff;border-style:solid;border-width:1px">


          <td colspan="10" style="border-style:solid;border-width:1px;border-color:#000;padding:5px;text-align:left">Offer Amount <span style="
    float: right;
">{{ isset($order->coupon_amount) ? $order->coupon_amount : '0.00' }}{{$order->country_currency}} </span></td>
   


            </tr>
                        <tr id="m_6582685526045872348m_-5706462527362516307th1" style="background-color:#ffffff;border-style:solid;border-width:1px">


           
          <td colspan="10" style="border-style:solid;border-width:1px;border-color:#000;padding:5px;text-align:left">Total Amount <span style="
    float: right;
">{{$order->grand_total}}{{$order->country_currency}}</span></td>


            </tr>
            
            <!-- <tr id="m_6582685526045872348m_-5706462527362516307th1" style="background-color:#ffffff;border-style:solid;border-width:1px">
						<th colspan="11" style="border-style:solid;border-width:1px;border-color:#000;padding:5px;text-align:left"><h2>Amount In Words :</h2> </th>
							
						</tr> -->

</tbody></table><div class="yj6qo"></div><div class="adL">

			</div></div><div class="adL">
      
      

      
      
</div></div></div></body>
</html>