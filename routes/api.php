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

    Route::middleware('auth:api')->get('products', 'ProductController@index');
});
