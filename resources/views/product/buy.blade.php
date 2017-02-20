@extends('master')

@section('styles')
	<style type="text/css">
	</style>
@stop

@section('content')

<section class="page-title container">
    <h1>{{ $product['name'] }}</h1>
    <hr>
</section><!--/page-title -->

<section class="product-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="gallery">
                    <img id="gallery_main_img" src="http://placehold.it/480x400" alt="Foto del producto"/>
                </div>
                <input type="checkbox" style="display: none;" checked class="form-control input-price" id="product" data-id="{{ $product['id'] }}" data-price="{{ $product['price'] }}">
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="brief-description">
                    <p>{{ $product['description'] }}</p>
                    <div class="info-cart">
                        <p class="precio">${{ $product['price'] }}</p>
                        <a class="text-hide pull-right" href="shopping-cart.html">Add to cart</a>
						<h3>Adicionales</h3>
						<?php $tempKey = 0; ?>
						@foreach($accompaniments as $key => $accompaniment)
							@if($key == 0 || ($key % 5 == 0))
				            	<div class="col-lg-6">
				            	<?php $tempKey = $key; ?>
			        		@endif
								<div class="checkbox checkbox-warning">
			                        <input id="{{ $accompaniment['id'] }}" data-name="{{ $accompaniment['name'] }}" data-id="{{ $accompaniment['id'] }}" data-price="{{ $accompaniment['price'] }}" type="checkbox" class="styled input-price"><label for="{{ $accompaniment['id'] }}">{{ $accompaniment['name'] }} ${{ $accompaniment['price'] }}</label>
			                    </div>
			                @if(($tempKey + 4) == $key || count($accompaniments) == ($key + 1))
				            	</div>
			            	@endif
						@endforeach
                    </div>
                    <div class="accion">
                        <hr>
                        <div class="regresar"><a href="{{ URL::previous() }}">Regresar</a></div>
                        <div class="agregar"><a href="{{ url('pay') }}" id="addProduct">Agregar <span id="totalPrice">${{ $product['price'] }}</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/container-->
</section><!--/product-page-->

@stop

@section('scripts')
	<script type="text/javascript">
		
		$( function() {

			var variablesBuy = {
				productId: "{{ $product['id'] }}",
				totalPrice: parseInt("{{ $product['price'] }}"),
				localStorageProduct: {
					cant: 1,
					name: "{{ $product['name'] }}",
					accompaniments: {},
					priceUnitary: parseInt("{{ $product['price'] }}"),
				}
			}

			var functionsBuy = {
				eachInputPrice: function(){

					var cant = $(this).is(":checked") ? 1 : 0;
					var priceUnitary = parseInt($(this).attr('data-price'));
					var name = $(this).attr('data-name');
					var price = cant * priceUnitary;

					variablesBuy.totalPrice = variablesBuy.totalPrice + price;

					if($(this).attr("id") == "product"){

						variablesBuy.localStorageProduct.cant = cant;

					}else{

						variablesBuy.localStorageProduct.accompaniments[$(this).attr("data-id")] = {
							cant: cant,
							priceUnitary: priceUnitary,
							name: name,
						}

						if(cant == 0){
							delete variablesBuy.localStorageProduct.accompaniments[$(this).attr("data-id")];
						}
					}

					$('#totalPrice').text("$"+ variablesBuy.totalPrice);

				},
				makeId: function(){

				    var text = "";
				    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

				    for( var i=0; i < 8; i++ )
				        text += possible.charAt(Math.floor(Math.random() * possible.length));

				    return text;
				},
			}

			$(".input-price").change(function(){

				variablesBuy.totalPrice = 0;

				$(".input-price").each(functionsBuy.eachInputPrice);
			});
	
			$("#addProduct").click(function(){
				localStorage.setItem(functionsBuy.makeId(), JSON.stringify(variablesBuy.localStorageProduct));
			});
		} )

	</script>
@stop
