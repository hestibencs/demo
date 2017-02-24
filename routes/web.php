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

Route::get('/', 'HomeController@index');

Route::group(array('prefix' => 'pay'), function () {

    Route::get('/', function(){
		return view('pay');
    });

    Route::post('/store', 'PayController@store');

});

Route::group(array('prefix' => 'product'), function () {

    Route::get('/{id}', [
        'as' => 'product', 
        'uses' => 'ProductController@index'
    ]);

    Route::get('/{id}/buy', [
        'as' => 'product.buy', 
        'uses' => 'ProductController@buy'
    ]);
});

Route::group(array('prefix' => 'order'), function () {

    Route::get('/', 'OrderController@index');
    
    Route::post('/confirm', 'OrderController@confirm');

    Route::post('/load', 'OrderController@load');
});

Route::post('sms/send/code', 'SmsController@send');

Route::group(array('prefix' => 'print'), function () {

    Route::get('invoice', function(){
        return view('print.invoice');
    });

    Route::get('order', function(){
        return view('print.order');
    });

    Route::post('invoice', 'PrintController@invoice');
    Route::post('order', 'PrintController@order');

    Route::post('invoice/confirm', 'PrintController@invoiceConfirm');
    Route::post('order/confirm', 'PrintController@orderConfirm');

});