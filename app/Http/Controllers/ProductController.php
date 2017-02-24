<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeProduct;
use App\Product;

class ProductController extends Controller
{
	public static function index($id)
	{

		$typeProduct = TypeProduct::find($id);
		$products = $typeProduct->product()->get();

		return view('product.index', compact('products'));
	}

	public static function buy($id)
	{

		$product = Product::find($id);
		$accompaniments = $product->accompaniment()->get();

		return view('product.buy', compact('product', 'accompaniments'));

	}

}
