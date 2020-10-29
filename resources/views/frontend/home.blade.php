@extends('layouts.app')

@section('content')
<div class="container">
    <main role="main">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($sliders as $key => $slider)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($slider->image) }}" class="d-block w-100" height="600px">
                </div>
                @endforeach
            </div>
        </div>
        <h2 class="mt-3"> Categories </h2>
        @foreach(App\Category::all() as $category)
        <a href="{{ route('products.filter',$category->slug) }}"><button class="btn btn-secondary">{{ $category->name }}</button></a>
        @endforeach

        <div class="album py-5 bg-light">
            <div class="container">
                <h2> Products </h2>
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="{{ Storage::url($product->image) }}" height="300">
                            <div class="card-body">
                                <h3> {{ $product->name }} </h3>
                                <p class="card-text">{!! Str::limit($product->description, 120) !!}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/product/{{$product->id}}"><button type="button" class="btn btn-sm btn-outline-primary">View</button></a>
                                        <a href="{{ route('cart.add', $product->id) }}">
                                            <button type="button" class="btn btn-sm btn-outline-danger">Add to cart</button>
                                        </a>
                                    </div>
                                    <small class="text-muted">${{ $product->price }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 text-center">
                <a href="{{ route('products.viewAll') }}"><button class="btn btn-outline-success text-center"> View All Products </button></a>
            </div>
        </div>
        <div class="jumbotron">
            <div id="productCarouselControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            @foreach($randomActiveProducts as $randomProduct)
                            <div class="col-4">
                                <div class="card mb-4 shadow-sm">
                                    <img src="{{ Storage::url($randomProduct->image) }}" height="300">
                                    <div class="card-body">
                                        <h3> {{ $randomProduct->name }} </h3>
                                        <p class="card-text">{!! Str::limit($randomProduct->description, 120) !!}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="/product/{{$randomProduct->id}}"><button type="button" class="btn btn-sm btn-outline-primary">View</button></a>
                                                <a href="{{ route('cart.add', $product->id) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-danger">Add to cart</button>
                                                </a>
                                            </div>
                                            <small class="text-muted">${{ $randomProduct->price }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            @foreach($randomItemProducts as $itemProduct)
                            <div class="col-4">
                                <div class="card mb-4 shadow-sm">
                                    <img src="{{ Storage::url($itemProduct->image) }}" height="300">
                                    <div class="card-body">
                                        <h3> {{ $itemProduct->name }} </h3>
                                        <p class="card-text">{!! Str::limit($itemProduct->description, 120) !!}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="/product/{{$itemProduct->id}}"><button type="button" class="btn btn-sm btn-outline-primary">View</button></a>
                                                <a href="{{ route('cart.add', $product->id) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-danger">Add to cart</button>
                                                </a>
                                            </div>
                                            <small class="text-muted">${{ $itemProduct->price }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#productCarouselControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productCarouselControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </main>
    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a href="/docs/4.5/getting-started/introduction/">getting started guide</a>.</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
    </body>

</div>
@endsection
