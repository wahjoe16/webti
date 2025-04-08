@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">BANNER ATTRIBUTES</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="caption"><strong>Caption:</strong></label>
                        <textarea class="form-control @error('caption') is-invalid @enderror" id="caption" name="caption" rows="7" placeholder="Enter banner caption here..."></textarea>
                        @error('caption')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link"><strong>Link:</strong></label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="Enter banner link">
                        @error('link')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">PRIMARY IMAGE</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="file" class="dropify @error('image_1') is-invalid @enderror" id="image_1" name="image_1">
                        @error('image_1')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">OTHER IMAGE</h6>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <input type="file" class="dropify" id="image_2" name="image_2">
                    </div>
                    <div class="form-group mb-3">
                        <input type="file" class="dropify" id="image_3" name="image_3">
                    </div>
                    <div class="form-group mb-3">
                        <input type="file" class="dropify" id="image_4" name="image_4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-md" id="save">Save</button>
    </div>
</form>

@endsection

@push('backend_script')

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    // Initialize Dropify plugin for image upload
    $(function() {
        $('.dropify').dropify();
    })
</script>

@endpush