<div class="container">
    <div class="row">
        <h5 class="pb-5 ml-3">You might also like...</h5>
    </div>
    <div class="row">
        @foreach($mightlike as $product)
            <div class="col-sm-3">
                <div class="img-box border p-4 bg-white d-flex flex-column justify-content-center">
                    <div class="img-box-img align-self-start">
                        <a href="{{route('shop.show', $product->slug)}}"><img src="{{ productImage($product->image) }}" class="img-fluid"></a>
                    </div>

                    <div class="img-box-content align-self-end mx-auto">
                        <a href="{{route('shop.show', $product->slug)}}" class="text-dark text-center pt-3 d-block">{{$product->name}}</a>
                        <p class="text-center text-muted">{{$product->presentPrice()}}</p>
                    </div>

                </div>
            </div>
        @endforeach
        {{-- <div class="col-sm-3">
            <div class="img-box border p-4 bg-white">
                <img src="/img/products/macbook-pro.png" alt="" class="img-fluid pb-3">
                <p class="text-dark text-center m-0">MacBook Pro</p>
                <p class="text-muted text-center m-0">$2499.99</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="img-box border p-4 bg-white">
                <img src="/img/products/macbook-pro.png" alt="" class="img-fluid pb-3">
                <p class="text-dark text-center m-0">MacBook Pro</p>
                <p class="text-muted text-center m-0">$2499.99</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="img-box border p-4 bg-white">
                <img src="/img/products/macbook-pro.png" alt="" class="img-fluid pb-3">
                <p class="text-dark text-center m-0">MacBook Pro</p>
                <p class="text-muted text-center m-0">$2499.99</p>
            </div>
        </div> --}}
    </div>
</div>
