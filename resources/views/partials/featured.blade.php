<div class="container">
    <div class="row">
        <div class="col-sm-12 pt-4 text-center">
            <h1 class="pb-5 text-center">Laravel Ecommerce</h1>
            <p class="text-secondary text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo quidem sit illum! Nisi blanditiis, mollitia saepe
                ullam, libero deleniti nemo. Bconsectetur adipisicing elit. Quo quidem sit illum! Nisi blanditiis, mollitia
                saepe ullam, libero deleniti nemo. Quo quidem sit illum! Nisi blanditiis, mollitia saepe ullam, libero deleniti
                nemo.</p>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-sm-12">
            <ul class="nav nav-pills mb-3 justify-content-center pt-4" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="cat nav-link active" id="pills-featured-tab" data-toggle="pill" href="#pills-featured" role="tab" aria-controls="pills-featured"
                        aria-selected="true">Featured</a>
                </li>
                <li class="nav-item">
                    <a class="cat nav-link" id="pills-onsale-tab" data-toggle="pill" href="#pills-onsale" role="tab" aria-controls="pills-onsale"
                        aria-selected="false">On Sale</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-featured" role="tabpanel" aria-labelledby="pills-featured-tab">
                    <!-- <h2 class="text-center">Featured Products</h2> -->
                    <div class="row py-5">
                        @foreach($products as $product)

                                <div class="col-sm-3">

                                    <a href=""><img src="img/macbook-pro.png" class="img-fluid"></a>
                                    <a href="">{{$product->name}}</a>
                                    <p>{{$product->price}}</p>
                                </div>

                        @endforeach
                    </div>

                    <div class="row py-5">
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="row py-5">
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-onsale" role="tabpanel" aria-labelledby="pills-onsale-tab">
                    <!-- <h2 class="text-center">On Sale Products</h2> -->

                    <div class="row py-5">
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="row py-5">
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <img src="img/macbook-pro.png" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-sm-12 text-center">
            <a href="{{url('products')}}" class="btn btn-outline-secondary">View More Products</a>
        </div>
    </div>
</div>
