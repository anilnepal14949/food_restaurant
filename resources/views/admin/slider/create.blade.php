@extends('admin.layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">
        Create Slider
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="./"> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"> Create Slider </li>
    </ol>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-6">
                <div class="card-body">
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
                            <!-- <strong> Preview: </strong> -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
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
            reader.onload = function(e) {
                $('#displayImage > img').remove();
                $('#displayImage').html('<img src="' + e.target.result + '" width="50" height="50" style="border: 1px solid #f00;"/>');
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
