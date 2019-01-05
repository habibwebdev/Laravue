@extends('layouts.index')

@section('content')
<section id="shopheader" class="">
    {{-- @include('partials.navbar') --}}
    {{ menu('main', 'partials.auth-nav') }}

</section>
<section id="full-page" class="my-5 py-5">
    <div class="page-center">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-6 border-right mt-5">

                    <h2 class="display-5 mb-5 font-weight-normal">Create Accout</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="input-group col-md-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group col-md-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group col-md-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock-open"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group col-md-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-dark col-md-4">
                                    {{ __('Register') }}
                                </button>
                                <div class="float-right mt-2">
                                    <p class="font-weight-bold m-0">Already A Member? <a href="{{ route('login') }}" class="text-info font-weight-light">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 pl-5 mt-5">
                    <div class="row">
                        <div class="col-md-12 pl-5">
                            <div class="upper pl-4 mb-5">
                                <h2 class="display-5 mb-5 font-weight-normal">New Customer</h2>
                                <p class="font-weight-bold mb-0">Save time now.</p>
                                <p>Creating an account will allow you to checkout faster in the future, have easy access to order history and customize your
                                experience to suit your preferences.</p>
                                {{-- <a href="{{ route('guestCheckout.index') }}" class="btn btn-outline-dark">Checkout as a Guest</a> --}}
                            </div>
                            <div class="lower pl-4">

                                <p class="font-weight-bold mb-0">Loyalty Program.</p>
                                <p class="m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt debitis, amet magnam accusamus nisi distinctio eveniet
                                ullam. Facere, cumque architecto.</p>
                                {{-- <a href="{{ route('register') }}" class="btn btn-outline-dark">Create Account</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection
