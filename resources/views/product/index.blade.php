@extends('master')

@section('content')
    <!-- Owl carousel -->
    <div class="myowl">
        <div class="carousel-block unshow">
            &nbsp;
        </div>

        @foreach($products as $product)
	        <div class="carousel-block">
	            <a href="{{ route('product.buy', $product['id']) }}"><img src="http://placehold.it/570x330" alt="Product Image"/></a>
	            <div class="carousel-content">
	                <h3><a href="{{ route('product.buy', $product['id']) }}">{{ $product['name'] }}</a></h3>
	                <hr>
	                <p class="description">{{ $product['description'] }}</p>
	                <div class="right-block">
	                    <p>${{ $product['price'] }}</p>
	                    <a class="text-hide" href="shopping-cart.html">Agregar</a>
	                </div>
	            </div>
	        </div>
        @endforeach

        <div class="carousel-block unshow">
            &nbsp;
        </div>
    </div><!-- /myowl -->
@stop
