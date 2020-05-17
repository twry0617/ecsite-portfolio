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
    return view('welcome');
});

Route::namespace('Supplier')->prefix('supplier')->name('supplier.')->group(function () {
    Auth::routes();

    Route::middleware('auth:supplier')->group(function () {
        Route::get('home', 'HomeController@index');
    });
});
