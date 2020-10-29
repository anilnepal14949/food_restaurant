@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">
            Create Sub Category
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="./"> Home </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Create Sub Category </li>
        </ol>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="{{ route('sub-category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" aria-describedby="" placeholder="Enter name of category">
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
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
