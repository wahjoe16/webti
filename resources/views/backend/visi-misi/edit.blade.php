@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('visi-misi.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Visi Misi Attributes</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="content"><strong>Content:</strong></label>
                        <textarea class="form-control @error('content') is-invalid @enderror ckeditor" id="content" name="content" rows="7" placeholder="Enter content here...">{{ $data->content }}</textarea>
                        @error('content')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Visi Misi Images</h6>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <label for="image_1"><strong>Primary Image:</strong></label>
                        <input type="file" class="dropify @error('image_1') is-invalid @enderror" id="image_1" name="image_1">
                        @error('image_1')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="image_2"><strong>Other Image:</strong></label>
                        <input type="file" class="dropify @error('image_2') is-invalid @enderror" id="image_2" name="image_2">
                        @error('image_2')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="image_3"><strong>Other Image:</strong></label>
                        <input type="file" class="dropify @error('image_3') is-invalid @enderror" id="image_3" name="image_3">
                        @error('image_3')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
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

        CKEDITOR.replace('#content');
    })

    
</script>

@endpush