<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DetailController;
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('authentication-failed', function () {
    $errors = [];
    array_push($errors, ['code' => 'auth-001','success' => 'false', 'message' => 'Unauthorized.']);
    return response()->json([
        'errors' => $errors
    ], 200);
})->name('authentication-failed');

Route::post('send-otp', [AuthController::class, 'sendotp']);
Route::post('check-mobile', [AuthController::class, 'check']);
Route::post('register', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'signin']);
Route::post('fileupload', [DetailController::class, 'fileupload']);
Route::get('details', [DetailController::class, 'show']);
Route::get('country-list', [DetailController::class, 'country_show']);

Route::get('slider-list', [DetailController::class, 'slider_show']);
Route::get('coupon-list/{user_id}', [DetailController::class, 'coupon_show']);

Route::get('category-list', [RestaurantController::class, 'category_list']);
Route::post('nearest-restaurant-list', [RestaurantController::class, 'near_restaurant_list']);
Route::post('categorywise-restaurant-list', [RestaurantController::class, 'catwise_restaurant_list']);
Route::get('restaurant-detail/{restaurant_id}/{outlet_id}', [RestaurantController::class, 'restaurant_detail']);
Route::get('restaurant-gallery/{restaurant_id}', [RestaurantController::class, 'restaurant_gallery']);
Route::get('restaurant-menu-list/{restaurant_id}/{user_id}', [RestaurantController::class, 'restaurant_menu_list']);
Route::get('restaurant-review-list/{restaurant_id}', [RestaurantController::class, 'restaurant_review_list']);
Route::get('restaurant-outlet-list/{restaurant_id}', [RestaurantController::class, 'restaurant_outlet_list']);
Route::get('add-ons-list/{menu_id}', [RestaurantController::class, 'add_ons_list']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('update-user-profile', [AuthController::class, 'updateprofile']);
    Route::get('user-detail', [AuthController::class, 'user_detail']);

    // Route::get('slider-list', [DetailController::class, 'slider_show']);
    // Route::get('coupon-list', [DetailController::class, 'coupon_show']);
    Route::get('local-noti-list', [DetailController::class, 'localnotishow']);
    Route::post('review-add', [DetailController::class, 'reviewstore']);

    // Route::get('category-list', [RestaurantController::class, 'category_list']);
    // Route::get('nearest-restaurant-list', [RestaurantController::class, 'near_restaurant_list']);
    // Route::get('categorywise-restaurant-list/{cat_id}', [RestaurantController::class, 'catwise_restaurant_list']);
    // Route::get('restaurant-detail/{restaurant_id}/{outlet_id}', [RestaurantController::class, 'restaurant_detail']);
    // Route::get('restaurant-gallery/{restaurant_id}', [RestaurantController::class, 'restaurant_gallery']);
    // Route::get('restaurant-menu-list/{restaurant_id}', [RestaurantController::class, 'restaurant_menu_list']);
    // Route::get('restaurant-review-list/{restaurant_id}', [RestaurantController::class, 'restaurant_review_list']);
    // Route::get('restaurant-outlet-list/{restaurant_id}', [RestaurantController::class, 'restaurant_outlet_list']);
    // Route::get('add-ons-list/{menu_id}', [RestaurantController::class, 'add_ons_list']);
    Route::post('add-book-table', [RestaurantController::class, 'add_book_table']);
    Route::get('book-table-list', [RestaurantController::class, 'book_table_list']);

    Route::post('add-to-cart', [OrderController::class, 'add_to_cart']);
    Route::get('cart-list', [OrderController::class, 'cart_list']);
    Route::post('cart-update', [OrderController::class, 'cart_update']);
    Route::post('cart-item-remove', [OrderController::class, 'cart_item_remove']);
    Route::post('order-place', [OrderController::class, 'order_place']);
    Route::get('order-list/{order_status}', [OrderController::class, 'order_list']);
    Route::get('order-detail/{order_id}', [OrderController::class, 'order_detail']);
    Route::get('update-status/{order_id}', [OrderController::class, 'update_status']);
});
