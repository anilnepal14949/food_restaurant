@extends('admin.layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">
        All Products
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="./"> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"> All Products </li>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($products) > 0)
                    @foreach($products as $key => $product)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ Storage::url($product->image) }}" width="100"></td>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subCategory->name }}</td>
                        <td>
                            <a href="{{ route('product.edit',$product->id) }}">
                                <button class="btn btn-info" data-trigger="hover" data-placement="left" data-toggle="popover" data-content="Edit this product.."><i class="fa fa-edit"></i> Edit</button>
                            </a>
                            <span data-trigger="hover" data-placement="left" data-toggle="popover" data-content="Delete this product..">
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{$product->id}}">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </button>
                            </span>
                            <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('product.destroy',[$product->id]) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to delete this product?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td colspan="7" class="text-center"> No product to display... Add product first. <br><a href="{{ route('product.create') }}" class="btn btn-outline-info"> Create product </a></td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
