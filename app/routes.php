<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Dashboard Route
 * ---------------
 */
Route::get('/', 'ProController@index');


/**
 * Product Routes
 * --------------
 */
Route::get('product', 'ProController@index');
Route::get('product/add', 'ProController@form');
Route::post('product/add/save', 'ProController@form_save');
Route::get('product/edit/{product_id}', 'ProController@form');
Route::get('product/json', 'ProController@get_json');
Route::post('product/remove/{ids}', 'ProController@remove');
Route::get('product/find/{code}', 'ProController@findByCode');


/**
 * Purchase Routes
 * ---------------
 */
Route::get('purchase/', 'StockIoController@purchase');
Route::get('purchase/add', 'PurchaseController@form');
Route::post('purchase/add/save', 'PurchaseController@form_save');
Route::get('purchase/edit/{purchase_id}', 'PurchaseController@form');

Route::post('purchase/remove/{ids}', 'PurchaseController@remove');
Route::get('purchase/json', 'PurchaseController@get_json');

/**
 * Sale Routes
 * -----------
 */
Route::get('sale/', 'SaleController@index');
Route::get('sale/add', 'SaleController@form');
Route::post('sale/add/save', 'SaleController@form_save');
Route::get('sale/edit/{purchase_id}', 'SaleController@form');
Route::post('sale/remove/{ids}', 'SaleController@remove');
Route::get('sale/json', 'SaleController@get_json');

/**
 * Report
 * ------
 */
Route::get('report/order/cancelled', 'ReportController@order_cancelled');
Route::get('report/order/cancelled/json', 'ReportController@order_cancelled_json');