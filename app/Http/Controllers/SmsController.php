<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
	public static function send(Request $request)
	{
		// return 'OK: 1 mensajes enviados...';

		$client = new \GuzzleHttp\Client();

		$res = $client->request('GET', 'http://www.textoatodos.com/sistema/wss/smsapi16.php?usuario=creamosheiner&password=8efaa3&celular='. $request->input('mobile') .'&mensaje=Tu codigo de verificacion el corral es: 1234&lada=3', []);

		// echo dd($res);

		// echo $res->getStatusCode();
		// // "200"
		// echo $res->getHeader('content-type');
		// 'application/json; charset=utf8'
		return $res->getBody();
		// {"type":"User"...'
	}
}
