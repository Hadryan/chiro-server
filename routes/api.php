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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('\App\Http\Controllers\Api\V1')->group(function () {

    Route::get('index', 'IndexController@index');

    Route::post('auth/request', 'AuthController@request');
    Route::post('auth/verify', 'AuthController@verify');

    Route::get('products/search', 'ProductController@search');
    Route::get('products', 'ProductController@index');
    Route::middleware(['auth.jwt'])->get('products/{id}', 'ProductController@single')->where('id', '[0-9]+');
    Route::post('products', 'ProductController@store');
    Route::get('categories/{categoryId}/products', 'ProductController@productsByCategory')->where(['categoryId' => '[0-9]+']);;

    Route::get('categories', 'CategoryController@index');

    Route::get('slides', 'SlideController@index');

    Route::middleware(['auth.jwt:force'])->group(function () {
        Route::get('addresses', 'ShippingAddressController@index');
        Route::post('addresses', 'ShippingAddressController@store');
        Route::delete('addresses/{id}', 'ShippingAddressController@destroy')->where(['productId' => '[0-9]+']);

        Route::get('customers', 'CustomerController@index');
        Route::patch('customers', 'CustomerController@update');

        Route::get('favorites', 'FavoritesController@index');
        Route::post('favorites', 'FavoritesController@add');
        Route::delete('favorites/{productId}', 'FavoritesController@remove')->where(['productId' => '[0-9]+']);

        Route::post('orders', 'OrderController@store');
    });

    Route::as('product.image')->post('products/image', 'ProductImageController@store');
    Route::delete('products/image/{id}', 'ProductImageController@destroy')->where(['productId' => '[0-9]+']);
});
