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










































Route::resource('products', 'ProductAPIController');



Route::resource('products', 'productAPIController');









Route::resource('infos', 'infoAPIController');

Route::resource('infos', 'infoAPIController');

Route::resource('infos', 'infoAPIController');

Route::resource('infos', 'infoAPIController');

Route::resource('infos', 'infoAPIController');

Route::resource('infos', 'infoAPIController');

Route::resource('infos', 'infoAPIController');









Route::resource('sample3s', 'Sample3APIController');