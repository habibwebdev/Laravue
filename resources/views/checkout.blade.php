@extends('layouts.index')

@section('title', 'Checkout')

@section('stripe')

<script src="https://js.stripe.com/v3/"></script>
<script src="/js/stripe-s.js"></script>
{{-- <script src="/js/stripe.js"></script> --}}

@endsection

@section('content')
<section id="shopheader" class="">
    {{ menu('main', 'partials.simplenav') }}
</section>



    <section id="checkout" class="py-5">
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

                    <h2 class="heading-bars font-weight-normal">Checkout</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mr-4">
                <form action="{{route('checkout.store')}}" method="POST" id="payment-form">
                        @csrf
                        <h5 class="mt-5 mb-4">Billing Details</h5>
                        <div class="form-group relative">
                            <label for="email">Email Address</label>
                            @if (auth()->user())
                                <input type="text" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                            @else
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                <?php #echo $errors->first('email', "<span class='text-danger absolute'> * :message</span>"); ?>
                            @endif
                        </div>
                        <div class="form-group relative">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <?php echo $errors->first('name', "<span class='text-danger absolute'> * :message</span>"); ?>
                        </div>
                        <div class="form-group relative">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control">
                            <?php echo $errors->first('address', "<span class='text-danger absolute'> * :message</span>"); ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6 relative">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control">
                                <?php echo $errors->first('city', "<span class='text-danger absolute mr-1'> * :message</span>"); ?>
                            </div>
                            <div class="form-group col-sm-6 relative">
                                <label for="province">Province</label>
                                <input type="text" name="province" id="province" class="form-control">
                                <?php echo $errors->first('province', "<span class='text-danger absolute mr-1'> * :message</span>"); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6 relative">
                                <label for="pcode">Postal Code</label>
                                <input type="text" name="postalcode" id="postalcode" class="form-control">
                                <?php echo $errors->first('postalcode', "<span class='text-danger absolute mr-1'> * :message</span>"); ?>
                            </div>
                            <div class="form-group col-sm-6 relative">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                                <?php echo $errors->first('phone', "<span class='text-danger absolute mr-1'> * :message</span>"); ?>
                            </div>
                        </div>
                        <h5 class="my-4">Payment Details</h5>
                        {{-- <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="cardn">Name on Card</label>
                                <input type="text" name="cardn" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="cc">Credit Card no.</label>
                                <input type="text" name="cc" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="carde">Card Expiry Date</label>
                                <input type="text" name="carde" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="cvc">CVC/CVV</label>
                                <input type="text" name="cvc" class="form-control">
                            </div>
                        </div> --}}

                        <div class="form-group relative">
                            <label for="cardn">Name on Card</label>
                            <input type="text" name="name_on_card" id="name_on_card" class="form-control">
                            <?php echo $errors->first('name_on_card', "<span class='text-danger absolute'> * :message</span>"); ?>
                        </div>

                        <div class="form-group">
                            <label for="card-element">
                                  Credit or debit card
                            </label>
                            <div id="card-element" class="border border-color">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <div class="form-group mt-4 pt-2">
                            <button type="submit" id="complete-order" class="btn btn-success btn-lg btn-block">Complete Order</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-5 ml-5 pl-5">
                    <h5 class="mt-5 mb-4">Your Order</h5>
                    <div class="sidebar-cart border border-secondary border-right-0 border-left-0">

                        @foreach(Cart::content() as $item)
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                    <img src="{{ productImage($item->model->image) }}" alt="item" class="img-fluid my-4">
                                </div>
                                <div class="col-sm-7 p-specs">
                                    <p class="m-0 pt-4">{{$item->model->name}}</p>
                                    <p class="text-muted m-0">{{$item->model->details}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <p class="border p-2 mt-4 text-center">{{$item->qty}}</p>
                                </div>
                            </div><hr>
                        @endforeach
                        @if (!session()->has('coupon'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="float-left">Subtotal</p>
                                    <p class="float-right">{{presentPrice(Cart::subtotal())}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="float-left">Tax</p>
                                    <p class="float-right">{{presentPrice(Cart::tax())}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <h5 class="float-left">Total</h5>
                                    <h5 class="float-right">{{presentPrice(Cart::total())}}</h5>
                                </div>
                            </div>
                            {{-- <hr>

                                <div class="coupon-section mb-4">
                                    <p class="pt-3">have A Code?</p>
                                    <form action="{{ route('coupon.store') }}" method="POST">
                                        @csrf
                                        <div class="input-group border p-3">
                                            <input type="text" name="coupon" class="form-control rounded-0">
                                            <button type="submit" class="btn btn-outline-secondary rounded-0 px-4">Apply</button>
                                        </div>
                                    </form>
                                </div> --}}
                        @endif
                        @if(session()->has('coupon'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="float-left">Subtotal</p>
                                    <p class="float-right">{{presentPrice(Cart::subtotal())}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="float-left border-bottom">
                                        <p class="float-left">Discount ({{ session()->get('coupon')['name'] }})</p>
                                        {{-- <form action="{{ route('coupon.destroy') }}" method="POST" class="float-right">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-light p-0 mt-0 ml-2 align-top"><small>Remove</small></button>
                                        </form> --}}
                                    </div>

                                    {{-- <p class="float-right">-{{ presentPrice(session()->get('coupon')['discount']) }}</p> --}}
                                    <div class="float-right border-bottom">
                                        <p class="float-right">-{{ presentPrice($discount) }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="float-left mt-3">New Subtotal</p>
                                    <p class="float-right mt-3">{{presentPrice($newSubtotal)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="float-left">Tax</p>
                                    <p class="float-right">{{presentPrice($newTax)}}</p>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <h5 class="float-left">Total</h5>
                                    <h5 class="float-right">{{presentPrice($newTotal)}}</h5>
                                </div>
                            </div>
                        @endif
                            {{-- @if(!session()->has('coupon'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="float-left">Tax</p>
                                    <p class="float-right">{{presentPrice(Cart::tax())}}</p>
                                </div>
                            </div>
                            @endif
                            <hr>
                            @if(session()->has('coupon'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="float-left">New Subtotal</p>
                                        <p class="float-right">{{presentPrice(Cart::subtotal())}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="float-left">Tax</p>
                                        <p class="float-right">{{presentPrice(Cart::tax())}}</p>
                                    </div>
                                </div>
                                <hr>
                            @endif
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <h5 class="float-left">Total</h5>
                                    <h5 class="float-right">{{presentPrice(Cart::total())}}</h5>
                                </div>
                            </div>

                    </div>
                    @if (!session()->has('coupon'))
                        <div class="coupon-section mb-4">
                            <p class="pt-3">have A Code?</p>
                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <div class="input-group border p-3">
                                    <input type="text" name="coupon" class="form-control rounded-0">
                                    <button type="submit" class="btn btn-outline-secondary rounded-0 px-4">Apply</button>
                                </div>
                            </form>
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </section>

@endsection

@section('extra-js')

<script>

    (function(){

        // Create a Stripe client.
        var stripe = Stripe('{{config('services.stripe.key')}}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#dc3545',
                iconColor: '#dc3545'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
            });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            $displayError.addClass('text-danger');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Disable the submit button to prevent repeated clicks
              document.getElementById('complete-order').disabled = true;

              var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
              }

            stripe.createToken(card, options).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;

                    // Enable the submit button
                    document.getElementById('complete-order').disabled = false;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    })();


</script>

@stop
