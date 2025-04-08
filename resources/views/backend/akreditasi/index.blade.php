@extends('layouts.admin.admin_layout')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>
<a href="{{ route('akreditasi.create') }}" class="btn btn-success btn-icon-split mb-3" id="btn-add-category">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add new file akreditasi</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data file akreditasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="akreditasi-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Content</th>
                        <th class="text-center">File</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d => $val)
                        <tr>
                            <td class="text-center">{{ $d+1 }}</td>
                            <td>{{ $val->content }}</td>
                            <td class="text-center"><a target="_blank" href="{{ url('/media/akreditasi', $val->file) }}">{{ $val->file }}</a></td>
                            <td class="text-center">
                                <a href="{{ route('akreditasi.edit', $val->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" data-id={{ $val->id }} id="btn-delete-akreditasi" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Content</th>
                        <th class="text-center">File</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
{{-- @include('backend.akreditasi.delete_akreditasi') --}}

@push('backend_script')
   
<script>
    $('body').on('click', '#btn-delete-akreditasi', function() {
        let akreditasiId = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr('content');

        Swal.fire({
            title: 'Delete akreditasi?',
            text: "Are you sure you want to delete this akreditasi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) =>{
            if (result.isConfirmed) {
                $.ajax({
                    url: `/administrator/akreditasi/${akreditasiId}`,
                    type: 'DELETE',
                    data: {
                        "_token": token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon:'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 1500
                    })
                        
                        location.reload();
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while deleting the akreditasi.',
                            icon: 'error'
                        })
                    }
                });
            }
        })
    })
</script>
    
@endpush