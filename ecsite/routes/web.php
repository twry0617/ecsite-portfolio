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

/*
|--------------------------------------------------------------------------
| Consumer 認証不要
|--------------------------------------------------------------------------
*/

Route::namespace('Consumer')->name('consumer.')->group(function () {
    Auth::routes();

/*
|--------------------------------------------------------------------------
| Consumer 認証済み
|--------------------------------------------------------------------------
*/

    Route::middleware('auth:consumer')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
    });

});

/*
|--------------------------------------------------------------------------
| Supplier 認証不要
|--------------------------------------------------------------------------
*/

Route::namespace('Supplier')->prefix('supplier')->name('supplier.')->group(function () {
    Auth::routes([
        'register' => false,
    ]);
    Route::get('/invitation', 'InvitationController@emailVerificationForm');
    Route::post('/invitation', 'InvitationController@emailVerification')->name('invitation');
    Route::get('/register/verify/{token}', 'InvitationController@emailVerifyComplete')->name('register.verify');
    Route::post('/verify/{token}', 'InvitationController@create')->name('register');


/*
|--------------------------------------------------------------------------
| Supplier 認証済み
|--------------------------------------------------------------------------
*/

    Route::middleware('auth:supplier')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
    });

});
/*
|--------------------------------------------------------------------------
| Manager 認証不要
|--------------------------------------------------------------------------
*/

Route::namespace('Manager')->prefix('manager')->name('manager.')->group(function () {
    Auth::routes([
        'register' => false,
    ]);

/*
|--------------------------------------------------------------------------
| Mamager 認証済み
|--------------------------------------------------------------------------
*/

    Route::middleware('auth:manager')->group(function () {
        Route::get('/', 'HomeController@index');
        Route::get('/invitation', 'InvitationController@emailVerificationForm');
        ROute::post('/invitation', 'InvitationController@emailVerification')->name('invitation');
    });

});
