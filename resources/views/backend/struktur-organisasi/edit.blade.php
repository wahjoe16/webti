@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('struktur-organisasi.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">STRUKTUR ORGANISASI ATTRIBUTES</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title"><strong>Title:</strong></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $data->title }}" placeholder="Sample: Struktur Organisasi Program Studi Teknik Industri Periode 2020-2024">
                        @error('title')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">STRUKTUR ORGANISASI DETAIL</h6>
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