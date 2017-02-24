<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\OrderPay;

class PrintController extends Controller
{
	public static function invoice()
	{

		$order = OrderPay::where('print', 0)->with('productOrder')->first();

		if(count($order) == 0){
			return 0;	
		}

		return compact('order');
	}

	public static function order()
	{

		$order = OrderPay::where('print', 1)->with('productOrder')->first();

		if(count($order) == 0){
			return 0;	
		}

		return compact('order');
	}

	public static function invoiceConfirm(Request $request)
	{

		$order = OrderPay::find($request->input('id'));
		$order->print = 1;
		$order->save();

		return 1;
	}

	public static function orderConfirm(Request $request)
	{

		$order = OrderPay::find($request->input('id'));
		$order->print = 2;
		$order->save();

		return 1;
	}
}
