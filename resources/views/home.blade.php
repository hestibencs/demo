@extends('master')

@section('content')
	<div class="starter-template">
		<div class="row">
			@foreach($typeProducts as $type)
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="{{ url($type['image']) }}" alt="...">
						<div class="caption">
							<h3>{{ $type['name'] }}</h3>
							<p>...</p>
							<p>
								<a href="{{ route('product', $type['id']) }}" class="btn btn-default" role="button">Ver Mas</a>
							</p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@stop
