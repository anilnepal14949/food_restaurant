@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="row">
            <aside class="col-sm-5 border-right">
                <section class="gallary-wrap">
                    <div class="img-big-wrap">
                        <a href="#">
                            <img src="{{ Storage::url($product->image) }}" width="100%">
                        </a>
                    </div>
                </section>
            </aside>
            <aside class="col-sm-7">
                <section class="card-body p-5">
                    <h3 class="title mb-3">{{ $product->name }}</h3>
                    <p class="price-detail-wrap">
                        <span class="price h4 text-danger">
                            ${{ $product->price }}
                        </span>
                    </p>
                    <h4>
                        Description:
                    </h4>
                    <p>{!! $product->description !!}</p>
                    <h4>
                        Additional Information:
                    </h4>
                    <p>{!! $product->additional_info !!}</p>
                    <hr>
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-outline-danger text-uppercase"> Add to Cart </a>
                </section>
            </aside>
        </div>
        @if(count($similarProducts) > 0)
        <div class="jumbotron">
            <h3> You may also like: </h3>
            <hr>
            <div class="row">
                @foreach($similarProducts as $product)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{ Storage::url($product->image) }}" height="300">
                        <div class="card-body">
                            <h3> {{ $product->name }} </h3>
                            <p class="card-text">{!! Str::limit($product->description, 120) !!}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <button type="button" class="btn btn-sm btn-outline-primary">View</button>
                                    </a>
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
        @endif
    </div>
</div>
@endsection
