<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="menu-collapse">
    <ul class="nav navbar-nav navbar-left" id="menu-bar">  
        <!-- Sidebar visible on desktop and tablet-->
        <li class="hidden-xs"><a id="left-sidebar" href="#sidr" class="sidebar">Ver el menú</a></li>
    </ul>

    <!-- Right submenu visible on desktop and tablet -->
    <ul class="hidden-xs nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="javascript:;" class="shop dropdown-toggle" data-toggle="dropdown">shopping cart</a>
            <!-- empty cart block
            <ul class="dropdown-menu wrap-empty-cart hidden-xs">
                <li>you have no items in your shopping cart</li>
            </ul>
            -->
            <!-- cart with products -->
            <div class="dropdown-menu wrap-cart hidden-xs">
                <hr>
                <p class="total">Total: $<span>0</span></p>
                <div class="product-buttons pull-right">
                    <a href="{{ url('/') }}" id="delete-order">Borrar pedido</a>
                    <a href="{{ url('pay') }}">Comprar</a>
                </div>
            </div><!-- /cart with products --> 
        </li>
    </ul>
</div><!-- /navbar-collapse -->

@section('scripts_shopping_cart')

    <script type="text/javascript">

      $( function() {

        var functionsMaster = {
            payDropdownShow: function(){

                var body = $(this).parent().find('.wrap-cart');
                var totalPayment = 0;
                body.find(".wrap-cart-products").remove();
                body.find(".product-buttons").hide();

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

                    functionsMaster.addRowItemModal(body, productBuy.cant, productBuy.name, '$'+ priceTotal, accompaniments, i);

                    body.find(".product-buttons").show();

                });

                body.find("p.total span").html(totalPayment);
            },
            addRowItemModal: function(obj, val1, val2, val3, accompaniments, i){

                $('<div class="wrap-cart-products">\
                    <a href="product.html" class="product-image"><img src="http://placehold.it/90x81" alt="Product Image"/></a>\
                    <div class="product-title">\
                        <p class="producto">'+ val2 +'</p>\
                        <p class="adiciones">Adiciones: '+ accompaniments +'</p>\
                        <p>'+ val1 +' <span>x '+ val3 +'</span></p>\
                    </div>\
                    <div class="right-icons pull-right">\
                        <a href="javascript:;" data-position="'+ i +'">x</a>\
                    </div>\
                </div>').insertBefore(obj.find("hr"));

                obj.find("hr").prev().find("a:last").click(functionsMaster.clickDeleteProduct);
            },
            clickDeleteProduct: function(){
                localStorage.removeItem($(this).attr("data-position"));
            }
        }

        $(".shop").click(functionsMaster.payDropdownShow);

        $("#delete-order").click(function(){

            $.each(localStorage, function(i, index){

                localStorage.removeItem(i);
            });
        });

      });
      
    </script>

@stop