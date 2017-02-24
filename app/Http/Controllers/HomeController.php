<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeProduct;

class HomeController extends Controller
{
	
	public static function index()
	{
		$typeProducts = TypeProduct::all();

		return view('home', compact('typeProducts'));
	}
}
