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

Route::as('login')->get('/', function () {
    return view('welcome');
});

Route::get('docs/api/schema.yaml', function () {
    return File::get(public_path('openapi.yaml'));
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
