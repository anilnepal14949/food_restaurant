@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @endforeach
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</td>
                <th scope="col">Product</td>
                <th scope="col">Price</td>
                <th scope="col">Quantity</td>
                <th scope="col">Total Amount</td>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
            @if(session()->has('cart'))
            @php $i = 1; @endphp
            @foreach($cart->items as $item)
            <tr>
                <th scope="row">{{ $i++ }}</th>
                <td><img src="{{ Storage::url($item['image']) }}" width="100"></td>
                <td>{{ $item['name'] }}</td>
                <td>${{ $item['price'] }}</td>
                <td>
                    <form action="{{ route('cart.update', $item['id']) }}" method="post">
                        @csrf
                        <input type="text" name="quantity" id="quantity" value="{{ $item['quantity'] }}">
                        <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-sync"></i> Update </button>
                    </form>
                </td>
                <td>${{ $item['price'] * $item['quantity'] }}</td>
                <td>
                    <form action="{{ route('cart.remove', $item['id']) }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger">Remove</button></a>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="text-center">
                <th colspan="7"> No items in the cart. <a href="/"><button class="btn btn-sm btn-outline-primary"> Continue Shopping </button></a></th>
            </tr>
            @endif
        </tbody>
    </table>
    <hr>
    @if(session()->has('cart'))
    <div class="card-footer">
        <a href="/"><button class="btn btn-primary">Continue Shopping</button></a>
        <span style="margin-left:300px;"><strong> Total Price: ${{ $cart->totalPrice }} </strong></span>
        <a href="{{ route('cart.checkout', $cart->totalPrice) }}"><button class="btn btn-dark float-right">Checkout</button></a>
    </div>
    @endif
</div>
@endsection
