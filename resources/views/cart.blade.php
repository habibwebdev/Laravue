@extends('layouts.index')

@section('title', 'Cart')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/instantsearch.min.css') }}">
@endsection

@section('content')
<section id="shopheader" class="">
    {{-- @include('partials.navbar') --}}
    {{ menu('main', 'partials.auth-nav') }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/shop')}}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ShoppingCart</li>
                    </div>
                    <div class="col-sm-4">
                        {{-- Custom searchbox --}}
                        {{-- @include('partials.search')   --}}
                        {{-- Algolia search --}}
                        <div class="row">
                        <div class="col-sm-12">
                            <!-- HTML Markup -->
                            <div class="aa-input-container float-right" id="aa-input-container">
                                <input type="search" id="aa-search-input" class="aa-input-search border border-custom-secondary rounded" placeholder="Search for product..." name="search"
                                    autocomplete="off" />
                                <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                                    <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </ol>
    </nav>
</section>

    <section id="cart" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @if(session()->has('success_message'))
                        <div class="alert alert-success alert-section">
                            <p class="m-0">{{session()->get('success_message')}}</p>
                        </div>
                    @endif

                    @if(count($errors) > 0)
                        <div class="alert alert-danger alert-section">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Check the Cart --}}

                    @if(Cart::count() > 0)

                        <div class="total-items-section mb-4 mt-4">
                        <h5>{{Cart::count()}} item(s) <span class="text-capitalize">in Shopping Cart.</span></h5>
                        </div>
                        @foreach(Cart::content() as $item)
                        <div class="cart-product-section border border-right-0 border-left-0">

                                <div class="row">
                                    <div class="col-sm-2 p-img">
                                    <a href="{{route('shop.show', $item->model->slug)}}"><img src="{{ productImage($item->model->image) }}" alt="item" class="img-fluid my-4"></a>
                                    </div>
                                    <div class="col-sm-4 p-specs">
                                    <a href="{{route('shop.show', $item->model->slug)}}" class="text-dark"><p class="m-0 pt-4">{{$item->model->name}}</p></a>
                                    <p class="text-muted m-0">{{$item->model->details}}</p>
                                    </div>
                                    <div class="col-sm-2 p-action pt-2">
                                        {{-- <a href="remove.html" class="text-secondary"><small class="d-block pt-4">Remove</small></a> --}}
                                    <form action="{{route('cart.destroy', $item->rowId)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light p-0 mt-3 cursor-pointer"><small>Remove</small></button>
                                    </form>
                                        {{-- <a href="{{url('cartsaved')}}" class="text-secondary"><small class="d-block">Save for later</small></a> --}}
                                        <form action="{{route('cart.saveForLater', $item->rowId)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-light p-0 cursor-pointer"><small>Save for later</small></button>
                                        </form>
                                    </div>
                                    <div class="col-sm-2 p-quantity pt-3">
                                        {{-- <form action=""> --}}
                                        <select class="form-control mt-3 quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                            {{-- for dynamic quantity --}}
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                                {{-- <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ $item->qty == 5 ? 'selected' : '' }}>5</option> --}}
                                            </select>
                                        {{-- </form> --}}
                                    </div>
                                    <div class="col-sm-2 p-price pt-3">
                                        <p class="pt-4">{{ presentPrice($item->subtotal) }}</p>
                                    </div>
                                </div>

                        </div>
                        @endforeach
                        <div class="row">
                            {{-- <div class="col-sm-4"></div> --}}
                            @if(!session()->has('coupon'))
                                <div class="col-sm-12">
                                    <div class="coupon-section float-right">
                                        <p class="pt-3">have A Code?</p>
                                        <form class="form-inline" action="{{ route('coupon.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group border p-3">
                                                <input type="text" name="coupon" class="form-control rounded-0">
                                                <button type="submit" class="btn btn-outline-secondary rounded-0 px-4">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="total-section bg-light p-3 border">
                            <div class="row">
                                <div class="col-sm-6 pt-2">
                                    <p>Shipping is free because we are awesome like that. Also that's additional stuff and i don't
                                        ffel like figuring it out :).</p>
                                </div>
                                <div class="col-sm-4 pt-3">
                                    <p class="mb-2">Subtotal</p>
                                    @if(!session()->has('coupon'))
                                        <p class="mb-2">Tax(17%)</p>
                                        <h5>Total</h5>
                                    @endif
                                    @if(session()->has('coupon'))
                                        <div class="discount">
                                            <p class="d-inline">Discount<small>({{ session()->get('coupon')['name'] }})</small></p>
                                            <form action="{{ route('coupon.destroy') }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-small p-0 mt-0 align-baseline"><small>Remove</small></button>
                                            </form>
                                        </div>
                                        <p class="pt-2">New Subtotal</p>
                                        <h5 class="border-top pt-3">Total</h5>
                                    @endif


                                </div>
                                <div class="col-sm-2 pt-3">
                                    <?php
                                    $decimals = 2;
                                    $decimalSeperator = '.';
                                    $thousandSeperator = '';
                                    ?>
                                    <p class="mb-2 text-right">{{presentPrice(Cart::subtotal())}}</p>
                                    @if(!session()->has('coupon'))
                                        <p class="mb-2 text-right">{{presentPrice(Cart::tax())}}</p>
                                        <h5 class="text-right">{{ presentPrice(Cart::total()) }}</h5>
                                    @endif
                                    @if(session()->has('coupon'))
                                        <p class="text-right m-0">-{{ presentPrice($discount) }}</p>
                                        <p class="text-right pt-2">{{presentPrice($newSubtotal)}}</p>
                                        <h5 class="pt-3 text-right border-top">{{ presentPrice($newTotal) }}</h5>
                                    @endif



                                </div>
                            </div>
                        </div>
                        <div class="checkout-btn-section py-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{url('shop')}}" class="btn btn-outline-secondary px-5  rounded-0">Continue Shopping</a>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="{{url('checkout')}}" class="btn btn-success px-5  rounded-0">Proceed to Checkout</a>
                                </div>
                            </div>
                        @else
                            <h5 class="py-2">You have no item(s) <span class="text-capitalize">in Shopping Cart.</span></h5>
                            <a href="{{url('shop')}}" class="btn btn-outline-secondary px-5  my-4 rounded-0">Continue Shopping</a>
                        @endif

                        {{-- Save for Later --}}

                        @if(Cart::instance('saveForLater')->count() > 0)

                            <div class="total-items-section mb-4 mt-4">
                                <h5>{{Cart::instance('saveForLater')->count()}} item(s) <span class="text-capitalize">saved for later.</span></h5>
                            </div>

                            @foreach(Cart::instance('saveForLater')->content() as $item)
                                <div class="cart-product-section border border-right-0 border-left-0">

                                    <div class="row">
                                        <div class="col-sm-2 p-img">
                                            <a href="{{route('shop.show', $item->model->slug)}}"><img src="{{ productImage($item->model->image) }}" alt="item" class="img-fluid my-4"></a>
                                        </div>
                                        <div class="col-sm-6 p-specs">
                                            <a href="{{route('shop.show', $item->model->slug)}}" class="text-dark">
                                                <p class="m-0 pt-4">{{$item->model->name}}</p>
                                            </a>
                                            <p class="text-muted m-0">{{$item->model->details}}</p>
                                        </div>
                                        <div class="col-sm-2 p-action pt-2">
                                            {{-- <a href="remove.html" class="text-secondary"><small class="d-block pt-4">Remove</small></a> --}}
                                            <form action="{{route('saveForLater.destroy', $item->rowId)}}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-light p-0 mt-3 cursor-pointer"><small>Remove</small></button>
                                            </form>
                                            {{-- <a href="{{url('cartsaved')}}" class="text-secondary"><small class="d-block">Save for later</small></a>            --}}
                                            <form action="{{route('saveForLater.moveToCart', $item->rowId)}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-light p-0 cursor-pointer"><small>Move to Cart</small></button>
                                            </form>
                                        </div>
                                        {{-- <div class="col-sm-2 p-quantity pt-3">
                                            <form action="">
                                                <select class="form-control mt-3">
                                                    <option selected>1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </form>
                                        </div> --}}
                                        <div class="col-sm-2 p-price pt-3">
                                            <p class="pt-4">{{$item->model->presentPrice()}}</p>
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                            @else
                                <h5 class="mt-5">You have no Item(s) saved for later!</h5>
                            @endif
                            {{-- <div class="row">
                                <div class="col-sm-12">
                                    <p class="mt-4">You have no item saved for later.</p>
                                </div>
                            </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="mightlike" class="py-5 bg-light">
        @include('partials.mightlike')
    </section>

    @section('extra-js')
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element){
                element.addEventListener('change', function(){
                    const id = element.getAttribute('data-id')
                    const productQuantity = element.getAttribute('data-productQuantity')
                    // make sure to change the comma to ES6 Template strings below
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(function (response) {
                        // console.log(response);
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        // console.log(error);
                        window.location.href = '{{ route('cart.index') }}'
                    });
                    // alert('changed');
                })
            })
        })();
    </script>
    <script src="{{ asset('js/algoliasearch.min.js') }}"></script>
    <script src="{{ asset('js/autocomplete.min.js') }}"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
    <script src="{{ asset('js/instantsearch.min.js') }}"></script>
    <script src="{{ asset('js/algolia-instantsearch.min.js') }}"></script>
@stop
