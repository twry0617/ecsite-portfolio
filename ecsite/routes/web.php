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
    Route::get('/invitation', 'InvitationController@invitationEmailForm');
    Route::post('/invitation', 'InvitationController@invitationEmail')->name('invitation');
    Route::get('/register/verify/{token}', 'InvitationController@emailVerifyComplete')->name('register.verify');
    Route::post('/register/verify/{token}', 'InvitationController@create')->name('register');


/*
|--------------------------------------------------------------------------
| Supplier 認証済み
|--------------------------------------------------------------------------
*/

    Route::middleware('auth:supplier')->group(function () {
        Route::get('/', 'ProductController@index')->name('product.list');
        Route::get('/product/add', 'ProductController@create');
        Route::post('/product/add', 'ProductController@store')->name('product.store');
        Route::get('/product/{product}','ProductController@show');
        Route::get('/product/{product}/edit', 'ProductController@edit')->name('product.edit');
        Route::post('/product/{product}/edit', 'ProductController@update');
        Route::post('/product/{product}/', 'ProductController@destroy')->name('product.delete');
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
        Route::get('/register/verify/{token}', 'InvitationController@emailVerifyComplete')->name('register.verify');
        Route::get('/', 'HomeController@index');
        Route::get('/permission/{token}', 'InvitationController@permissionForm');
        Route::post('/invitation', 'InvitationController@permissionInvitation')->name('invitation');
        Route::resource('categories', 'ProductCategoryController');
        Route::resource('delivery_companies', 'DeliveryCompaniesController');
        Route::get('manager/categories/{category}','ProductCategoryController@show');
        Route::get('manager/categories/{category}','ProductCategoryController@edit');
        Route::get('manager/categories/{category}','ProductCategoryController@update');
        Route::get('manager/delivery_companies/{delivery_company}','DeliveryCompaniesController@show');
        Route::get('manager/delivery_companies/{delivery_company}','DeliveryCompaniesController@edit');
        Route::get('manager/delivery_companies/{delivery_company}','DeliveryCompaniesController@update');
    });

    

});


