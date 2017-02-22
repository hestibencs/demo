<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PayController extends Controller
{
	public static function store(Request $request)
	{

		$idOrderPay = DB::table('order_pay')->insertGetId(
		    ['mobile' => $request->input('mobile')]
		);

		foreach ($request->input('localStorage') as $keyLocalStorage => $localStorage) {

			$localStorageJson = json_decode($localStorage);

			$idProductOrder = DB::table('product_order')->insertGetId(
			    [
			    	'name' => $localStorageJson->name,
			    	'cant' => $localStorageJson->cant,
			    	'price' => $localStorageJson->priceUnitary,
			    	'order_pay_id' => $idOrderPay,
			    ]
			);
			
			foreach ($localStorageJson->accompaniments as $keyAccompaniments => $accompaniment) {

				DB::table('accompaniments')->insert([
			    	'name' => $accompaniment->name,
			    	'cant' => $accompaniment->cant,
			    	'price' => $accompaniment->priceUnitary,
			    	'product_order_id' => $idProductOrder,
				]);
			}
		}

		return 1;
	}
}
