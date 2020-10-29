@extends('admin.layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">
        All orders
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="./"> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"> All orders </li>
    </ol>
</div>
<!-- Datatables -->
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>View</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($orders->count() > 0)
                    @foreach($orders as $key => $order)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>{{ date('d-M-Y', strtotime($order->created_at)) }}</td>
                        <td>
                            <a href="{{ route('users.view.order', $order->id) }}">
                                <button class="btn btn-primary">
                                    View Order
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td colspan="5" class="text-center"> No order to display... Add order first. <br><a href="{{ url('/') }}" class="btn btn-outline-info"> Continue Shopping </a></td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
