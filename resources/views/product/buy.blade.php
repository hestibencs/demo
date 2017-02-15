@extends('master')

@section('styles')
	<style type="text/css">
	</style>
@stop

@section('content')
	<div class="starter-template">
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="{{ url($product['image']) }}" alt="...">
					<div class="caption">
						<h3>{{ $product['name'] }}</h3>
						<p>${{ $product['price'] }}</p>
						<p>
							<div class="form-group">
								<input type="number" class="form-control input-price" id="product" data-id="{{ $product['id'] }}" data-price="{{ $product['price'] }}" min="0" value="0" style="margin-left: 40%; width: 20%;">
							</div>
						</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				@foreach($accompaniments as $accompaniment)
					<div class="media">
						<div class="media-left">
							<img class="media-object" src="{{ url($accompaniment['image']) }}" width="64" height="64" alt="...">
						</div>
						<div class="media-body">
							<h4 class="media-heading">{{ $accompaniment['name'] }}</h4>
							${{ $accompaniment['price'] }}
						</div>
						<div class="media-right">
							<div class="form-group">
								<input type="number" class="form-control input-price" id="accompaniment" data-name="{{ $accompaniment['name'] }}" data-id="{{ $accompaniment['id'] }}" data-price="{{ $accompaniment['price'] }}" min="0" value="0" style="width: 64px;">
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<div class="caption">
						<h3>Valor</h3>
						<p><span id="totalPrice">$0</span></p>
						<p>
							<!-- <a href="{{ url('/') }}" class="btn btn-primary" role="button">Agregar Mas</a> -->
							<a href="{{ url('/') }}" class="btn btn-default" id="cancelBuy" role="button">Cancelar</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		
		$( function() {

			var variablesBuy = {
				productId: "{{ $product['id'] }}",
				totalPrice: 0,
				localStorageProduct: {
					cant: 0,
					name: "{{ $product['name'] }}",
					accompaniments: {},
					totalPrice: 0,
					priceUnitary: parseInt("{{ $product['price'] }}"),
				}
			}

			var functionsBuy = {
				eachInputPrice: function(){

					var cant = $(this).val();
					var priceUnitary = parseInt($(this).attr('data-price'));
					var name = $(this).attr('data-name');
					var price = cant * priceUnitary;

					variablesBuy.totalPrice = variablesBuy.totalPrice + price;

					if($(this).attr("id") == "product"){

						variablesBuy.localStorageProduct.cant = cant;

					}else{

						variablesBuy.localStorageProduct.accompaniments[$(this).attr("data-id")] = {
							cant: cant,
							price: price,
							priceUnitary: priceUnitary,
							name: name,
						}

						if(cant == 0){
							delete variablesBuy.localStorageProduct.accompaniments[$(this).attr("data-id")];
						}
					}

					$('#totalPrice').text("$"+ variablesBuy.totalPrice);

				},
				initialLocalStorageProduct: function(productBuy){

					$("input[data-id="+ variablesBuy.productId +"]").val(productBuy.cant);
					$('#totalPrice').text("$"+ productBuy.totalPrice);

					$.each(productBuy.accompaniments, function(i, index){
						$("input[data-id="+ i +"]").val(index.cant);
					});

					functionsBuy.calculateTotalBuy();

				},
				calculateTotalBuy: function(){

					var totalBuy = 0;

					$.each(localStorage, function(i, index){
						var productBuy = JSON.parse(index);
						totalBuy = totalBuy + productBuy.totalPrice;
					});

					$("#totalBuy").text(totalBuy);
				
				},
				cancelBuyClick: function(){

					localStorage.removeItem(variablesBuy.productId);

				}
			}

			if (localStorage[variablesBuy.productId] == undefined) {

				localStorage.setItem(variablesBuy.productId, JSON.stringify(variablesBuy.localStorageProduct));

			}else{

				var productBuy = JSON.parse(localStorage.getItem(variablesBuy.productId));
				variablesBuy.localStorageProduct = productBuy;
				functionsBuy.initialLocalStorageProduct(productBuy);
			}

			$(".input-price").change(function(){

				variablesBuy.totalPrice = 0;

				$(".input-price").each(functionsBuy.eachInputPrice);

				variablesBuy.localStorageProduct.totalPrice = variablesBuy.totalPrice;
				localStorage.setItem(variablesBuy.productId, JSON.stringify(variablesBuy.localStorageProduct));
				functionsBuy.calculateTotalBuy();
			});

			$("#cancelBuy").click(functionsBuy.cancelBuyClick);
		} )

	</script>
@stop
