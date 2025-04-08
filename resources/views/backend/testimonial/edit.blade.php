@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">TESTIMONI ATTRIBUTES</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $testimonial->name }}" placeholder="Enter name">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jurusan_angkatan"><strong>Program Studi & Angkatan:</strong></label>
                        <input type="text" class="form-control @error('jurusan_angkatan') is-invalid @enderror" id="jurusan_angkatan" name="jurusan_angkatan" value="{{ $testimonial->jurusan_angkatan }}" placeholder="Example: Teknik Industri - 1990">
                        @error('jurusan_angkatan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content"><strong>Testimonial:</strong></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="7" placeholder="Testimonial here...">{{ $testimonial->content }}</textarea>
                        @error('content')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">JOB INFORMATION</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="position"><strong>Position:</strong></label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ $testimonial->position }}" placeholder="Example: Manager Keuangan">
                        @error('position')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="company"><strong>Company:</strong></label>
                        <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ $testimonial->company }}" placeholder="Enter company">
                        @error('company')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">TESTIMONI DETAIL</h6>
                </div>
                <div class="card-body">
                    
                    <div class="form-group mb-5">
                        <label for="photo"><strong>Photo:</strong></label>
                        <input type="file" class="dropify @error('photo') is-invalid @enderror" id="photo" name="photo" onchange="readUrl(this);">
                        @error('photo')
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