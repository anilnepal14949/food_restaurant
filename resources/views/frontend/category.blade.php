@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $category->name }}</h2>
    <div class="row">
        <div class="col-md-2">
            <form action="{{ route('products.filter', $category->slug) }}" method="GET">
                @foreach($subCategories as $subCategory)
                @php $foundProducts = App\Product::where('sub_Category_id', $subCategory->id)->get(); @endphp
                @if(count($foundProducts) > 0)
                <p>
                    <input type="checkbox" name="subcategory[]" id="" value="{{ $subCategory->id }}" @if(isset($filterIds)) {{ in_array($subCategory->id, $filterIds) ? 'checked' : '' }} @endif> {{ $subCategory->name }}
                </p>
                @endif
                @endforeach
                <input type="submit" value="Filter" class="btn btn-secondary">
            </form>
            <hr>
            <h3>Filter by price:</h3>
            <form action="{{ route('products.filter', $category->slug) }}" method="GET">
                <input type="number" name="min" class="form-control" placeholder="Minimum Price" required>
                <input type="number" name="max" class="form-control" placeholder="Maximum Price" required>
                <input type="hidden" name="category_id" value="{{$category->id}}">
                <br>
                <input type="submit" value="Filter" class="btn btn-secondary">
            </form>
            <hr>
            <a href="{{ route('products.filter', $category->slug) }}"> Reset Filter </a>
        </div>
        @if(count($products) > 0)
        <div class="col-md-10">
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{ Storage::url($product->image) }}" height="200" style="width:100%">
                        <div class="card-body">
                            <p><b>{{ $product->name }}</b></p>
                            <p class="card-text">
                                {!! $product->description !!}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <button class="btn btn-sm btn-outline-primary">
                                            View
                                        </button>
                                    </a>
                                    <a href="{{ route('cart.add', $product->id) }}">
                                        <button class="btn btn-sm btn-outline-danger">
                                            Add to Cart
                                        </button>
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
        @else
        <div class="col-md-10">
            <div class="jumbotron">
                <h3 class="text-center">No products found!</h3>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
