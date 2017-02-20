<!-- Dropdown left menu visible on desktop and tablet-->
<div id="sidr" class="hidden-xs">
    <h1 class="logo"><img src="{{ asset('img/logo-corral.png') }}" alt="Logo ElCorral - La receta original"/></h1>
    <a id="left-sidebar-close" href="#sidr" class="sidebar text-hide" title="Close">Close</a>
    <ul class="left-menu">

        <?php

            $typeProducts = array(
                array(
                    'name' => 'A la parrilla',
                    'image' => 'img/cat/parrilla.png',
                    'id' => 'HVfkP6Kk6b3rpXK35w3f13U5VBs4gy3j'
                ),
                array(
                    'name' => 'A la plancha',
                    'image' => 'img/cat/plancha.png',
                    'id' => '3lL4M0jpvGJWY4z1xTDvV9cJ2LHebMeG'
                ),
                array(
                    'name' => 'Vaqueros',
                    'image' => 'img/cat/vaqueros.png',
                    'id' => 'z5dt1DdZeVS85tSs1vkCFnuP0LKj4mdu'
                ),
                array(
                    'name' => 'Sándwiches',
                    'image' => 'img/cat/sandwiches.png',
                    'id' => 'bXivH8P9ZMHdO352DoDDE164H0Db1qA0'
                ),
                array(
                    'name' => 'Wraps',
                    'image' => 'img/cat/wraps.png',
                    'id' => 'wQw5qVitA3vv6IGusEEQ2ZR25vpDcTSN'
                ),
                array(
                    'name' => 'Ensaladas',
                    'image' => 'img/cat/ensaladas.png',
                    'id' => ''
                ),
                array(
                    'name' => 'También disfruta',
                    'image' => 'img/cat/disfruta.png',
                    'id' => ''
                ),
                array(
                    'name' => 'Postres',
                    'image' => 'img/cat/postres.png',
                    'id' => ''
                ),
                array(
                    'name' => 'Bebidas',
                    'image' => 'img/cat/bebidas.png',
                    'id' => ''
                ),
            );

        ?>

        @foreach($typeProducts as $type)
            <li><a href="{{ route('product', $type['id']) }}">{{ $type['name'] }}</a></li>
        @endforeach
    </ul>
    <br />
    <ul class="left-menu derecha">
      <li><a href="{{ url('/') }}">Inicio</a></li>
      <li><a href="shopping-cart.html">Comprar</a></li>
    </ul>
</div><!--/dropdown left menu visible on desktop and tablet-->