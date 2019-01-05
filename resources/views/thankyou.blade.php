@extends('layouts.index')
@section('title', 'Thank You')
@section('content')
<section id="shopheader" class="">
    {{-- @include('partials.navbar') --}}
    {{ menu('main', 'partials.navbar') }}
</section>

    <section id="thankyou" class="py-5">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="height-100">
                    <div class="center">
                        @if(session()->has('success_message'))

                            {{-- <h2 class="m-0">{{session()->get('success_message')}}</h2><hr> --}}

                        @endif
                        <h2>Thank you for</h2>
                        <h2>Your Order</h2>
                        <p class="my-4">A confirmation email was sent.</p>
                        <a href="/" class="btn btn-outline-secondary px-4">Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
