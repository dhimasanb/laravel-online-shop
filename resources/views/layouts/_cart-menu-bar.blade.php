<li><a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart {{ $cart->totalProduct() > 0 ? '(' . $cart->totalProduct() . ')' : ''}}</a></
