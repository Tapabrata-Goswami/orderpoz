<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\WebController;
use App\Http\Controllers\WEB\CartController;
use App\Http\Controllers\WEB\AuthController;
use App\Http\Controllers\WEB\OrderController;
use App\Http\Controllers\WEB\StripePaymentController;
use App\Http\Controllers\WEB\RestaurantController;
use App\Http\Controllers\WEB\smtpcontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('WEB/home');
// });
Route::get('/', [WebController::class,'home'])->name('home');
Route::get('/restaurant-order/{restaurant_name_code}', [WebController::class,'restaurant_order'])->name('restaurant-order');
Route::post('cart-add', [CartController::class,'addToCart'])->name('cart-add');
Route::post('nav-cart-items', [CartController::class,'updateNavCart'])->name('nav-cart');
Route::post('nav-checkout', [CartController::class,'updateNavCheckout'])->name('nav-checkout');

Route::post('cart-quantity-plus', [CartController::class,'updateQuantityPlus'])->name('cart-quantity-plus');
Route::post('cart-quantity-minus', [CartController::class,'updateQuantityMinus'])->name('cart-quantity-minus');
Route::post('apply-coupon', [CartController::class,'apply_coupon'])->name('apply-coupon');
Route::post('remove-coupon', [CartController::class,'remove_coupon'])->name('remove-coupon');

Route::any('checkout', [OrderController::class,'checkout'])->name('checkout');
Route::get('restaurant-order-success', [OrderController::class,'order_success'])->name('restaurant-order-success');
Route::get('order-mail', [OrderController::class,'order_mail'])->name('order-mail');

Route::get('mail', [smtpcontroller::class,'mail'])->name('mail');

Route::get('/restaurant-checkout/{restaurant_name_code}', [WebController::class,'restaurant_checkout'])->name('restaurant-checkout');
Route::post('/book-table', [WebController::class,'book_table'])->name('book-table');

Route::get('sign-in', [AuthController::class,'signin'])->name('sign-in');
Route::post('send-otp-login', [AuthController::class,'sendotplogin'])->name('send-otp-login');
Route::any('login', [AuthController::class,'login'])->name('login');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::post('send-otp-register', [AuthController::class,'sendotpregister'])->name('send-otp-register');
Route::any('register', [AuthController::class,'register'])->name('register');
Route::post('nav-header-view', [AuthController::class,'updateNavview'])->name('nav-header-view');

Route::group(['middleware'=>['user']], function () {
    Route::get('dashboard', [AuthController::class,'dashboard'])->name('dashboard');
    Route::post('edit-profile', [AuthController::class,'edit_profile'])->name('edit-profile');

    Route::get('order-detail/{order_id}', [OrderController::class,'orderdetail'])->name('order-detail');

    Route::post('/order-type-session', [WebController::class,'order_type_session'])->name('order-type-session');
    Route::post('/cancel-order', [OrderController::class,'cancel_order'])->name('cancel-order');
    Route::post('/review-rating', [OrderController::class,'review_rating'])->name('review-rating');

    Route::get('/stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
    Route::post('/strippayment', [StripePaymentController::class, 'strippayment'])->name('strippayment');
});

Route::get('blog-list', [WebController::class,'blog_list'])->name('blog-list');
Route::get('blog-detail/{blog_id}', [WebController::class,'blog_detail'])->name('blog-detail');
Route::get('about-us', [WebController::class,'about_us'])->name('about-us');
Route::get('terms-condition', [WebController::class,'terms_condition'])->name('terms-condition');
Route::get('privacy-policy', [WebController::class,'privacy_policy'])->name('privacy-policy');
Route::get('contact-us', [WebController::class,'contact'])->name('contact-us');
Route::post('contact-store', [WebController::class,'contact_store'])->name('contact-store');

Route::get('faq/', function () {
    return view('WEB/faq');
});

//Restaurant Registration
Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
    Route::get('restaurant-registration', [RestaurantController::class,'create_restaurant'])->name('restaurant-registration');
    Route::post('restaurant-store', [RestaurantController::class,'store_restaurant'])->name('restaurant-store');
    Route::post('check-mobile', [RestaurantController::class,'check_mobile'])->name('check-mobile');
});
