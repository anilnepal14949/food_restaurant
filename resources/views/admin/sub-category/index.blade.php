@extends('admin.layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">
        All Sub Categories
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="./"> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"> All Sub Categories </li>
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
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if(count($subCategories) > 0)
                        @foreach($subCategories as $key => $subCategory)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $subCategory->name }}</td>
                            <td>{{ $subCategory->category->name }}</td>
                            <td>
                                <a href="{{ route('sub-category.edit',$subCategory->id) }}">
                                    <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                                </a>
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{$subCategory->id}}">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </button>
                                <div class="modal fade" id="deleteModal{{$subCategory->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form action="{{ route('sub-category.destroy',[$subCategory->id]) }}" method="post">
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
                                                    Are you sure to delete this sub category?
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
                        <td colspan="4" class="text-center"> No sub category to display... Add sub category first. <br><a href="{{ route('sub-category.create') }}" class="btn btn-outline-info"> Create Sub Category </a></td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
