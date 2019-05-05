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

/**
 * Client Zone
 */
Route::group([
    'namespace' => 'Client'
], function() {
    Route::get('/', 'HomeController@index');
    Route::get('gioi-thieu', 'HomeController@about');
    Route::get('lien-he', 'HomeController@contact');

    Route::get('gio-hang', 'CartController@index');
    Route::post('gio-hang', 'CartController@store');
    Route::get('gio-hang/thanh-toan', 'CartController@checkout');
    Route::get('gio-hang/thanh-cong', 'CartController@complete');
    Route::post('/gio-hang/them', 'CartController@add');
    Route::post('/gio-hang/sua', 'CartController@update');
    Route::post('/gio-hang/xoa', 'CartController@remove');
    


    Route::get('san-pham/{product}', 'ProductController@detail');
    Route::get('san-pham', 'ProductController@shop');
        
});
 
/**
 * Admin Zone
 */
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {

    // Guest routes
    Route::group([
        'middleware' => 'guest'
    ], function() {
        Route::get('login', 'LoginController@showLoginForm');
        Route::post('login', 'LoginController@login');
    });

    // Auth routes
    Route::group([
        'middleware' => 'auth'
    ], function() {
        Route::post('logout', 'LoginController@logout');
        
        Route::get('/', 'DashboardController@index');

        // Admin Product routes
        Route::group([
            'prefix' => 'products'
        ], function() {
            Route::get('/', 'ProductController@index')->name('admin.product.index');
            Route::get('create', 'ProductController@create');
            Route::post('/', 'ProductController@store');
            Route::get('{product}/edit', 'ProductController@edit');
            Route::put('{product}', 'ProductController@update');
            Route::delete('{product}', 'ProductController@destroy');
        });

        // Admin User routes
        Route::group([
            'prefix' => 'users'
        ], function () {
            Route::get('create', 'UserController@create');
            Route::get('{user}/edit', 'UserController@edit');
            Route::get('/', 'UserController@index');
        });
        
        // Admin Category routes
        Route::group([
            'prefix' => 'categories'
        ], function () {
            Route::get('/', 'CategoryController@index');
            Route::get('create', 'CategoryController@create');
            Route::post('/', 'CategoryController@store');
            Route::get('{category}/edit', 'CategoryController@edit');
            Route::put('{category}', 'CategoryController@update');
            Route::delete('{category}', 'CategoryController@destroy');
        });

        // Admin Order routes
        Route::group([
            'prefix' => 'orders'
        ], function () {
            Route::get('{order}/edit', 'OrderController@edit');
            Route::get('/', 'OrderController@index');
            Route::get('processed', 'OrderController@processed');
        });    
    });
});