@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('features.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">FEATURE ATTRIBUTES</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>Description:</strong></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="7" placeholder="Description here..."></textarea>
                        @error('description')
                            <div class="alert alert-danger mt-2">{{ $description }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link"><strong>Link:</strong></label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="Enter Link">
                        @error('link')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">FEATURE DETAIL</h6>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <label for="image"><strong>Image:</strong></label>
                        <input type="file" class="dropify @error('image') is-invalid @enderror" id="image" name="image" onchange="readUrl(this);">
                        @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-md" id="publish">Save</button>
    </div>
</form>

@endsection

@push('backend_script')

<script>

    $(function() {
        $('.dropify').dropify();
    })

</script>

@endpush