<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([], function () {
    Route::post('register','AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout')->middleware('auth:api');


    Route::get('good', 'GoodsController@getGood');
    Route::get('goods', 'GoodsController@getAllGoods');
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('price_list', 'PriceListsController@getPriceList');
    Route::post('price_list', 'PriceListsController@addPriceList');
    Route::patch('price_list', 'PriceListsController@updatePriceList');
    Route::delete('price_list', 'PriceListsController@deletePriceList');
    Route::get('price_lists', 'PriceListsController@getUserPriceLists');

    Route::post('good', 'GoodsController@addGood');
    Route::patch('good', 'GoodsController@updateGood');
    Route::delete('good', 'GoodsController@deleteGood');
});
