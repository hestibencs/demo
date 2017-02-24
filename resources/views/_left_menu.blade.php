<!-- Dropdown left menu visible on desktop and tablet-->
<div id="sidr" class="hidden-xs">
    <h1 class="logo"><img src="{{ asset('img/logo-corral.png') }}" alt="Logo ElCorral - La receta original"/></h1>
    <a id="left-sidebar-close" href="#sidr" class="sidebar text-hide" title="Close">Close</a>
    <ul class="left-menu">

        <?php

            $typeProducts = \App\TypeProduct::all();

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