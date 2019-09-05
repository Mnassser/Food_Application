<?php

use Illuminate\Http\Request;

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
Route::get('category-list','MainController@categoryList');
Route::get('resturant-list','MainController@resturantList');
Route::get('product-list','MainController@productList');
Route::get('city-list','MainController@cityList');
Route::get('district-list','MainController@districtList');
Route::get('product','MainController@Product');
Route::get('rates','MainController@Rates');
Route::get('rest-info','MainController@RestInfo');
Route::post('reset-password','MainController@resetPassword');
Route::post('restore-password','MainController@restorePassword');
Route::get('offers-list','OffersController@offersList');
Route::post('report','MainController@Report');
Route::post('search-by-city','MainController@searchByCity');
Route::post('search-by-name','MainController@searchByName');
Route::post('store-resturant','ResturatController@storeResturant');
Route::post('login-resturant','ResturatController@loginResturant');
Route::post('store-client','ClientController@storeClient');
Route::post('login-client','ClientController@loginClient');
Route::get('rates-list','MainController@rates_list');


/*single offer*/



Route::group(['middleware'=>'auth:resturant'],function(){
Route::group(['middleware' => 'deleted'], function() {

Route::group(['middleware' => 'active'], function() {
Route::get('resturat-offers-list','MainController@resturatOffersList');

Route::post('resturant-profile','ResturatController@resturant_profile');
Route::post('add-offer','OffersController@addOffer')->middleware('pay');
Route::post('update-offer','OffersController@updateOffer')->middleware('pay');
Route::post('delete-offer','OffersController@deleteOffer')->middleware('pay');
Route::post('create-resturant-token','TokensController@create_resturant_token');
Route::post('delete-resturant-token','TokensController@delete_resturant_token');

//////////Settings
Route::post('settings','MainController@settings');

////////////products

Route::post('delete-product','ProductsController@delete_product')->middleware('pay');
Route::post('add-product','ProductsController@add_product')->middleware('pay');
Route::post('update-product','ProductsController@update_product')->middleware('pay');
Route::post('resturant-product-list','ProductsController@resturant_product_list');
	/////

Route::post('commission','MainController@commission');


Route::post('payment','ResturatController@payment');

//////////////orders
Route::post('accept-order','OrdersController@accept_order')->middleware('pay');
Route::post('declien-order','OrdersController@declien_order');
Route::post('delever-order','OrdersController@delever_order')->middleware('pay');
Route::post('single-order','OrdersController@single_order');
Route::post('new-orders-list','OrdersController@new_order_list')->middleware('pay');
Route::post('now-orders-list','OrdersController@now_order_list');
Route::post('old-order-list','OrdersController@old_order_list');

////
////////Noftification
Route::post('resturant-notification-list','NotificationsController@resturant_notification_list')->middleware('pay');
	
Route::post('resturant-notification','NotificationsController@resturant_notification')->middleware('pay');

});
});
});



/////////////////Clients////////
Route::group(['middleware'=>'auth:client'],function(){

Route::group(['middleware' => 'deleted'], function() {
	
Route::post('rate-resturat','ClientController@rate_resturat');
Route::post('client-profile','ClientController@clientProfile');
Route::post('create-client-token','TokensController@create_client_token');
Route::post('delete-client-token','TokensController@delete_client_token');


Route::post('client-create-order','OrdersController@client_create_order');
Route::post('client-accept-order','OrdersController@client_Accept_Order');
Route::post('client-refuse-order','OrdersController@client_refuse_order');

//pervious list of clients orders
Route::post('pervious-order-list','OrdersController@pervious_order_list');
//now list of clients orders
Route::post('time-orders-list','OrdersController@time_order_list');

//////notification
Route::post('client-notification-list','NotificationsController@client_notification_list');

Route::post('client-notification','NotificationsController@client_notification');

});
});





////
	