@extends('layouts.index')
@section('title', 'Cart-saved')
@section('content')
<section id="shopheader" class="">
    {{-- @include('partials.navbar') --}}
    {{ menu('main', 'partials.navbar') }}
    @include('partials.breadcrumbs')
</section>

    <section id="cartsaved" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="alert alert-success alert-section">
                        <p class="m-0">Item has been saved for later!</p>
                    </div>
                    <div class="total-items-section mb-4 mt-4">
                        <p>You have no items in your shopping cart.</p>
                        <a href="shop.html" class="btn btn-outline-secondary px-5 rounded-0">Continue Shopping</a>
                        <h5 class="mt-4 mb-5">1 item(s) <span class="text-capitalize">saved for later.</span></h5>
                    </div>
                    <div class="cart-product-section border border-right-0 border-left-0">
                        <div class="row">
                            <div class="col-sm-2 p-img">
                                <img src="img/macbook-pro.png" alt="" class="img-fluid my-4">
                            </div>
                            <div class="col-sm-4 p-specs">
                                <p class="m-0 pt-4">Item Name</p>
                                <p class="text-muted m-0">15 inch, 1T SSD, 16GB RAM</p>
                            </div>
                            <div class="col-sm-2 p-action pt-2">
                                <a href="remove.html" class="text-secondary"><small class="d-block pt-4">Remove</small></a>
                                <a href="{{url('cart')}}" class="text-secondary"><small class="d-block">Move to Cart</small></a>
                            </div>
                            <div class="col-sm-2 p-quantity pt-3">
                                <form action="">
                                    <select class="form-control mt-3">
									  <option selected>---</option>
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
                                </form>
                            </div>
                            <div class="col-sm-2 p-price pt-3">
                                <p class="pt-4">$1499.99</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="mightlike" class="py-5 bg-light">
        @include('partials.mightlike')
    </section>

    @stop
