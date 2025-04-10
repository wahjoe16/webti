@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('dosen.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">LECTURE ATTRIBUTES</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $data->name }}" placeholder="Enter lecture name">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nik"><strong>NIK:</strong></label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $data->nik }}" placeholder="Enter lecture NIK">
                        @error('nik')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $data->email }}" placeholder="Enter lecture email">
                        @error('email')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_urut"><strong>Nomor Urut:</strong></label>
                        <input type="number" class="form-control @error('no_urut') is-invalid @enderror" id="no_urut" name="no_urut" value="{{ $data->detail_dosen->no_urut }}" placeholder="Nomor Urut">
                        @error('no_urut')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">EXPERTISE</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="kelompok_keahlian_id"><strong>Kelompok Keahlian:</strong></label>
                        <select name="kelompok_keahlian_id" id="kelompok_keahlian_id" class="form-control @error('kelompok_keahlian_id') is-invalid @enderror">
                            <option value="">Select</option>
                            @foreach($kel as $k)
                            <option value="{{ $k->id }}" @if (!empty($k->id == $data->detail_dosen->kelompok_keahlian_id)) selected @endif>{{ $k->nama_kelompok }}</option>
                            @endforeach
                        </select>
                        @error('kelompok_keahlian_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fungsional"><strong>Fungsional:</strong></label>
                        <select name="fungsional" id="fungsional" class="form-control @error('fungsional') is-invalid @enderror">
                            <option value="">Select</option>
                            @foreach ([
                                "Tenaga Pengajar" => "Tenaga Pengajar",
                                "Asisten Ahli" => "Asisten Ahli",
                                "Lektor" => "Lektor",
                                "Lektor Kepala" => "Lektor Kepala",
                                "Guru Besar" => "Guru Besar/Professor"
                            ] as $fungsional => $fungsionalLabel)
                            <option value="{{$fungsional}}" {{ old('fungsional', $data->detail_dosen->fungsional) == $fungsional ? "selected" : "" }}>{{ $fungsionalLabel }}</option>
                            @endforeach
                        </select>
                        @error('fungsional')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link"><strong>Link:</strong></label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ $data->detail_dosen->link }}" placeholder="Enter lecture link">
                        @error('link')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jabatan"><strong>Position:</strong></label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ $data->detail_dosen->jabatan }}" placeholder="Enter lecture position">
                        @error('jabatan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">LECTURE DETAIL</h6>
                </div>
                <div class="card-body">
                    
                    <div class="form-group mb-5">
                        <label for="profile_photo_path"><strong>Photo:</strong></label>
                        <input type="file" class="dropify @error('profile_photo_path') is-invalid @enderror" id="profile_photo_path" name="profile_photo_path" onchange="readUrl(this);">
                        @error('profile_photo_path')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group mb-5">
                        <label for="title"><strong>Tags:</strong></label>
                        <input type="text" name="tags" class="form-control">
                    </div> --}}

                    <div class="form-group mb-5">
                        <label for="pendidikan"><strong>Qualification:</strong></label>
                        <select name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                            <option value="">Select</option>
                            @foreach ([
                                "S2" => "S2",
                                "S3" => "S3"
                            ] as $pendidikan => $pendidikanLabel)
                            <option value="{{ $pendidikan }}" {{ old('pendidikan', $data->detail_dosen->pendidikan) == $pendidikan ? "selected" : "" }}>{{ $pendidikanLabel }}</option>
                            @endforeach
                        </select>
                        @error('pendidikan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-md" id="publish">Update</button>
    </div>
</form>

@endsection

@push('backend_script')

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('#content');
</script>

<script>

    $(function() {
        $('.dropify').dropify();
    })

    /*
    // store POST to DB
    $('#publish').on('click', function(e){
        e.preventDefault();
        
        // define var
        let title = $('#title').val();
        let content = $('#content').val();
        let meta_description = $('#meta_keywords').val();
        let meta_desc = $('#meta_desc').val();
        let category_id = $('#category_id').val();
        let featured_image = $('#featured_image')[0].files[0];
        let visibility = $('input[name=visibility]:checked').val();
        let status = $('input[name=status]:checked').val();
        let token = $("meta[name='csrf-token']").attr('content');

        // ajax request
        $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: {
                title: title,
                content: content,
                meta_keywords: meta_keywords,
                meta_desc: meta_desc,
                category_id: category_id,
                featured_image: featured_image,
                visibility: visibility,
                status: status,
                _token: token
            },
            contentType: false,
            processData: false,
            success: function(response){
                // console.log(response);
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
            },
            error: function(error){
                // console.log(error);
                if (error.responseJSON.title[0]) {
                    // menampilkan alert
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');

                    // add message to alert
                    $('#alert-title').html(error.responseJSON.title[0]);
                }
            }
        })

    })
    */
</script>

@endpush