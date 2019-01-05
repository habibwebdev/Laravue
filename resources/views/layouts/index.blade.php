<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('extra-css')
    <link rel="stylesheet" href="/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/stripe.css">
    <script src="/js/jquery.min.js"></script>
    <title>Laravel Ecommerce | @yield('title')</title>
    @yield('stripe')
    {{-- @yield('extra-css') --}}
</head>

<body>
    @yield('content')

    <section id="footer" class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-light">
                    <p class="m-0">Created By: Abbas Ali</p>
                </div>
                {{-- @include('partials.footer-nav') --}}
                {{ menu('Footer', 'partials.social') }}
            </div>
        </div>
    </section>

    @yield('extra-js')


    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    {{-- <script src="/js/stripe.js"></script> --}}
</body>

</html>
