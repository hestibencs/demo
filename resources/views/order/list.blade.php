@extends('order.index')

@section('styles')

@stop

@section('content')
	
<section class="page-title container">
    <h1>Mis productos</h1>
    <hr>
</section><!--/page-title -->

<section class="shopping-cart container">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-board">
                <table class="table" id="orders">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Codigo</th>
                            <th class="text-center valor">Valor</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($orders as $order)
	                        <tr>
	                            <td class="text-center">{{ $order->id }}</td>
	                            <td class="text-center">123456</td>
	                            <td class="text-center"><span>$0</span></td>
	                            <td class="text-center"><a class="borrar confirm-order" href="javascript:;">&nbsp; Confirmar &nbsp;</a></td>
	                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table><!--/table hidden xs -->
            </div><!--/main-board -->
        </div>
    </div><!--/row -->
</section><!--/shopping-cart-->

@stop

@section('scripts')
	<script type="text/javascript">

		$( function() {

			// var variablesListOrder = {
			// 	idLast: "{{ $idLast }}",
			// }

			var functionsListOrder = {
				clickConfirmOrder: function(){

					var tr = $(this).closest('tr');
					var id = tr.find('td:first').text();

					$.post( "{{ url('order/confirm') }}", { 
						_token: "{{ csrf_token() }}",
						id: id,
					} ).done(function( data ) {

						if(data.split("\n").join("") == 'OK: 1 mensajes enviados...'){

							// alert("aca se elimina la casilla y se envia mensaje de confirmacion.")

							tr.remove();
						}
					});

				},
				ajaxLoadOrders: function(){

					$.post( "{{ url('order/load') }}", { 
						_token: "{{ csrf_token() }}",
						// idLast: variablesListOrder.idLast,
					} ).done(function( data ) {

						if(data == 0){
							return false;
						}

						// variablesListOrder.idLast = data.idLast;

						$.each(data.orders, function(i, index){
							$("#orders tbody").append('\
		                        <tr>\
		                            <td class="text-center">'+ index.id +'</td>\
		                            <td class="text-center">123456</td>\
		                            <td class="text-center"><span>$0</span></td>\
		                            <td class="text-center"><a class="borrar confirm-order" href="javascript:;">&nbsp; Confirmar &nbsp;</a></td>\
		                        </tr>\
							');
						});
					});
				}
			}

			$("#orders").on('click', '.confirm-order', functionsListOrder.clickConfirmOrder);

			setInterval(functionsListOrder.ajaxLoadOrders, 2000);
		} );
		
	</script>
@stop
