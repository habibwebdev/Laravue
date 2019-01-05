@extends('layouts.index')

@section('title', 'Shop')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/instantsearch.min.css') }}">
@endsection

@section('content')
    <section id="shopheader" class="">
        {{-- @include('partials.navbar') --}}
        {{ menu('main', 'partials.auth-nav') }}
        {{-- @include('partials.breadcrumbs') --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </div>
                        <div class="col-sm-4">
                            {{-- custom search --}}
                            {{-- @include('partials.search') --}}
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

    <section id="shop" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                     {{-- success message --}}
                    @if(session()->has('success_message'))
                    <div class="alert alert-success alert-section mb-5">
                        <p class="m-0">{{session()->get('success_message')}}</p>
                    </div>
                    @endif

                    {{-- error message --}}
                    @if(count($errors) > 0)
                    {{-- <div class="spacer"></div> --}}

                        <ul class="mb-5 list-group">
                            @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{!! $error !!}</li>
                            @endforeach
                        </ul>
                        {{-- <p class="alert alert-danger m-0">{{ $errors->first('coupon') }}</p> --}}
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="side-menu-cat">
                        <h4 class="font-weight-normal">By catagory</h4>
                        <nav class="nav flex-column">
                            {{-- Loop for dynamic categories gets from shopcontroller --}}
                            @foreach($categories as $category)
                        <a class="nav-link text-secondary {{ setActivecategory($category->slug) }}" href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            @endforeach
                            {{-- <a class="nav-link text-dark" href="#">Laptops</a>
                            <a class="nav-link text-dark" href="#">Desktops</a>
                            <a class="nav-link text-dark" href="#">Mobile Phone</a>
                            <a class="nav-link text-dark" href="#">Tablets</a>
                            <a class="nav-link text-dark" href="#">Tvs</a>
                            <a class="nav-link text-dark" href="#">Digital Camras</a>
                            <a class="nav-link text-dark" href="#">Appliances</a> --}}
                        </nav>
                    </div>
                    {{-- <div class="side-menu-cat mt-4">
                        <h5>By price</h5>
                        <nav class="nav flex-column">
                            <a class="nav-link text-dark" href="#">$0-$700</a>
                            <a class="nav-link text-dark" href="#">$700-$2500</a>
                            <a class="nav-link text-dark" href="#">$2500+</a>
                        </nav>
                    </div> --}}
                </div>
                <div class="col-sm-9">
                    {{-- For Dynamic Price range --}}
                    <div class="d-flex justify-content-between">
                        <h2 class="heading-bars font-weight-normal">{{ $category_name }}</h2>
                        <div class="product-by-price">
                            <Strong>Price: </Strong>
                            <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'low_high']) }}">Low to High</a> |
                            <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'high_low']) }}">High to Low</a>
                        </div>
                    </div>


                    <div class="row mt-4">
                        {{-- @foreach($products as $product)
                        <div class="col-sm-4 pt-5 mt-3 text-center">

                            <a href="{{url('shop', $product->slug)}}">
                                <img src="{{asset('img/products/'.$product->slug.'.png')}}" alt="" class="img-fluid pb-3">
                            </a>
                            <a href="{{route('shop.show', $product->slug)}}" class="text-dark text-center pt-2 d-block">{{$product->name}}</a>
                            <p class="text-center text-muted">{{$product->presentPrice()}}</p>
                        </div>
                        @endforeach --}}

                        @forelse($products as $product)
                            <div class="col-sm-4 pt-5 mt-3 text-center">
                                {{-- <a href="{{route('shop.show', $product->slug)}}"> --}}
                                <a href="{{url('shop', $product->slug)}}">
                                    <img src="{{ productImage($product->image) }}" alt="" class="img-fluid pb-3 w-256 h-156">
                                </a>
                                <a href="{{route('shop.show', $product->slug)}}" class="text-dark text-center pt-2 d-block">{{$product->name}}</a>
                                <p class="text-center text-muted">{{$product->presentPrice()}}</p>


                            </div>
                        @empty
                                <p class="text-muted ml-3 mt-5">No Items Found!</p>
                        @endforelse


                                    <div class="col-sm-12 text-center d-flex justify-content-center mt-5">
                                        <div class="my-pagination mt-2">
                                            {{-- simple pagination with query links in url --}}
                                            {{-- {{ $products->links() }} --}}
                                            {{-- Custom Pagination with query links in url --}}
                                            {{ $products->appends(request()->input())->links() }}
                                        </div>
                                    </div>



                    {{-- <div class="row py-4 mt-4">
                        @foreach($products as $product)
                        <div class="col-sm-4">
                            <a href="{{url('product')}}">
                            								<img src="img/macbook-pro.png" alt="" class="img-fluid pb-3">
                            							</a>
                            <a href="" class="text-dark text-center pt-3 d-block">{{$product->name}}</a>
                            <p class="text-center text-muted">{{$product->presentPrice()}}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="row py-4 mt-4">
                        @foreach($products as $product)
                        <div class="col-sm-4">
                            <a href="{{url('product')}}">
                            								<img src="img/macbook-pro.png" alt="" class="img-fluid pb-3">
                            							</a>
                            <a href="" class="text-dark text-center pt-3 d-block">{{$product->name}}</a>
                            <p class="text-center text-muted">{{$product->presentPrice()}}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="row py-4 mt-4">
                        @foreach($products as $product)
                        <div class="col-sm-4">
                            <a href="{{url('product')}}">
                            								<img src="img/macbook-pro.png" alt="" class="img-fluid pb-3">
                            							</a>
                            <a href="" class="text-dark text-center pt-3 d-block">{{$product->name}}</a>
                            <p class="text-center text-muted">{{$product->presentPrice()}}</p>
                        </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    @stop
    @section('extra-js')
        <script src="{{ asset('js/algoliasearch.min.js') }}"></script>
        <script src="{{ asset('js/autocomplete.min.js') }}"></script>
        <script src="{{ asset('js/algolia.js') }}"></script>
        <script src="{{ asset('js/instantsearch.min.js') }}"></script>
        <script src="{{ asset('js/algolia-instantsearch.js') }}"></script>
    @endsection
