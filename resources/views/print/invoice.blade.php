@extends('order.index')

@section('styles')

<style type="text/css">
@media print
{
	body * { visibility: hidden; }
	.invoice-print * { visibility: visible; }
	.invoice-print { position: absolute; top: 40px; left: 30px; }
}
</style>

@stop

@section('content')
	
<section class="page-title container">
    <h1>Imprimir</h1>
    <hr>
</section><!--/page-title -->

<section class="shopping-cart container invoice-print" style="display: none;">
    <div class="row">
        <div class="col-lg-4">
            <div class="main-board" style="background-color: white; padding: 20px;">
	            <div class="row">
	            	<div class="col-lg-12" style="text-align: center;">
	            		I.R.C.C LTDA</br>
	            		IND. DE RESTAURANTES CASUALES</br>
	            		NIT 860533413-6</br>
	            		IVA REGIMEN COMUN</br>
	            		SOMOS AGENTES RETENEDORES DE IVA</br>
	            		HAMBURGUESAS EL CORRAL</br>
	            		CENTRO INTERNACIONAL</br>
	            		KR 7 32 83
	            	</div>
	            </div>
	            </br>
	            <div class="row">
	            	<div class="col-lg-3">
	            		TPV</br>
	            		Fecha</br>
	            	</div>
	            	<div class="col-lg-9">
	            		: 000000<span id="order_id"></span></br>
	            		: <span id="fecha"></span> Hora: <span id="hora"></span></br>
	            	</div>
	            	<div class="col-lg-12">
	            		DOC. EQUIVALENTE No.: T124-00015135</br>
	            	</div>
					<div class="col-lg-3">
	            		Vendedor</br>
	            	</div>
	            	<div class="col-lg-9">
	            		: -----------</br>
	            	</div>
	            </div>
	            <hr>
	            <div class="row">
	            	<div class="col-lg-12">
	            		<table id="list_price" style="width: 100%;">
	            			<thead></thead>
	            			<tbody></tbody>
	            			<tfoot></tfoot>
	            		</table>
	            	</div>
	            </div>
	            <hr>
	            <div class="row">
	            	<div class="col-lg-7">
	            		Vta Gravada (*) ...........
	            	</div>
	            	<div class="col-lg-5" style="text-align: right;">
	            		<span id="vtaGravada"></span> +
	            	</div>
	            	<div class="col-lg-7">
	            		IMP AL CONSUMO... 8%
	            	</div>
	            	<div class="col-lg-5" style="text-align: right;">
	            		
	            	</div>
	            	<div class="col-lg-7">
	            		IV
	            	</div>
	            	<div class="col-lg-5">
	            		<span id="iva"></span> +
	            	</div>
	            	<div class="col-lg-7">
	            	</div>
	            	<div class="col-lg-5" style="text-align: right;">
	            		--------------------------
	            	</div>
	            	<div class="col-lg-7">
	            	</div>
	            	<div class="col-lg-5" style="text-align: right;">
	            		$ <span id="total"></span>
	            	</div>
	            	<div class="col-lg-7">
	            		EFECTIVO
	            	</div>
	            	<div class="col-lg-5" style="text-align: right;">
	            		$0
	            	</div>
	            	<div class="col-lg-7">
	            		CAMBIO
	            	</div>
	            	<div class="col-lg-5" style="text-align: right;">
	            		$0
	            	</div>
	            </div>
	            </br>
	            <div class="row">
	            	<div class="col-lg-12"  style="text-align: center;">
            			Resolucion DIAN. 310000093645 2016/05/31</br>
            			PREFIJO. T124 DEL No. 1 AL 500000</br></br>
            			GRAN CONTRIBUYENTE</br>
            			RESOLUCION 000076 de DIC/01/2016</br>
            			GRACIAS POR SU VISITA</br>
            			****CUENTA CERRADA****</br>
	            	</div>
	            </div>
	            </br>
	            <div class="row">
	            	<div class="col-lg-12">
	            		Nombre:</br>
	            		NIT/CC:</br>
	            		Telefono:</br>
	            	</div>
            	</div>
            	</br>
            	<div class="row">
	            	<div class="col-lg-12" style="text-align: center;">
	            		Elaborado. -----------------
	            	</div>
	            </div>
            </div><!--/main-board -->
        </div>
    </div><!--/row -->
</section><!--/shopping-cart-->

@stop

@section('scripts')
	<script type="text/javascript">

		$( function() {

			var functionsPrintInvoice = {
				ajaxLoadInvoicePrint: function(){

					$.post("{{ url('print/invoice') }}", {
						_token: "{{ csrf_token() }}",
					}).done(function( data ){

						if(data == 0){
							return false;
						}

						var total = 0;

						$("#list_price tbody").html(" ");
						$("#order_id").text(data.order.id);

						$.each(data.order.product_order, function(i, index){

							$("#list_price tbody").append('\
								<tr>\
									<td>\
										'+ index.cant +'\
									</td>\
									<td>\
										'+ index.name +'\
									</td>\
									<td>\
										$'+ (index.price * index.cant) +'\
									</td>\
								</tr>\
							');

							total += index.price * index.cant;

							$.each(index.accompaniment, function(j, indexJ){

								$("#list_price tbody").append('\
									<tr>\
										<td>\
											&nbsp; &nbsp;'+ indexJ.cant +'\
										</td>\
										<td>\
											'+ indexJ.name +'\
										</td>\
										<td>\
											&nbsp; &nbsp; $'+ (indexJ.price * indexJ.cant) +'\
										</td>\
									</tr>\
								');

								total += indexJ.price * indexJ.cant;
							});
						});

						var currentdate = new Date();
						var vtaGravada = total * 0.81;
						var iva = total * 0.19;

						$("#vtaGravada").text(vtaGravada);
						$("#iva").text(iva);
						$("#total").text(total);
						$("#fecha").text(currentdate.getFullYear() +"/"+ (currentdate.getMonth()+1) +"/"+ currentdate.getDate());
						$("#hora").text(currentdate.getHours() +":"+ currentdate.getMinutes() +":"+ currentdate.getSeconds());

						$(".invoice-print").show();

				        window.print();

						$.post("{{ url('print/invoice/confirm') }}", {
							_token: "{{ csrf_token() }}",
							id: data.order.id
						});

				        $(".invoice-print").hide();
					});
				}
			}

			// functionsPrintInvoice.ajaxLoadInvoicePrint();
			setInterval(functionsPrintInvoice.ajaxLoadInvoicePrint, 3000);
		} );
		
	</script>
@stop
