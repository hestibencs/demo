<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>@section('title') Starter Template for Bootstrap @show</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('starter-template.css') }}" rel="stylesheet">

    @yield('styles')

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="{{ asset('assets/js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
    <script src="{{ asset('assets/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">Colombia</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="@if (Request::is('/')) active @endif">
              <a href="{{ url('/') }}">Home</a>
            </li>
            <li class="dropdown @if (Request::is('product/*')) active @endif">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="@if (Request::is('product/HVfkP6Kk6b3rpXK35w3f13U5VBs4gy3j')) active @endif"><a href="{{ url('product/HVfkP6Kk6b3rpXK35w3f13U5VBs4gy3j') }}">Hamburguesas</a></li>
                <li><a href="#">Pollo</a></li>
                <li><a href="#">Ensaladas</a></li>
                <li><a href="#">Papas y Acompañamientos</a></li>
                <li><a href="#">Bebidas</a></li>
              </ul>
            </li>
          </ul>
          <a href="javascript:;" class="navbar-brand navbar-right">
            Total Pedido: $<span id="totalBuy">0</span>
          </a>
          <form class="navbar-form navbar-right">
            <button type="button" id="payTotal" class="btn btn-success" data-toggle="modal" data-target="#payModal">
              Pagar
            </button>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      @yield('content')
    </div><!-- /.container -->

    <!-- Modal -->
    <div class="modal fade bs-example-modal-sm" id="payModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Generar Pago</h4>
          </div>
          <div class="modal-body">
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
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href="{{ url('pay') }}" class="btn btn-primary">Aceptar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('assets/js/vendor/jquery.min.js') }}"><\/script>')</script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('assets/js/ie10-viewport-bug-workaround.js') }}"></script>

    <script type="text/javascript">

      $( function() {

        var functionsMaster = {
          calculateTotalBuy: function(){

            var totalBuy = 0;

            $.each(localStorage, function(i, index){
              var productBuy = JSON.parse(index);
              totalBuy = totalBuy + productBuy.totalPrice;
            });

            $("#totalBuy").text(totalBuy);
          },
          payModalShow: function(){

            var body = $(this).find('.modal-body');
            body.find(".price-content").remove();

            $.each(localStorage, function(i, product){

              var productBuy = JSON.parse(product);

              functionsMaster.addRowItemModal(body, productBuy.cant, productBuy.name, '$'+ (parseInt(productBuy.cant) * parseInt(productBuy.priceUnitary)));

              $.each(productBuy.accompaniments, function(j, accompaniment){
                functionsMaster.addRowItemModal(body, accompaniment.cant, accompaniment.name, '$'+ (parseInt(accompaniment.cant) * parseInt(accompaniment.priceUnitary)));
              });

            });

            functionsMaster.addRowItemModal(body, '', '<p class="text-right"><strong>Neto</strong></p>', '$'+ parseInt(parseInt($("#totalBuy").text()) * 0.81));
            functionsMaster.addRowItemModal(body, '', '<p class="text-right"><strong>IVA</strong></p>', '$'+ parseInt(parseInt($("#totalBuy").text()) * 0.19));
            functionsMaster.addRowItemModal(body, '', '<p class="text-right"><strong>Total</strong></p>', '$'+ $("#totalBuy").text());

          },
          addRowItemModal: function(obj, val1, val2, val3){

            obj.append('<div class="row price-content">\
              <div class="col-md-2">'+ val1 +'</div>\
              <div class="col-md-7">'+ val2 +'</div>\
              <div class="col-md-3">'+ val3 +'</div>\
            </div>');

          }
        }

        functionsMaster.calculateTotalBuy();

        $('#payModal').on('shown.bs.modal', functionsMaster.payModalShow);

      });
      
    </script>

    @yield('scripts')

  </body>
</html>
