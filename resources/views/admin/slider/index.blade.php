@extends('admin.layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">
        All Sliders
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="./"> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"> All Sliders </li>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SN</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($sliders->count() > 0)
                    @foreach($sliders as $key => $slider)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ Storage::url($slider->image) }}" width="200"></td>
                        <td>
                            <span data-trigger="hover" data-placement="left" data-toggle="popover" data-content="Click to delete!">
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{$slider->id}}">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </button>
                            </span>
                            <div class="modal fade" id="deleteModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('slider.destroy',[$slider->id]) }}" method="post">
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
                                                Are you sure to delete this slider?
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
                    <td colspan="5" class="text-center"> No slider to display... Add slider first. <br><a href="{{ route('slider.create') }}" class="btn btn-outline-info"> Create Slider </a></td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
