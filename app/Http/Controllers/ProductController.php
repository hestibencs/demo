<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
	public static function index($id)
	{
		$products = array(
			array(
				'name' => 'MUSHROOM DIJON',
				'image' => 'multimedia/images/products/UZFMlqUu0D4AEsLbqo7zdN9q08H0W0un.png',
				'id' => 'UZFMlqUu0D4AEsLbqo7zdN9q08H0W0un'
			),
			array(
				'name' => 'Premium Deluxe',
				'image' => 'multimedia/images/products/Ch2xvES5Pa9j8AKYPh5zoyyXN5X2EeRc.jpg',
				'id' => 'Ch2xvES5Pa9j8AKYPh5zoyyXN5X2EeRc'
			),
			array(
				'name' => 'CLUB HOUSE',
				'image' => 'multimedia/images/products/pVNPuzGwdqaTe8xHAeQ9V0a2e2f2X544.jpg',
				'id' => 'pVNPuzGwdqaTe8xHAeQ9V0a2e2f2X544'
			),
			array(
				'name' => 'BIG MAC',
				'image' => 'multimedia/images/products/WYH9r2Ru10wr2oW0527vx0H5SQOi52vz.jpg',
				'id' => 'WYH9r2Ru10wr2oW0527vx0H5SQOi52vz'
			),
			array(
				'name' => 'McNÍFICA',
				'image' => 'multimedia/images/products/yzF0t7rkMyjs21ah3pBO5wim4U8L5YPj.jpg',
				'id' => 'yzF0t7rkMyjs21ah3pBO5wim4U8L5YPj'
			),
			array(
				'name' => 'HAMBURGUESA',
				'image' => 'multimedia/images/products/Hz96Pfs4xe3PVrOV78OclgdLpS0l6hpy.jpg',
				'id' => 'Hz96Pfs4xe3PVrOV78OclgdLpS0l6hpy'
			),
		);

		return view('product.index', compact('products'));
	}

	public static function buy($id)
	{
		$product = array(
			'name' => 'MUSHROOM DIJON',
			'price' => '12000',
			'image' => 'multimedia/images/products/UZFMlqUu0D4AEsLbqo7zdN9q08H0W0un.png',
			'id' => 'UZFMlqUu0D4AEsLbqo7zdN9q08H0W0un',
		);

		$accompaniments = array(
			array(
				'name' => 'McPAPAS',
				'price' => '3000',
				'image' => 'multimedia/images/accompaniments/b6H95b6Ia4Z9BeXO6n1SM421mTCZrrTn.jpg',
				'id' => 'b6H95b6Ia4Z9BeXO6n1SM421mTCZrrTn',
			),
			array(
				'name' => 'Ensalada',
				'price' => '3500',
				'image' => 'multimedia/images/accompaniments/ibK96w09HVF60l6003Tfkzz7lRInn9w0.jpg',
				'id' => 'ibK96w09HVF60l6003Tfkzz7lRInn9w0',
			),
			array(
				'name' => 'Jugo de naranja',
				'price' => '2000',
				'image' => 'multimedia/images/accompaniments/9fIW61R8fTRtfGmyjw74oQcJvvJSH72B.jpg',
				'id' => '9fIW61R8fTRtfGmyjw74oQcJvvJSH72B',
			),
			array(
				'name' => 'Fuze Tea',
				'price' => '2500',
				'image' => 'multimedia/images/accompaniments/wcO38YXDz89O9flhjY1u73HPiEa01aFw.jpg',
				'id' => 'wcO38YXDz89O9flhjY1u73HPiEa01aFw',
			),
			array(
				'name' => 'Coca-cola zero',
				'price' => '3300',
				'image' => 'multimedia/images/accompaniments/S51o13G7F8o1Wfkrww5OI9RE326nG5Ts.jpg',
				'id' => 'S51o13G7F8o1Wfkrww5OI9RE326nG5Ts',
			),
		);

		return view('product.buy', compact('product', 'accompaniments'));

	}

}
