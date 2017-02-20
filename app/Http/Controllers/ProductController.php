<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
	public static function index($id)
	{
		$products = array(
			array(
				'name' => 'Corralísima 1/2 libra',
				'image' => '',
				'description' => 'Media libra de carne de res asada a la parrilla, con salsa BBQ.',
				'price' => 16500,
				'id' => 'UZFMlqUu0D4AEsLbqo7zdN9q08H0W0un'
			),
			array(
				'name' => 'Corralísima 3/4 de libra',
				'image' => '',
				'description' => 'Tres cuartos de libra de carne de res asada a la parrilla, con salsa BBQ.',
				'price' => 18500,
				'id' => 'Ch2xvES5Pa9j8AKYPh5zoyyXN5X2EeRc'
			),
			array(
				'name' => 'Corral casera',
				'image' => '',
				'description' => '1/3 Lb. De carne de res, con queso americano, cebolla roja recién cortada, tomate y lechuga fresca.',
				'price' => 14000,
				'id' => 'pVNPuzGwdqaTe8xHAeQ9V0a2e2f2X544'
			),
			array(
				'name' => 'Corralísima Todoterreno',
				'image' => '',
				'description' => 'Dos porciones de ¼ de lb. De carne de res asada a la parrilla, con tocineta, queso mozzarela, vegetales, pepinillos y salsa BBQ.',
				'price' => 23000,
				'id' => 'WYH9r2Ru10wr2oW0527vx0H5SQOi52vz'
			),
		);

		return view('product.index', compact('products'));
	}

	public static function buy($id)
	{
		$product = array(
			'name' => 'Corralísima 1/2 libra',
			'price' => 16500,
			'image' => '',
			'description' => 'Media libra de carne de res asada a la parrilla, con salsa BBQ.',
			'id' => 'UZFMlqUu0D4AEsLbqo7zdN9q08H0W0un',
		);

		$accompaniments = array(
			array(
				'name' => 'Tocineta',
				'price' => 3500,
				'image' => '',
				'id' => 'b6H95b6Ia4Z9BeXO6n1SM421mTCZrrTn',
			),
			array(
				'name' => 'Jamón',
				'price' => 1500,
				'image' => '',
				'id' => 'ibK96w09HVF60l6003Tfkzz7lRInn9w0',
			),
			array(
				'name' => 'Queso',
				'price' => 2800,
				'image' => '',
				'id' => '9fIW61R8fTRtfGmyjw74oQcJvvJSH72B',
			),
			array(
				'name' => 'Pepinillos',
				'price' => 1800,
				'image' => '',
				'id' => 'wcO38YXDz89O9flhjY1u73HPiEa01aFw',
			),
			array(
				'name' => 'Lechuga',
				'price' => 1900,
				'image' => '',
				'id' => 'S51o13G7F8o1Wfkrww5OI9RE326nG5Ts',
			),
			array(
				'name' => 'Doble carne',
				'price' => 6500,
				'image' => '',
				'id' => '',
			),
			array(
				'name' => 'Champiñon',
				'price' => 3200,
				'image' => '',
				'id' => '',
			),
			array(
				'name' => 'Tomates',
				'price' => 3500,
				'image' => '',
				'id' => '',
			),
			array(
				'name' => 'En combo',
				'price' => 6000,
				'image' => '',
				'id' => '',
			),
			array(
				'name' => 'Agrandar papas y bebida',
				'price' => 4800,
				'image' => '',
				'id' => '',
			),
		);

		return view('product.buy', compact('product', 'accompaniments'));

	}

}
