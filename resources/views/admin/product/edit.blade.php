@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">
            Update Product
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/product"> Home </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Update Product </li>
        </ol>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-6">
                                <label for="category_id"> Category </label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="0">Choose Category</option>
                                    @foreach(App\Category::all() as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label for="sub_category_id"> Sub Category </label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control @error('sub_category_id') is-invalid @enderror">
                                    <option value="0">Choose Sub Category</option>
                                    @foreach(App\SubCategory::where('category_id', $product->category_id)->get() as $subCategory)
                                        <option value="{{ $subCategory->id }}" @if($subCategory->id == $product->sub_category_id) selected @endif>{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" aria-describedby="" placeholder="Enter name of product" value="{{ $product->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price ($)</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="" aria-describedby="" placeholder="Enter price of product" value="{{ $product->price }}">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="summernote" aria-describedby="" placeholder="Enter description of product">{!! $product->description !!}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="additional_info">Additional Information</label>
                            <textarea name="additional_info" class="form-control @error('additional_info') is-invalid @enderror" id="summernote1" aria-describedby="" placeholder="Enter additional information for product">{!! $product->additional_info !!}</textarea>
                            @error('additional_info')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-md-9 col-sm-9">
                                <div class="custom-file">
                                    <label for="customFile" class="custom-file-label">Choose File</label>
                                    <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" aria-describedby="">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3" id="displayImage">
                                <img src="{{ Storage::url($product->image) }}" width="100">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('footerContent')
    <script>
        $('#customFile').on('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#displayImage > img').remove();
                    $('#displayImage').html('<img src="'+e.target.result+'" width="50" height="50" style="border:1px solid #f00;" />');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('document').ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var cat_id = $(this).val();

                if(cat_id > 0) {
                    $.ajax({
                        url: "/subcategories/" + cat_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="sub_category_id"]').empty();
                            $('select[name="sub_category_id"]').prop("disabled", false);
                            $.each(data, function(key, value) {
                                $('select[name="sub_category_id"]').append('<option value="'+ key +'">' + value + '</option>');
                            });
                        }
                    })
                } else {
                    $('select[name="sub_category_id"]').empty();
                    $('select[name="sub_category_id"]').prop("disabled", true);
                    $('select[name="sub_category_id"]').append('<option value="0">No sub categories in this category. Choose another category...</option>');
                }
            });
        })
    </script>
@endsection
