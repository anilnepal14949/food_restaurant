@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">
            Update Sub Category
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/sub-category"> Home </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Update Sub Category </li>
        </ol>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="{{ route('sub-category.update', $subCategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" aria-describedby="" placeholder="Enter name of category" value="{{ $subCategory->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id"> Category </label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="0">Choose Category</option>
                                @foreach(App\Category::all() as $category)
                                    <option value="{{ $category->id }}" @if($subCategory->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
