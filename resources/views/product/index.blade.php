@extends('master')

@section('content')
	<div class="starter-template">
		<div class="row">
			@foreach($products as $product)
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="{{ url($product['image']) }}" alt="...">
						<div class="caption">
							<h3>{{ $product['name'] }}</h3>
							<p>...</p>
							<p>
								<a href="{{ route('product.buy', $product['id']) }}" class="btn btn-default" role="button">Comprar</a>
							</p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@stop
