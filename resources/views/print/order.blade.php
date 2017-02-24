@extends('order.index')

@section('styles')

<style type="text/css">
	@media print
	{
		body * { visibility: hidden; }
		.invoice-print * { visibility: visible; }
		.invoice-print { position: absolute; top: 0px; }
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
	            	<div class="col-lg-12">
	            		VENDEDOR: -------------</br>
	            	</div>
	            </div>
	            <hr>
	            <div class="row">
	            	<div class="col-lg-12">
	            		FECHA SISTEMA: <span id="fecha"></span> <span id="hora"></span>
	            	</div>
	            </div>
	            <hr>
	            <div class="row">
	            	<div class="col-lg-12">
	            		DOC. EQUIVALENTE No.: T124-00015135
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
	            	<div class="col-lg-12">
	            		CODIGO: 123456
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

					$.post("{{ url('print/order') }}", {
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
								</tr>\
							');

							total += index.price * index.cant;

							$.each(index.accompaniment_pay, function(j, indexJ){

								$("#list_price tbody").append('\
									<tr>\
										<td>\
											&nbsp; &nbsp;'+ indexJ.cant +'\
										</td>\
										<td>\
											'+ indexJ.name +'\
										</td>\
									</tr>\
								');

								total += indexJ.price * indexJ.cant;
							});
						});

						var currentdate = new Date();

						$("#fecha").text(currentdate.getFullYear() +"/"+ (currentdate.getMonth()+1) +"/"+ currentdate.getDate());
						$("#hora").text(currentdate.getHours() +":"+ currentdate.getMinutes() +":"+ currentdate.getSeconds());

						$(".invoice-print").show();

				        window.print();

						$.post("{{ url('print/order/confirm') }}", {
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
