<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>ORDERPOZ | Order Invoice</title>
	<meta name="author" content="Angfuzsoft">
	<meta name="description" content="Invce - Invoice HTML Template">
	<meta name="keywords" content="Invce - Invoice HTML Template">
	<meta name="robots" content="INDEX,FOLLOW">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('front-end/assets')}}/images/icon/footer-logo.png">
	<link rel="manifest" href="{{asset('invoice/assets')}}/img/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="assets/img/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('invoice/assets')}}/css/app.min.css">
	<link rel="stylesheet" href="{{asset('invoice/assets')}}/css/style.css">
	<style>
		.veg span:before {
			content: "";
			left: 3px;
			width: 8px;
			height: 8px;
			background-color: green;
			position: absolute;
			border-radius: 100%;
			top: 18px;
		}
		.veg span:after {
			content: "";
			left: 0;
			position: absolute;
			width: 14px;
			height: 14px;
			border: 1px solid green;
			top: 15px;
		}
		.non-veg span:before {
			content: "";
			left: 3px;
			width: 8px;
			height: 8px;
			background-color: red;
			position: absolute;
			border-radius: 100%;
			top: 18px;
		}
		.non-veg span:after {
			content: "";
			left: 0;
			position: absolute;
			width: 14px;
			height: 14px;
			border: 1px solid red;
			top: 15px;
		}
	</style>
</head>
<body>
	<div class="invoice-container-wrap">
		<div class="invoice-container">
			<main>
				<div class="as-invoice invoice_style2">
					<div class="download-inner" id="download_section">
						<header class="as-header header-layout1">
							<div class="row align-items-center justify-content-between">
								<div class="col-auto"><p class="mb-0">
									<b>INVOICE NO: #{{$order_detail->order_id}}</b>
								</p>
							</div>
							<div class="col-auto">
								<div class="header-logo">
									<a href="{{route('dashboard')}}">
										<img src="{{asset('front-end/assets')}}/images/icon/footer-logo.png" alt="Invce">
									</a>
								</div>
							</div>
						</div>
						<div class="header-bottom">
							<div class="row align-items-center justify-content-between">
								<div class="col-auto">
									<div class="header-bottom_left">
										<p><b>User Name : </b>{{$order_detail->name}}</p>
										<div class="shape"></div>
										<div class="shape"></div>
									</div>
								</div>
								<div class="col-auto">
									<div class="header-bottom_right">
										<div class="shape"></div>
										<div class="shape"></div>
										<p><b>Date: </b>{{ date('d M Y H:i A' . config('timeformat'), strtotime($order_detail['created_at'])) }}</p>
									</div>
								</div>
							</div>
						</div>
					</header>
					<div class="row justify-content-between">
						<div class="col-auto">
							<div class="booking-info">
								<p><b>Order ID: </b>{{$order_detail->order_id}}</p>
                                <p><b>Order Type: </b>{{$order_detail->order_type}}</p>
							</div>
						</div>
						
						<div class="col-auto">
							<div class="booking-info">
								<p><b>Order Status: </b>@if($order_detail['order_status']=='0')New
                                @elseif($order_detail['order_status']=='1')Accepted
                                @elseif($order_detail['order_status']=='2')On the way
                                @elseif($order_detail['order_status']=='5')Rejected
                                @elseif($order_detail['order_status']=='4')Cancelled
                                @elseif($order_detail['order_status']=='3')Completed
                                @endif</p>
                                <p><b>Payment Mode: </b>{{$order_detail->payment_type}}</p>
							</div>
						</div>
					</div>
					<div class="row gx-0">
						<div class="col-6">
							<div class="address-box address-left" style="height: 85%;">
								<b>Customer Information:</b>
								@if($order_detail->order_type=='Pickup')
									<address>{{$order_detail->name}}<br>Mobile No.: {{$order_detail->mobile}}<br>Email: {{$order_detail->email}}<br>Address: {{$order_detail->gps_address}}<br></address>
								@else
									<address>{{$order_detail->user_name}}<br>Mobile No.: {{$order_detail->user_mobile}}<br>Email: {{$order_detail->user_email}}<br>Address: {{$order_detail->house_flat_no}}, {{$order_detail->road_area_name}}-{{$order_detail->pincode}}<br></address>
								@endif
							</div>
						</div>
						<div class="col-6">
							<div class="address-box address-right" style="height: 85%;"><b>Restaurant Details:</b>
								<address>{{$order_detail->restaurant_name}} ({{$order_detail->outlet_area}})<br>Mobile No.: {{$order_detail->restaurant_mobile}}<br>Email: {{$order_detail->restaurant_email}}<br>Address: {{$order_detail->outlet_gps_address}}<br></address>
							</div>
						</div>
					</div>
					<table class="invoice-table">
						<thead>
							<tr>
								<th>Items</th>
								<th>Price</th>
								<th>QTY</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						@foreach($order_menu_item as $key=>$o_list)
							<tr>
								<td><div class="@if($o_list['is_veg']=='0') non-veg @else veg @endif"><span>{{($o_list['menu_title'])}} @if($o_list['add_on_name'] != 'N/A') ({{$o_list['add_on_name']}}) @endif</span></div></td>
								<td>{{($o_list['per_menu_price'])}}{{$order_detail->country_currency}}</td>
								<td>{{ $o_list['menu_qty'] }}</td>
								<td>{{ $o_list['total_menu_price'] }}{{$order_detail->country_currency}}</td>
							</tr>
						@endforeach
							<tr>
								<td colspan="3"> </td>
							</tr>
						</tbody>
					</table>
					<div class="row justify-content-between">
						<div class="col-auto">
							<div class="invoice-left">
								
							</div>
						</div>
						<div class="col-auto">
							<table class="total-table">
								<tr>
									<th>Sub Total:</th>
									<td>{{ isset($order_detail['basic_amount']) ? $order_detail['basic_amount'] : '0.00' }}{{$order_detail->country_currency}}</td>
								</tr>
								<tr>
									<th>Shipping Charge:</th>
									<td>+ {{ isset($order_detail['shipping_charge']) ? $order_detail['shipping_charge'] : '0.00' }}{{$order_detail->country_currency}}</td>
								</tr>
								<tr>
									<th>Offer Code:</th>
									<td>{{ isset($order_detail['coupon_code']) ? $order_detail['coupon_code'] : 'N/A' }}</td>
								</tr>
								<tr>
									<th>Offer Amount:</th>
									<td>- {{ isset($order_detail['coupon_amount']) ? $order_detail['coupon_amount'] : '0.00' }}{{$order_detail->country_currency}}</td>
								</tr>
								<tr>
									<th>Total:</th>
									<td>{{$order_detail->grand_total}}{{$order_detail->country_currency}}</td>
								</tr>
							</table>
						</div>
					</div>
					
						<p class="invoice-note mt-3 text-center">
							<svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.22969 12.6H9.77031V11.4H3.22969V12.6ZM3.22969 9.2H9.77031V8H3.22969V9.2ZM1.21875 16C0.89375 16 0.609375 15.88 0.365625 15.64C0.121875 15.4 0 15.12 0 14.8V1.2C0 0.88 0.121875 0.6 0.365625 0.36C0.609375 0.12 0.89375 0 1.21875 0H8.55156L13 4.38V14.8C13 15.12 12.8781 15.4 12.6344 15.64C12.3906 15.88 12.1063 16 11.7812 16H1.21875ZM7.94219 4.92V1.2H1.21875V14.8H11.7812V4.92H7.94219ZM1.21875 1.2V4.92V1.2V14.8V1.2Z" fill="#1CB9C8"/>
							</svg><b>NOTE: </b>This is computer generated receipt and does not require physical signature.</p>
						</div>
							<div class="invoice-buttons">
								<button class="print_btn">
									<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.9688 8.46875C12.1146 8.32292 12.2917 8.25 12.5 8.25C12.7083 8.25 12.8854 8.32292 13.0312 8.46875C13.1771 8.61458 13.25 8.79167 13.25 9C13.25 9.20833 13.1771 9.38542 13.0312 9.53125C12.8854 9.67708 12.7083 9.75 12.5 9.75C12.2917 9.75 12.1146 9.67708 11.9688 9.53125C11.8229 9.38542 11.75 9.20833 11.75 9C11.75 8.79167 11.8229 8.61458 11.9688 8.46875ZM13.5 5.5C14.1875 5.5 14.7708 5.75 15.25 6.25C15.75 6.72917 16 7.3125 16 8V12C16 12.1458 15.9479 12.2708 15.8438 12.375C15.7604 12.4583 15.6458 12.5 15.5 12.5H13.5V15.5C13.5 15.6458 13.4479 15.7604 13.3438 15.8438C13.2604 15.9479 13.1458 16 13 16H3C2.85417 16 2.72917 15.9479 2.625 15.8438C2.54167 15.7604 2.5 15.6458 2.5 15.5V12.5H0.5C0.354167 12.5 0.229167 12.4583 0.125 12.375C0.0416667 12.2708 0 12.1458 0 12V8C0 7.3125 0.239583 6.72917 0.71875 6.25C1.21875 5.75 1.8125 5.5 2.5 5.5V1C2.5 0.729167 2.59375 0.5 2.78125 0.3125C2.96875 0.104167 3.1875 0 3.4375 0H10.375C10.7917 0 11.1458 0.145833 11.4375 0.4375L13.0625 2.0625C13.3542 2.35417 13.5 2.70833 13.5 3.125V5.5ZM4 1.5V5.5H12V3.5H10.5C10.3542 3.5 10.2292 3.45833 10.125 3.375C10.0417 3.27083 10 3.14583 10 3V1.5H4ZM12 14.5V12.5H4V14.5H12ZM14.5 11V8C14.5 7.72917 14.3958 7.5 14.1875 7.3125C14 7.10417 13.7708 7 13.5 7H2.5C2.22917 7 1.98958 7.10417 1.78125 7.3125C1.59375 7.5 1.5 7.72917 1.5 8V11H14.5Z" fill="white"/>
									</svg>
									<span>Print</span>
								</button>
								
							</div>
						</div>
					</main>
				</div>
			</div>
			<script src="{{asset('invoice/assets')}}/js/vendor/jquery-3.6.0.min.js"></script>
			<script src="{{asset('invoice/assets')}}/js/app.min.js"></script>
			<script src="{{asset('invoice/assets')}}/js/main.js"></script>
		</body>
		</html>