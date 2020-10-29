@extends('admin.layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">
        All Users
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="./"> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"> All Users </li>
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
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($users->count() > 0)
                    @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="@if($user->orders->count() > 0) {{ route('users.view.orders', $user->id) }} @else # @endif">
                                <button class="btn btn-primary" data-trigger="hover" data-placement="left" data-toggle="popover" @if($user->orders->count() <= 0) data-content="No orders yet!" @else data-content="Click to view orders" @endif>View Orders</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td colspan="5" class="text-center"> No user to display... Add user first. <br><a href="{{ url('/register') }}" class="btn btn-outline-info"> Create user </a></td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
