@extends('order.index')

@section('styles')
@stop

@section('content')
	
<section class="page-title container">
    <h1>Links</h1>
    <hr>
</section><!--/page-title -->

<section class="shopping-cart container invoice-print">
    <div class="row">
        <div class="col-lg-4">
        	<a href="{{ url('/') }}" target="_blank">Tienda</a></br>
        	<a href="{{ url('print/invoice') }}" target="_blank">Imprimir Factura</a></br>
        	<a href="{{ url('print/order') }}" target="_blank">Imprimir Orden</a></br>
			<a href="{{ url('order') }}" target="_blank">Confirmar Orden</a></br>
        </div>
    </div><!--/row -->
</section><!--/shopping-cart-->

@stop

@section('scripts')
@stop
