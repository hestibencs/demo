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
                    <img id="gallery_main_img" src="{{ url($product['image']) }}" alt="Foto del producto"/>
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
                        <div class="agregar"><button type="button" data-toggle="modal" data-target="#modalProducto" class="btn btn-success">Agregar <span id="totalPrice">${{ $product['price'] }}</span></button></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/container-->
</section><!--/product-page-->


<!-- Modal -->
<div id="modalProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar producto al carrito</h4>
      </div>
      <div class="modal-body">
        <div class="modal-product">
            <a href="product.html" class="product-image"><img src="http://placehold.it/90x81" alt="Product Image"/></a>
            <div class="product-title">
                <p class="producto">Corralísima</p>
                <p class="adiciones">Adiciones: Tocineta, queso y papas agrandadas</p>
                <p>1 <span>x $23.450</span></p>
            </div>
            <div class="right-icons pull-right" data-dismiss="modal">
                <a href="javascript:;">x</a>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-warning" href="{{ url('/') }}">Agregar y seguir comprando</a>
        <a class="btn btn-success" href="{{ url('pay') }}">Agregar y pagar</a>
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
	            addRowItemModal: function(obj, val1, val2, val3, accompaniments, i){

	                obj.append('<div class="modal-product">\
	                    <a href="product.html" class="product-image"><img src="http://placehold.it/90x81" alt="Product Image"/></a>\
	                    <div class="product-title">\
	                        <p class="producto">'+ val2 +'</p>\
	                        <p class="adiciones">Adiciones: '+ accompaniments +'</p>\
	                        <p>'+ val1 +' <span>x '+ val3 +'</span></p>\
	                    </div>\
	                    <div class="right-icons pull-right"  data-dismiss="modal">\
	                        <a href="javascript:;">x</a>\
	                    </div>\
	                </div>');
	            },
	            modalAddProductShow: function(){

	                var body = $(this).find('.modal-body');
	                var totalPayment = 0;

	                body.find(".modal-product").remove();

                    var productBuy = variablesBuy.localStorageProduct;
                    var accompaniments = "Sin adiciones";
                    var priceTotal = parseInt(productBuy.priceUnitary) * parseInt(productBuy.cant);
                    var count = 0;

                    totalPayment += priceTotal;

                    $.each(productBuy.accompaniments, function(j, accompaniment){

                        if(count == 0){
                            accompaniments = accompaniment.name;
                        }else{
                            accompaniments += ","+ accompaniment.name;
                        }

                        priceTotal += parseInt(accompaniment.priceUnitary);

                        count++;
                    });

                    functionsBuy.addRowItemModal(body, productBuy.cant, productBuy.name, '$'+ priceTotal, accompaniments);
	            },
			}

			$(".input-price").change(function(){

				variablesBuy.totalPrice = 0;

				$(".input-price").each(functionsBuy.eachInputPrice);
			});
	
			$('#modalProducto').on('show.bs.modal', functionsBuy.modalAddProductShow);

			$('#modalProducto').find(".modal-footer a").click(function(){
				localStorage.setItem(functionsBuy.makeId(), JSON.stringify(variablesBuy.localStorageProduct));
			});

		} )

	</script>
@stop
