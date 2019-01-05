<nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="{{url('/')}}">Laravel Ecommerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  	</button>
        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- <ul class="navbar-nav ml-auto">
                <li class="nav-item px-4">
                    <a class="nav-link text-uppercase" href="{{url('shop')}}">Shop</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link text-uppercase" href="#">About</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link text-uppercase" href="#">Blog</a>
                </li>
                <li class="nav-item px-4">
                <a class="nav-link text-uppercase" href="{{url('cart')}}">
                    Cart
                    @if(Cart::instance('default')->count() > 0)
                    <small class="item-q bg-warning rounded-circle text-dark">{{Cart::instance('default')->count()}}</small>
                    @endif
                </a>

                </li>
            </ul> --}}
            {{-- For Dynamic Menus --}}
            <ul class="navbar nav ml-auto">
                @foreach($items as $menu_item)
                    <li class="nav-item px-4">
                        <a class="nav-link text-uppercase text-light" href="{{ $menu_item->link() }}">
                            {{ $menu_item->title }}
                            @if ($menu_item->title == 'Cart')
                                @if(Cart::instance('default')->count() > 0)
                                    <small class="item-q bg-warning rounded-circle text-dark">{{Cart::instance('default')->count()}}</small>
                                @endif
                            @endif

                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
