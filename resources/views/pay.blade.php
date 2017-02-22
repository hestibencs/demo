@extends('master')

@section('styles')
	<style type="text/css">
	</style>
@stop

@section('content')
<section class="page-title container">
    <h1>Mis productos</h1>
    <hr>
</section><!--/page-title -->

<section class="shopping-cart container">
    <div class="row">
        <div class="col-lg-8">
            <div class="main-board">
                <table class="table" id="products">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center nombre">Nombre</th>
                            <th class="text-center">Adiciones</th>
                            <th class="text-center valor">Valor</th>
                            <th class="text-center">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>&nbsp;</th>
                            <th class="text-center">Total:</th>
                            <th class="text-center valor-total">$0</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table><!--/table hidden xs -->
            </div><!--/main-board -->
        </div>
        <div class="col-lg-4">
            <div class="btn-pagar">
                <button class="btn-pago btn btn-success" data-toggle="modal" data-target="#modalTelefono">Realizar </br> pedido</button>
            </div>
        </div>
    </div><!--/row -->
</section><!--/shopping-cart-->

<!-- Modal Telefono -->
<div id="modalTelefono" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ingresar número de celular</h4>
      </div>
      <div class="modal-body">
        <div class="modal-product">
            <div class="product-title">
                <p class="sms">Para agilizar el pedido enviaremos un mensaje de texto a tu celular, por favor ingrésalo.</p>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar número celular">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success"><i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>  Confirmar celular</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal Telefono 2 -->
<div id="modalTelefono2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirmar celular</h4>
      </div>
      <div class="modal-body">
        <div class="modal-product">
            <div class="product-title">
                <p class="sms">Ingresa el código de verificación que hemos enviado a tu celular.</p>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar código de verificación">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modalPago">Confirmar código</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal Pago -->
<div id="modalPago" class="modal fade" role="dialog">
  	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Insertar tarjeta</h4>
	      </div>
	      <div class="modal-body">
	        <div class="modal-product">
	            <div class="product-title">
	                <p class="sms">Ingrese su tarjeta en el Datafono, digite su clave y espere su recibo impreso.</p>
	                <p class="sms procesar" style="text-align: center;">Procesando, pronto enviaremos un SMS a su celular para entregar su pedido.</p>
	            </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="location.href='{{ url('/') }}'">Finalizar</button>
	      </div>
	    </div>

  	</div>
</div>

@stop

@section('scripts')
	<script type="text/javascript">

		$( function() {

			var variablesPay = {
				mobileUser : ''
			}
		
			var functionsPay = {
				tableLoadTbody: function(){

	                var body = $("#products").find('tbody');
	                var totalPayment = 0;
	                body.find("tr").remove();

	                $.each(localStorage, function(i, product){

	                    var productBuy = JSON.parse(product);
	                    var accompaniments = "Sin adiciones";
	                    var priceTotal = parseInt(productBuy.priceUnitary) * parseInt(productBuy.cant);
	                    var count = 0;

	                    $.each(productBuy.accompaniments, function(j, accompaniment){

	                        if(count == 0){
	                            accompaniments = accompaniment.name;
	                        }else{
	                            accompaniments += ","+ accompaniment.name;
	                        }

	                        priceTotal += parseInt(accompaniment.priceUnitary);

	                        count++;
	                    });

	                    totalPayment += priceTotal;

	                    functionsPay.addTrTableProducts(body, productBuy.cant, productBuy.name, '$'+ priceTotal, accompaniments, i);

	                });

	                $("#products").find('tfoot .valor-total').html("$"+ totalPayment);
				},
				addTrTableProducts: function(obj, val1, val2, val3, accompaniments, i){

	                obj.append('<tr>\
                            <td><img class="pull-left" src="http://placehold.it/70x70" alt="Saria Shopping Cart"/></td>\
                            <td class="text-center">'+ val2 +'</td>\
                            <td class="text-center">'+ accompaniments +'</td>\
                            <td class="text-center"><span>'+ val3 +'</span></td>\
                            <td class="text-center"><a href="javascript:;" data-position="'+ i +'">x</a></td>\
                        </tr>');

	                obj.find("tr:last").find("a:last").click(functionsPay.clickDeleteProduct);
				},
				clickDeleteProduct: function(){

					localStorage.removeItem($(this).attr("data-position"));
					$(this).closest("tr").remove();
					functionsPay.tableLoadTbody();
				},
				clickSendCode: function(){

					var input = $("#modalTelefono").find("input[type=number]");

					if(input.val() == ""){

						alert("Ingrese Numero");
						return false;

					}else if(input.val().length < 8){

						alert("Numero Invalido");
						return false;
					}

					var loading = $(this).find("i");
					loading.show();

					$.post( "{{ url('sms/send/code') }}", { 
						_token: "{{ csrf_token() }}",
						mobile: input.val(),
					} ).done(function( data ) {

						// if(data == 1){

							variablesPay.mobileUser = input.val();
							loading.hide();

							$("#modalTelefono").modal("toggle");
							$("#modalTelefono2").modal("toggle");
						// }
					});

				},
				clickVerifyCode: function(){

					var input = $("#modalTelefono2").find("input[type=number]");

					if(input.val() != "1234"){

						alert("Codigo Invalido");
						return false;
					}
				},
				clickFinishPay: function(){

					$.post( "{{ url('pay/store') }}", { 
						_token: "{{ csrf_token() }}",
						mobile: variablesPay.mobileUser,
						localStorage: localStorage
					} ).done(function( data ) {

						if(data == 1){
							alert("aca imprime factura!")
						}

						// return false;

			            $.each(localStorage, function(i, index){
			                localStorage.removeItem(i);
			            });

						// if(data == 1){
							// loading.hide();
							// $("#modalTelefono").modal("toggle");
							// $("#modalTelefono2").modal("toggle");
						// }
					});

					// return false;


				}
			}

			functionsPay.tableLoadTbody();

			$("#modalTelefono").find(".modal-footer button").click(functionsPay.clickSendCode);
			$("#modalTelefono2").find(".modal-footer button").click(functionsPay.clickVerifyCode);
			$("#modalPago").find(".modal-footer button").click(functionsPay.clickFinishPay);

			$(".btn-pago").click(function(){

				if(localStorage.length == 0){
					alert("Carrito de compra vacio!");
					return false;
				}

			});
		});

	</script>
@stop
