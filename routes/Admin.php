<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Admin', 'prefix' => 'panel', 'as' => 'panel.'], function () {

    Route::get('/', function (){
        return redirect()->route('panel.auth.login');
    });

    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'Logincontroller@login')->name('login');
        Route::post('login', 'Logincontroller@submit')->name('submit')->middleware('actch');
        Route::get('logout', 'Logincontroller@logout')->name('logout');
    });

    /*authenticated*/
    Route::group(['middleware' => ['admin']], function () {

        //dashboard routes
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');
        Route::post('order-stats', 'DashboardController@order_stats')->name('order-stats');
        Route::get('/change-password', 'BusinessSettingsController@change_password')->name('change_password');
        Route::Post('/Update-Profile', 'BusinessSettingsController@Update_profile')->name('Update-Profile');
        Route::Post('/Update-password', 'BusinessSettingsController@Update_password')->name('Update-password');

        //system routes
        Route::get('search-function', 'SystemController@search_function')->name('search-function');
        Route::get('get-new-order', 'SystemController@store_data')->name('get-new-order');

        Route::group(['prefix' => 'Subadmin', 'as' => 'Subadmin.'], function () {
            Route::get('list', 'SubadminController@subadmin_list')->name('list');
            Route::get('add-subadmin', 'SubadminController@add_subadmin')->name('add-subadmin');
            Route::post('store', 'SubadminController@insert_subadmin')->name('store');
            Route::get('edit/{id}', 'SubadminController@edit_subadmin')->name('edit');
            Route::get('status-update/{id}/{sub_status}', 'SubadminController@update_subadmin_status')->name('status-update');
            Route::get('delete-subadmin/{id}', 'SubadminController@delete_subadmin')->name('delete-subadmin');
        });

        Route::group(['prefix' => 'Category', 'as' => 'Category.'], function () {
            Route::get('list', 'CategoryController@category_list')->name('list');
            Route::post('store', 'CategoryController@insert_category')->name('store');
            Route::post('update', 'CategoryController@update_category')->name('update');
            Route::get('status-update/{cat_id}/{cat_status}', 'CategoryController@update_category_status')->name('status-update');
            Route::get('status-update-show/{cat_id}/{is_show}', 'CategoryController@update_category_status_show')->name('status-update-show');

            Route::get('catlist', 'CategoryController@rest_category_list')->name('catlist');
            Route::post('catstore', 'CategoryController@insert_rest_category')->name('catstore');
            Route::post('catupdate', 'CategoryController@update_rest_category')->name('catupdate');
        });

        Route::group(['prefix' => 'Item', 'as' => 'Item.'], function () {
            Route::get('list', 'ItemController@item_list')->name('list');
            Route::post('store', 'ItemController@insert_item')->name('store');
            Route::post('update', 'ItemController@update_item')->name('update');
            Route::get('status-update/{restaurant_cat_id}/{rest_menu_status}', 'ItemController@update_item_status')->name('status-update');
            Route::get('get-cat/{restaurant_id}', 'ItemController@get_cat')->name('get-cat');
            Route::post('filter', 'ItemController@filter')->name('filter');
            Route::get('filter/reset', 'ItemController@filter_reset');

            Route::post('addon-add', 'ItemController@insert_addon')->name('addon-add');
            Route::get('add-on-list/{restaurant_cat_id}', 'ItemController@addon_list')->name('add-on-list');
            Route::get('delete-addon/{add_on_id}}', 'ItemController@delete_addon')->name('delete-addon');
        });

        Route::group(['prefix' => 'Slider', 'as' => 'Slider.'], function () {
            Route::get('list', 'SliderController@slider_list')->name('list');
            Route::post('store', 'SliderController@insert_slider')->name('store');
            Route::post('update', 'SliderController@update_slider')->name('update');
            Route::get('delete-slider/{slider_id}}', 'SliderController@delete_slider')->name('delete-slider');
        });

        Route::group(['prefix' => 'User', 'as' => 'User.'], function () {
            Route::get('list', 'UserController@user_list')->name('list');
            Route::get('status-update/{id}/{status}', 'UserController@update_user_status')->name('status-update');
            Route::get('lp-point-list', 'UserController@point_list')->name('lp-point-list');
        });

        Route::group(['prefix' => 'Restaurant', 'as' => 'Restaurant.'], function () {
            Route::get('list', 'RestaurantController@restaurant_list')->name('list');
            Route::get('add-restaurant', 'RestaurantController@add_restaurant')->name('add-restaurant');
            Route::post('store', 'RestaurantController@insert_restaurant')->name('store');
            Route::get('edit/{restaurant_id}', 'RestaurantController@edit_restaurant')->name('edit');
            Route::get('remove-image', 'RestaurantController@remove_image')->name('remove-image');
            Route::get('status-update/{restaurant_id}/{restaurant_status}', 'RestaurantController@update_restaurant_status')->name('status-update');
            Route::get('status-update-book-table/{restaurant_id}/{book_table}', 'RestaurantController@update_book_table_status')->name('status-update-book-table');
            Route::get('status-update-multiple-outlet/{restaurant_id}/{is_outlet}', 'RestaurantController@update_multiple_outlet_status')->name('status-update-multiple-outlet');
            Route::get('detail/{restaurant_id}/{tab?}', 'RestaurantController@restaurant_detail')->name('detail');
            Route::post('add-time-slot', 'RestaurantController@add_timeslot')->name('add-time-slot');
            Route::post('close-time-slot', 'RestaurantController@close_timeslot')->name('close-time-slot');
            Route::post('store-outlet', 'RestaurantController@insert_outlet')->name('store-outlet');
            Route::get('status-update-outlet/{outlet_id}/{outlet_status}', 'RestaurantController@update_outlet_status')->name('status-update-outlet');
        });

        Route::group(['prefix' => 'Detail', 'as' => 'Detail.'], function () {
            Route::any('tc', 'DetailController@tc')->name('tc');
            Route::any('change-tc', 'DetailController@change_tc')->name('change-tc');

            Route::any('privacy', 'DetailController@privacy')->name('privacy');
            Route::any('change-privacy', 'DetailController@change_privacy')->name('change-privacy');

            Route::any('refund', 'DetailController@refund')->name('refund');
            Route::any('change-refund', 'DetailController@change_refund')->name('change-refund');

            Route::any('contact-us', 'DetailController@contact_us')->name('contact-us');
            Route::any('change-contact-us', 'DetailController@change_contact_us')->name('change-contact-us');

            Route::any('about', 'DetailController@about')->name('about');
            Route::any('change-about', 'DetailController@change_about')->name('change-about');

            Route::any('other', 'DetailController@other')->name('other');
            Route::any('changes-other', 'DetailController@change_other')->name('change-other');

            Route::any('notification', 'DetailController@notification')->name('notification');
            Route::any('noti', 'DetailController@noti')->name('noti');

            Route::any('partner-notification', 'DetailController@partner_notification')->name('partner-notification');
            Route::any('partner-noti', 'DetailController@partner_noti')->name('partner-noti');

            Route::get('web-contact-list', 'DetailController@web_contact_list')->name('web-contact-list');
            Route::get('delete-web-contact/{contact_id}}', 'DetailController@delete_web_contact')->name('delete-web-contact');

        });

        Route::group(['prefix' => 'Order', 'as' => 'Order.'], function () {
            Route::get('list/{status}', 'OrderController@list')->name('list');
            Route::get('detail/{o_id}', 'OrderController@detail')->name('detail');
            Route::get('search', 'OrderController@search')->name('search');
            Route::post('filter', 'OrderController@filter')->name('filter');
            Route::get('filter/reset', 'OrderController@filter_reset');
            Route::get('status/{order_id}/{order_status}', 'OrderController@status')->name('status');
        });

        Route::group(['prefix' => 'Report', 'as' => 'Report.'], function () {
            Route::any('order-report', 'ReportController@order_report')->name('order-report');
            Route::any('order-data', 'ReportController@order_data')->name('order-data');
        });

        Route::group(['prefix' => 'Offer', 'as' => 'Offer.'], function () {
            Route::get('list', 'OfferController@offer_list')->name('list');
            Route::post('store', 'OfferController@insert_offer')->name('store');
            Route::post('update', 'OfferController@update_offer')->name('update');
            Route::get('status-update/{coupon_id}/{coupon_status}', 'OfferController@update_offer_status')->name('status-update');
        });

        Route::group(['prefix' => 'Blog', 'as' => 'Blog.'], function () {
            Route::get('list', 'BlogController@blog_list')->name('list');
            Route::post('store', 'BlogController@insert_blog')->name('store');
            Route::post('update', 'BlogController@update_blog')->name('update');
            Route::get('status-update/{blog_id}/{blog_status}', 'BlogController@update_blog_status')->name('status-update');
            Route::get('delete-blog/{blog_id}}', 'BlogController@delete_blog')->name('delete-blog');
        });

        Route::group(['prefix' => 'Country', 'as' => 'Country.'], function () {
            Route::get('list', 'CountryController@country_list')->name('list');
            Route::post('store', 'CountryController@insert_country')->name('store');
            Route::post('update', 'CountryController@update_country')->name('update');
        });
          
    });
    
});

