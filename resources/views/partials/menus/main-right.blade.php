<ul>
    @guest
    <li><a href="{{route('shop.index')}}">Shop</a></li>
    <li><a href="">Sign Up</a></li>
    <li><a href="">Login</a></li>
    @else
    <li>
        <a href="">
            Logout
        </a>
    </li>

    <form id="logout-form" action="" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @endguest
    <li><a href="{{ route('cart.index') }}">Cart
    
    <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
  
    </a></li>
    {{-- @foreach($items as $menu_item)
        <li>
            <a href="{{ $menu_item->link() }}">
                {{ $menu_item->title }}
                @if ($menu_item->title === 'Cart')
                    @if (Cart::instance('default')->count() > 0)
                    <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
                    @endif
                @endif
            </a>
        </li>
    @endforeach --}}
</ul>
