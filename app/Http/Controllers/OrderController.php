<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
	public static function index()
	{
		$orders = DB::table('order_pay')->get();
		$idLast = $orders->count() == 0 ? '1' : $orders->last()->id;

		return view('order.list', compact('orders', 'idLast'));
	}

	public static function confirm(Request $request)
	{

		$order = DB::table('order_pay')->where('id', $request->input('id'))->get()->first();

		DB::table('order_pay')->where('id', $request->input('id'))->delete();

		return 1;

		$client = new \GuzzleHttp\Client();

		$res = $client->request('GET', 'http://www.textoatodos.com/sistema/wss/smsapi16.php', [
			'usuario' => "creamosheiner", 
			'password' => "8efaa3",
			'celular' => $order->mobile,
			'mensaje' => "Puedes recojer tu pedido, codigo: 123456",
			'lada' => "3",
		]);

		DB::table('order_pay')->where('id', $request->input('id'))->delete();

		// echo $res->getStatusCode();
		// "200"
		// echo $res->getHeader('content-type');
		// 'application/json; charset=utf8'
		return $res->getBody();
		// {"type":"User"...'
	}

	public static function load(Request $request)
	{

		$orders = DB::table('order_pay')->where('id', '>', $request->input('idLast'))->get();

		if(count($orders) == 0){
			return 0;
		}

		$idLast = $orders->last()->id;

		return compact('orders', 'idLast');
	}
}
