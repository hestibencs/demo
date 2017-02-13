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