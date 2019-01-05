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

                    <h2 class="display-5 mb-5 font-weight-normal">Returning Customer</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">


                            <div class="input-group col-md-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
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
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-dark col-md-4">
                                    {{ __('Login') }}
                                </button>
                                <div class="checkbox float-right mt-2">
                                    <label class="align-middle m-0">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            {{-- <div class="col-md-8 offset-md-4"> --}}
                            <div class="col-md-10">
                                <a class="btn btn-link text-dark pl-0" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
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
                                <p>You don't need an account to checkout.</p>
                                <a href="{{ route('guestCheckout.index') }}" class="btn btn-outline-dark">Checkout as a Guest</a>
                            </div>
                            <div class="lower pl-4">

                                <p class="font-weight-bold mb-0">Save time later.</p>
                                <p>Create an account for fast checkout and easy access to order history.</p>
                                <a href="{{ route('register') }}" class="btn btn-outline-dark">Create Account</a>
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
