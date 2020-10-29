@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('cart.charge') }}" method="post" id="payment-form">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Checkout Details</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control" required="" placeholder="Enter name.." readonly value="{{ auth()->user()->name }}">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" id="address" class="form-control" required="" autofocus placeholder="Enter address..">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" id="city" class="form-control" required="" placeholder="Enter city..">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="state" id="state" class="form-control" required="" placeholder="Enter state..">
                        </div>
                        <div class="form-group">
                            <label>Postal code</label>
                            <input type="text" name="postalcode" id="postalcode" class="form-control" required="" placeholder="Enter postcode..">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</td>
                            <th scope="col">Product</td>
                            <th scope="col">Price</td>
                            <th scope="col">Quantity</td>
                            <th scope="col">Total Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session()->has('cart'))
                        @php $i = 1; @endphp
                        @foreach($cart->items as $item)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td><img src="{{ Storage::url($item['image']) }}" width="50"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ $item['price'] }}</td>
                            <td>
                                {{ $item['quantity'] }}
                            </td>
                            <td>${{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                        @endforeach
                        <tr class="text-right">
                            <th colspan="6">Total Price: ${{ $cart->totalPrice }}</th>
                        </tr>
                        @else
                        <tr class="text-center">
                            <th colspan="7"> No items in the cart. <a href="/"><button class="btn btn-sm btn-outline-primary"> Continue Shopping </button></a></th>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                    <div class="card">
                        <div class="card-header">Payment Options</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="card-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <input type="hidden" name="amount" value="{{$amount}}">
                        <button class="btn btn-primary mt-3">Submit Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
