@extends('master')

@section('content')
    <div class="row container cats">
        <div class="brands col-lg-12">
			<?php $tempKey = 0; ?>
			@foreach($typeProducts as $key => $type)
				@if($key == 0 || ($key % 4 == 0))
	            	<div class="row">
	            	<?php $tempKey = $key; ?>
        		@endif
	                <div class="brand-image col-lg-3 col-md-3 col-sm-6" data-scroll-reveal="enter top and move 10px over 1s">
	                    <a href="{{ route('product', $type['id']) }}"><img src="{{ url($type['image']) }}" alt="Brand Image"/></a>
	                </div>
                @if(($tempKey + 3) == $key || count($typeProducts) == ($key + 1))
	            	</div>
            	@endif
			@endforeach
        </div>
    </div>
@stop
