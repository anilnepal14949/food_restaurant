@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('products.viewAll') }}" method="GET">
        @csrf
        <div class="form-row mb-3">
            <div class="col-md-10">
                <input class="form-control" type="text" name="search" id="search" placeholder="Search items here..." value="{{ $search }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-secondary btn-block"> Search </button>
            </div>
        </div>
    </form>
    <h2> All Products </h2>
    <hr>
    @if(count($products) > 0)
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
    {{ $products->links() }}
    @else
    <div class="jumbotron col-md-12 text-center">
        <h3> No products found. Search Again...</h3>
    </div>
    @endif
</div>
@endsection
