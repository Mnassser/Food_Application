<?php

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
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function()
{
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::group(['middleware'=>'auth'],function(){

Route::group(['namespace'=>'Dashboard'],function(){
	////soft deletes
Route::resource('clients','ClientsController');
Route::resource('orders','ordersController');
Route::resource('resturants','ResturantsController');
Route::resource('products','ProductsController');
Route::resource('offers','OffersController');
Route::resource('settings','SettingsController');
Route::resource('cities','CitiesController');
Route::resource('districts','DistrictsController');
Route::resource('categories','CategoiresController');

Route::resource('contacts','ContactsController');
});
Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::get('/home', 'HomeController@index')->name('home');
});
});


//Route::get('/create','RPController@create');