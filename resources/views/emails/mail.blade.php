<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($cart->items as $item)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $item['name'] }}</td>
            <td>${{$item['price']}}</td>
            <td>{{$item['quantity']}}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="4"> Total Price: ${{ $cart->totalPrice }}</th>
        </tr>
        <tr>
            <th colspan="4"> Click <a href="{{ route('orders') }}"> here </a> to view all the orders placed.</th>
        </tr>
    </tbody>
</table>
