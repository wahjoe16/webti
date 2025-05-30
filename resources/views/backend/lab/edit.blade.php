@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('labs.update', $lab->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Lab Attributes</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $lab->name }}" placeholder="Enter Labs Name">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location"><strong>Location:</strong></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ $lab->location }}" placeholder="Enter Labs Location">
                        @error('location')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>Description:</strong></label>
                        <textarea class="form-control @error('description') is-invalid @enderror ckeditor" id="description" name="description" rows="7" placeholder="Enter Lab Description here...">{{ $lab->description }}</textarea>
                        @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Lab Images</h6>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <label for="image_1"><strong>Primary Image:</strong></label>
                        <input type="file" class="dropify @error('image_1') is-invalid @enderror" id="image_1" name="image_1" data-default-file="{{ url('media/labs', $lab->image_1) }}">
                        @error('image_1')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="current_image_1" id="current_image_1" value="{{ $lab->image_1 }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_desc"><strong>Other Image:</strong></label>
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="file" class="dropify" id="image_2" name="image_2" data-default-file="{{ url('media/labs', $lab->image_2) }}">
                                <input type="hidden" name="current_image_2" id="current_image_2" value="{{ $lab->image_2 }}">
                            </div>
                            <div class="col-lg-3">
                                <input type="file" class="dropify" id="image_3" name="image_3" data-default-file="{{ url('media/labs', $lab->image_3) }}">
                                <input type="hidden" name="current_image_3" id="current_image_3" value="{{ $lab->image_3 }}">
                            </div>
                            <div class="col-lg-3">
                                <input type="file" class="dropify" id="image_4" name="image_4" data-default-file="{{ url('media/labs', $lab->image_4) }}">
                                <input type="hidden" name="current_image_4" id="current_image_4" value="{{ $lab->image_4 }}">
                            </div>
                            <div class="col-lg-3">
                                <input type="file" class="dropify" id="image_5" name="image_5" data-default-file="{{ url('media/labs', $lab->image_5) }}">
                                <input type="hidden" name="current_image_5" id="current_image_5" value="{{ $lab->image_5 }}">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Lab DETAIL</h6>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <label for="title"><strong>Kasie Lab:</strong></label>
                        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            <option value="">Select Kasie Lab</option>
                            @foreach($kasie as $k)
                            <option value="{{ $k->id }}" @if(!empty($k->id == $lab->user_id)) selected @endif>{{ $k->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-md" id="save">Update</button>
    </div>
</form>

@endsection

@push('backend_script')

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    // Initialize Dropify plugin for image upload
    $(function() {
        $('.dropify').dropify();

        CKEDITOR.replace('#description');
    })  
</script>

@endpush