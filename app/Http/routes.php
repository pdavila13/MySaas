<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::resource('users','UsersController');
    
    Event::listen('user.change',function() {
       Cache::forget('query.users');
    });

//    Route::get('users','UsersController@index');
//    Route::post('users','UsersController@store');
//    Route::put('users','UsersController@update');
//    Route::delete('users','UsersController@destroy');

    //Socials Login
    Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToAuthenticationServiceProvider');
    Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleAuthenticationServiceProviderCallback');

    Route::get('plans', 'PlansController@index');
    Route::get('register_subscription', function() {
        return view('auth.register_subscription');
    });
    Route::post('registerAndSubscribeToStripe', 'Auth\AuthController@registerAndSubscribeToStripe');

    Route::get('downloadInvoice', 'PDFController@downloadInvoice');
    Route::get('invoiceHtml', 'PDFController@invoiceHtml');
});
