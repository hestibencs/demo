<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\OrderPay;

class OrderController extends Controller
{
	public static function index()
	{
		$orders = OrderPay::where('print', 2)->with('productOrder')->get();
		$idLast = $orders->count() == 0 ? '1' : $orders->last()->id;

		return view('order.list', compact('orders', 'idLast'));
	}

	public static function confirm(Request $request)
	{

		$order = DB::table('order_pay')->where('id', $request->input('id'))->get()->first();

		// DB::table('order_pay')->where('id', $request->input('id'))->delete();

		// return 'OK: 1 mensajes enviados...';

		$client = new \GuzzleHttp\Client();

		$res = $client->request('GET', 'http://www.textoatodos.com/sistema/wss/smsapi16.php?usuario=creamosheiner&password=8efaa3&celular='. $order->mobile .'&mensaje=Puedes recojer tu pedido, codigo: 123456&lada=3', []);

		// $res = $client->request('GET', 'http://www.textoatodos.com/sistema/wss/smsapi16.php', [
		// 	'usuario' => "creamosheiner", 
		// 	'password' => "8efaa3",
		// 	'celular' => $order->mobile,
		// 	'mensaje' => "Puedes recojer tu pedido, codigo: 123456",
		// 	'lada' => "3",
		// ]);

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
		// echo dd($request->all());
		$orders = OrderPay::where('print', 2)->where('id', '>', $request->input('idLast'))->with('productOrder')->get();
		$idLast = $orders->count() == 0 ? '0' : $orders->last()->id;

		return compact('orders', 'idLast');
	}
}
