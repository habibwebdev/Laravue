@extends('layouts.index')

@section('title', 'Search Results Algolia')

@section('extra-css')
    {{-- <link rel="stylesheet" href="{{ asset('css/instantsearch-theme-algolia.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/instantsearch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/instantsearch-theme-algolia.min.css') }}">
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
                        {{-- <li class="breadcrumb-item"><a href="{{url('shop')}}">Shop</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                    </div>
                    <div class="col-sm-4">
                        {{-- custom search --}}
                        {{-- @include('partials.search') --}}
                        {{-- composer require nicolaslopezj/searchable package for more advanced search after completing manual search --}}
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

    <section id="item" class="py-2 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mh-500">
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
                    <section id="instant-algolia">
                        <div class="row">
                            <div class="col-sm-4">
                                <h5 class="display-5 mb-2">Search</h5>
                                <div class="s-input">
                                    <input id="search-input" placeholder="Search for products">
                                    <!-- We use a specific placeholder in the input to guides users in their search. -->
                                </div>

                                <div id="stats-container" class="mb-4"></div>

                                <h5 class="display-5 mb-4">Categories</h5>
                                <div id="refinement-list"></div>
                            </div>
                            <div class="col-sm-8">
                                {{-- <h5 class="display-5 mb-2">Search Results</h5> --}}
                                <div id="hits"></div>
                                <div id="pagination"></div>
                            </div>
                        </div>
                    </section>


                    {{-- <p class="mb-3 text-primary">{{ $products->total() }} result(s) for '{{ request()->input('query') }}'</p> --}}
                    {{-- <input id="search-input" placeholder="Search for products"> --}}
                    {{-- <div id="search-box" class="col-sm-4 pl-0">
                        <input id="search-input" placeholder="Search for products" class="form-control pl-4">
                    </div> --}}
                    {{-- <div id="search-box" class="">

                    </div> --}}








                </div>
            </div>
        </div>
    </section>
@endsection
    {{-- <section id="mightlike" class="py-5 bg-light">
        @include('partials.mightlike')
    </section> --}}

    @section('extra-js')
        <script src="{{ asset('js/algoliasearch.min.js') }}"></script>
        <script src="{{ asset('js/autocomplete.min.js') }}"></script>
        <script src="{{ asset('js/algolia.js') }}"></script>
        <script src="{{ asset('js/instantsearch.min.js') }}"></script>
        <script src="{{ asset('js/algolia-instantsearch.js') }}"></script>
    @stop
