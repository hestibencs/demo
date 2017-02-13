<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	public static function index()
	{
		$typeProducts = array(
			array(
				'name' => 'Hamburguesas',
				'image' => 'multimedia/images/type-product/HVfkP6Kk6b3rpXK35w3f13U5VBs4gy3j.jpg',
				'id' => 'HVfkP6Kk6b3rpXK35w3f13U5VBs4gy3j'
			),
			array(
				'name' => 'Pollo',
				'image' => 'multimedia/images/type-product/3lL4M0jpvGJWY4z1xTDvV9cJ2LHebMeG.jpg',
				'id' => '3lL4M0jpvGJWY4z1xTDvV9cJ2LHebMeG'
			),
			array(
				'name' => 'Ensaladas',
				'image' => 'multimedia/images/type-product/z5dt1DdZeVS85tSs1vkCFnuP0LKj4mdu.jpg',
				'id' => 'z5dt1DdZeVS85tSs1vkCFnuP0LKj4mdu'
			),
			array(
				'name' => 'Papas y Acompañamientos',
				'image' => 'multimedia/images/type-product/bXivH8P9ZMHdO352DoDDE164H0Db1qA0.jpg',
				'id' => 'bXivH8P9ZMHdO352DoDDE164H0Db1qA0'
			),
			array(
				'name' => 'Bebidas',
				'image' => 'multimedia/images/type-product/wQw5qVitA3vv6IGusEEQ2ZR25vpDcTSN.jpg',
				'id' => 'wQw5qVitA3vv6IGusEEQ2ZR25vpDcTSN'
			),
		);

		return view('home', compact('typeProducts'));
	}

}
