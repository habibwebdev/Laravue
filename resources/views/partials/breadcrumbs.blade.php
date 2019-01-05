<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </div>

                <div class="col-sm-4">
                    @include('partials.search')
                </div>
            </div>

        </div>
    </ol>
</nav>
