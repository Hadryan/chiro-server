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
    Route::post('auth/request', 'AuthController@request');
    Route::post('auth/verify', 'AuthController@verify');

    Route::get('products/search', 'ProductController@search');
    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@single')->where('id', '[0-9]+');
    Route::post('products', 'ProductController@store');

    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}/products', 'ProductController@productsByCategory');

    Route::get('slides', 'SlidesController@index');

    Route::middleware('auth.jwt')->group(function () {
        Route::get('addresses', 'ShippingAddressController@index');
        Route::post('addresses', 'ShippingAddressController@store');
    });
});
