@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('greetings.update', $greeting->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">SAMBUTAN KAPRODI ATTRIBUTES</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $greeting->name }}" placeholder="Enter name">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message"><strong>Message:</strong></label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="7" placeholder="Message here...">{{ $greeting->message }}</textarea>
                        @error('message')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link"><strong>Link:</strong></label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ $greeting->link }}" placeholder="Enter Link">
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
                    <h6 class="m-0 font-weight-bold text-primary">SAMBUTAN KAPRODI DETAIL</h6>
                </div>
                <div class="card-body">
                    
                    <div class="form-group mb-5">
                        <label for="photo"><strong>Photo:</strong></label>
                        <input type="file" class="dropify @error('photo') is-invalid @enderror" id="photo" name="photo" data-default-file="{{ url('/media/greeting/', $greeting->photo) }}">
                        <input type="hidden" name="current_photo" id="current_photo" value="{{ $greeting->photo }}">
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