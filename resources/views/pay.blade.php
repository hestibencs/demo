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
        <div class="col-lg-6">
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
                        <!-- <tr>
                            <td><img class="pull-left" src="http://placehold.it/70x70" alt="Saria Shopping Cart"/></td>
                            <td class="text-center">Corralísima 3/4 libra</td>
                            <td class="text-center">Tocineta, champiñón, pepinillos, combo agrandado</td>
                            <td class="text-center"><span>$23.500</span></td>
                            <td class="text-center"><a href="#">x</a></td>
                        </tr>
                        <tr>
                            <td><img class="pull-left" src="http://placehold.it/70x70" alt="Saria Shopping Cart"/></td>
                            <td class="text-center">Todoterreno</td>
                            <td class="text-center">Combo agrandado</td>
                            <td class="text-center"><span>$27.500</span></td>
                            <td class="text-center"><a href="#">x</a></td>
                        </tr> -->
                    </tbody>
                </table><!--/table hidden xs -->
            </div><!--/main-board -->
        </div>
    </div><!--/row -->
</section><!--/shopping-cart-->

	<!-- <div class="starter-template">

		<div class="alert alert-success" style="display: none;">
		  <strong>Exito!</strong> <span></span>
		</div>

		<div class="alert alert-danger" style="display: none;">
		  <strong>Alerta!</strong> <span></span>
		</div>

		<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<div class="caption">
			            <div class="row">
			              <div class="col-md-12">
			                <h4 class="text-center">Hamburguesas Colombia</h4>
			              </div>
			            </div>
			            <div class="row">
			              <div class="col-md-2"><strong>Cant.</strong></div>
			              <div class="col-md-7"><strong>Nombre</strong></div>
			              <div class="col-md-3"><strong>Valor</strong></div>
			            </div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<div class="caption">
						<h3>Enviar Confirmacion</h3>
						<p>Ingrese su numero de celular.</p>
						<p>
							<input type="number" name="mobile" class="form-control">
						</p>
						<p>
							<a href="javascript:;" class="btn btn-primary" id="send_number" role="button">Enviar</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<div class="caption">
						<h3>Confirmar</h3>
						<p>Ingrese el codigo.</p>
						<p>
							<input type="number" name="code_mobile" class="form-control" readonly>
						</p>
						<p>
							<a href="javascript:;" class="btn btn-primary" id="confirm_code" role="button">Aceptar</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div> -->
@stop

@section('scripts')
	<script type="text/javascript">

		$( function() {
		
			var functionsPay = {
				// payVoucher: function(){

				// 	var body = $(".starter-template").find(".col-sm-6:first").find('.caption');
				// 	body.find(".price-content").remove();

				// 	$.each(localStorage, function(i, product){

				// 	  var productBuy = JSON.parse(product);

				// 	  functionsPay.addRowItemVoucher(body, productBuy.cant, productBuy.name, '$'+ (parseInt(productBuy.cant) * parseInt(productBuy.priceUnitary)));

				// 	  $.each(productBuy.accompaniments, function(j, accompaniment){
				// 	    functionsPay.addRowItemVoucher(body, accompaniment.cant, accompaniment.name, '$'+ (parseInt(accompaniment.cant) * parseInt(accompaniment.priceUnitary)));
				// 	  });

				// 	});

				// 	functionsPay.addRowItemVoucher(body, '', '<p class="text-right"><strong>Neto</strong></p>', '$'+ parseInt(parseInt($("#totalBuy").text()) * 0.81));
				// 	functionsPay.addRowItemVoucher(body, '', '<p class="text-right"><strong>IVA</strong></p>', '$'+ parseInt(parseInt($("#totalBuy").text()) * 0.19));
				// 	functionsPay.addRowItemVoucher(body, '', '<p class="text-right"><strong>Total</strong></p>', '$'+ $("#totalBuy").text());
				// },
				// addRowItemVoucher: function(obj, val1, val2, val3){

				// 	obj.append('<div class="row price-content">\
				// 	  <div class="col-md-2">'+ val1 +'</div>\
				// 	  <div class="col-md-7">'+ val2 +'</div>\
				// 	  <div class="col-md-3">'+ val3 +'</div>\
				// 	</div>');
				// }
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

	                // body.find("p.total span").html(totalPayment);
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
				}
			}

			functionsPay.tableLoadTbody();

			// functionsPay.payVoucher();

			// $("input[name=mobile]").focus();

			// $("#send_number").click(function(){

			// 	if($("input[name=mobile]").val() == ""){

			// 		$(".alert-danger").find("span").text("Numero invalido");
			// 		$(".alert-danger").fadeIn().delay(1500).fadeOut('slow');

			// 	}else{

			// 		$(".alert-success").find("span").text("Se ha enviado un codigo a su celular, porfavor ingreselo.");
			// 		$(".alert-success").fadeIn().delay(2000).fadeOut('slow');

			// 		$("input[name=code_mobile]").attr("readonly", false).focus();
			// 		$("input[name=mobile]").attr("readonly", "");
			// 	}
			// });

			// $("#confirm_code").click(function(){

			// 	if($("input[name=code_mobile]").val() == "123"){
					
			// 		$(".alert-success").find("span").text("Codigo Valido, Se enviara confirmacion cuando este su pedido");
			// 		$(".alert-success").fadeIn();

			// 		setTimeout(function(){

			// 			$.each(localStorage, function(i, product){
			// 				localStorage.removeItem(i);
			// 			});

			// 			window.location.href = 'http://127.0.0.1:8000/';
			// 		}, 3500);

			// 	}else{

			// 		$(".alert-danger").find("span").text("Codigo Invalido");
			// 		$(".alert-danger").fadeIn().delay(1500).fadeOut('slow');
			// 	}
			// });
		});

	</script>
@stop
