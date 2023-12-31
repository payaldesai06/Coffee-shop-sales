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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::group(['namespace' => 'Api'], function () {
  //Sale apis
  Route::prefix('sale')->group(function () {
    Route::get('/', 'SaleController@index');
    Route::post('create', 'SaleController@create');
  });
  //Shipping cost apis
  Route::prefix('shipping')->group(function () {
    Route::get('/', 'ShippingController@index');
    Route::post('create', 'ShippingController@create');
  });
});
