@extends('admin.layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">
        All orders
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/auth/users"> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"> All orders </li>
    </ol>
</div>
<div class="col-lg-12">
    <div class="row">
        @foreach($carts as $cart)
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    @foreach($cart->items as $item)
                    <span class="float-right">
                        <img src="{{ Storage::url($item['image']) }}" width="100">
                    </span>
                    <p>Name: {{ $item['name'] }}</p>
                    <p>Price: ${{ $item['price'] }}</p>
                    <p>Quantity: {{ $item['quantity'] }}</p>
                    @if(count($cart->items) > 1)
                    <hr> @endif
                    @endforeach
                </div>
            </div>
            <p>
                <button class="btn btn-success">
                    <span class="badge badge-light">Total Price: ${{ $cart->totalPrice }}</span>
                </button>
            </p>
        </div>
        @endforeach
    </div>
</div>

@endsection
