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

Route::get('/', function () {
    return view('welcome2');
    //echo "Welcome";
});

Route::get('/test', function () {
    //return view('welcome');
    $var = \App\Libraries\Utilities::customerBehaviour();
    dd($var);
});

//juery server-side customer data
Route::get('customers/getdata', 'CustomersController@getdata')->name('customers');
//Auth::routes();

//login
Route::post('login', 'LoginController@login');
Route::get('/home', 'HomeController@index')->name('home');

//settings
Route::group(['prefix' => 'settings'], function (){
   Route::match(['post', 'get'], 'locations', 'SettingsController@location')->name('locations');
   Route::post('/locations/update', 'SettingsController@update_location');
   Route::match(['post','get'], 'products', 'SettingsController@products')->name('products');
   Route::post('/products/update', 'SettingsController@update_product');
   Route::post('/products/update-status', 'SettingsController@update_product_status');
   Route::match(['post', 'get'],'/sms-sender-id', 'SettingsController@sms_sender_id')->name('sms_sender');
});
//Transactions route
Route::group(['prefix' => 'transactions'], function(){
   Route::match(['post','get'], '/', 'TransactionsController@index');
   Route::match(['post', 'get'], '/{phone}', 'TransactionsController@create')->name('transactions');
});

Route::group(['prefix' => 'customers'], function (){
   Route::match(['post', 'get'], '/', 'CustomersController@index');
   Route::post('/update/{phone}', 'CustomersController@update');
   Route::get('/purchases/{phone}', 'CustomersController@purchases');
});

//Reports route
Route::group(['prefix' => 'reports'], function (){
    Route::match(['post', 'get'], '/customers/most-number-purchases', 'ReportsController@most_number_purchases');
    Route::match(['post', 'get'], '/customers/most-amount-purchases', 'ReportsController@most_amount_purchases');
    Route::match(['post', 'get'], '/customers/least-number-purchases', 'ReportsController@least_number_purchases');
    Route::match(['post', 'get'], '/customers/least-amount-purchases', 'ReportsController@least_amount_purchases');
    Route::match(['post', 'get'], '/customers/by-location', 'ReportsController@customers_by_location');
});
//users management
Route::group(['prefix' => 'users'], function (){
    Route::match(['post', 'get'], '/', 'UsersController@index')->name('users');
    Route::match( ['post','get'],'/edit', 'UsersController@edit_user');
    Route::match( ['post','get'],'/add-user', 'UsersController@add_user');
    Route::match(['post','get'], 'change-password', 'UsersController@change_password');
});

//promotions
Route::group(['prefix' => 'promotions'], function (){
    Route::match(['post', 'get'], '/', 'PromotionsController@index')->name('promotions');
});
Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'UserController@confirm'
]);

Route::get('/home', 'HomeController@index')->name('home');
