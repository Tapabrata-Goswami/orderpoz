<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API_RESTAURANT\AuthController;
use App\Http\Controllers\API_RESTAURANT\DetailController;
use App\Http\Controllers\API_RESTAURANT\OrderController;


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
// Public routes

Route::post('send-otp', [AuthController::class, 'sendotp']);
Route::post('check-mobile', [AuthController::class, 'check']);
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
Route::get('profile-detail', [AuthController::class, 'profile_detail']);
Route::post('update-profile', [AuthController::class, 'updateprofile']);
Route::post('change-password', [AuthController::class, 'change_password']);
Route::post('forgot-password', [AuthController::class, 'forgot_password']);
Route::get('menu-on-off/{restaurant_cat_id}', [AuthController::class, 'menu_on_off']);
Route::post('update-menu-price', [AuthController::class, 'updatemenu_price']);
Route::post('outlets-add', [AuthController::class, 'outlets_add']);
Route::get('outlets-list', [AuthController::class, 'outlets_list']);
Route::get('book-table-list', [AuthController::class, 'book_table_list']);

Route::get('details', [DetailController::class, 'show']);
Route::post('fileupload', [DetailController::class, 'fileupload']);
Route::get('local-noti-list', [DetailController::class, 'localnotishow']);
Route::get('review-list', [DetailController::class, 'reviewshow']);
Route::post('time-slot-add', [DetailController::class, 'timeslot_add']);
Route::get('time-slot-list', [DetailController::class, 'timeslot_list']);
Route::get('country-list', [DetailController::class, 'country_show']);
Route::post('close-restaurant', [DetailController::class, 'close_restaurant']);

Route::get('menu-list', [AuthController::class, 'menu_list']);

Route::get('order-list/{order_status}', [OrderController::class, 'order_list']);
Route::get('order-detail/{order_id}', [OrderController::class, 'order_detail']);
Route::post('update-order-status', [OrderController::class, 'update_status']);
Route::get('report-list', [OrderController::class, 'report_list']);