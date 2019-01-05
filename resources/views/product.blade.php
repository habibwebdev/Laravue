@extends('layouts.index')

@section('title', $product->name)

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/instantsearch.min.css') }}">
@endsection

@section('content')
<section id="shopheader" class="">
    {{-- @include('partials.navbar') --}}
    {{ menu('main', 'partials.auth-nav') }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('shop')}}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
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

    <section id="item" class="py-5 mb-5">
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
                <div class="col-sm-6">
                    <div class="img-box-main border py-5 mr-5 text-center">
                        {{-- <img src="{{asset('img/products/'.$product->slug.'.jpg')}}" class="img-fluid py-5"> --}}
                        {{-- In Voyager we need to change the file path which is in storage --}}
                        {{-- <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid py-5"> --}}
                        {{-- displaying image with conditional logic in helpers.php --}}
                        <img src="{{ productImage($product->image) }}" class="img-fluid py-5 img-active" id="currentImage">
                    </div>
                    <div class="img-thmubs mr-5 bg-light border border-custom-secondary">
                        <div class="d-flex justify-content-center">
                            <div class="col-sm-3 p-2 selected ps-thumbnail">
                                <img src="{{ productImage($product->image) }}" class="img-fluid">
                            </div>
                            @if ($product->images)
                                {{-- first we have change the string into array below in foreach arguments --}}
                                 @foreach (json_decode($product->images, true) as $image)
                                    <div class="col-sm-3 p-2 thumb-img ps-thumbnail">
                                            <img src="{{ productImage($image) }}" class="img-fluid">
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="content-box pl-5">
                        <h2 class="mb-3">{{$product->name}}</h2>
                        <h5 class="text-muted mt-2">{{$product->details}}</h5>
                        <h6 class="text-muted">{!! $stockLevel !!}</h6>
                        <h4 class="mb-4">{{$product->presentPrice()}}</h4>
                        <p class="mb-4">{!! $product->description !!}</p>
                        {{-- <a href="{{url('cart')}}" class="btn btn-outline-secondary">Add to Cart</a> --}}
                        @if ($product->quantity > 0)
                            <form action="{{route('cart.store')}}" method="POST">
                                @csrf {{-- <input name="_method" type="hidden" value="PATCH"> --}}
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="name" value="{{$product->name}}">
                                <input type="hidden" name="price" value="{{$product->price}}">
                                <button type="submit" class="btn btn-outline-secondary">Add to Cart</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="mightlike" class="py-5 bg-light">
        @include('partials.mightlike')
    </section>
@endsection
    @section('extra-js')
        <script>
            (function(){
            const currentImage = document.querySelector('#currentImage');
            const images = document.querySelectorAll('.ps-thumbnail');

            images.forEach((element) => element.addEventListener('click', thumbnailClick));

            function thumbnailClick(e) {

                // alert('hi');

                currentImage.classList.remove('img-active');

                currentImage.addEventListener('transitionend', () => {
                    currentImage.src = this.querySelector('img').src;
                    currentImage.classList.add('img-active');
                })

                images.forEach((element) => element.classList.remove('selected'));
                this.classList.add('selected');
            }

        })();
        </script>
        <script src="{{ asset('js/algoliasearch.min.js') }}"></script>
        <script src="{{ asset('js/autocomplete.min.js') }}"></script>
        <script src="{{ asset('js/algolia.js') }}"></script>
        <script src="{{ asset('js/instantsearch.min.js') }}"></script>
        <script src="{{ asset('js/algolia-instantsearch.js') }}"></script>
    @stop
