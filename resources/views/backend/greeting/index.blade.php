@extends('layouts.admin.admin_layout')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>
<a href="{{ route('greetings.create') }}" class="btn btn-success btn-icon-split mb-3" id="btn-add-dosen">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add new sambutan</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data sambutan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="testi-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th width="20%" class="text-center">Photo</th>
                        <th>Name</th>
                        <th width="30%">Message</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d => $value)
                    <tr>
                        <td class="text-center">{{$d+1}}</td>
                        <td width="20%" class="text-center">
                            @if($value->photo)
                            <img src="{{ url('/media/greeting', $value->photo) }}" class="img-fluid rounded" style="width: 150px; height: auto;">
                            @else
                            <img src="{{ asset('storage/images/default.png') }}" class="img-fluid rounded" style="width: 70px; height: 70px;">
                            @endif
                        </td>
                        <td>{{$value->name}}</td>
                        <td width="30%">{{$value->message}}</td>
                        <td class="text-center">
                            <a href="{{ route('greetings.edit', $value->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" data-id={{ $value->id }} id="btn-delete-greeting" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                        </td> 
                    </tr>
                        
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <th width="20%" class="text-center">Photo</th>
                        <th>Name</th>
                        <th width="30%">Message</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
{{-- @include('backend.post.delete_post') --}}

@push('backend_script')
    
    <script>
    $('body').on('click', '#btn-delete-greeting', function() {
        let greetId = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr('content');

        Swal.fire({
            title: 'Delete sambutan kaprodi?',
            text: "Are you sure you want to delete this sambutan kaprodi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) =>{
            if (result.isConfirmed) {
                $.ajax({
                    url: `/administrator/greetings/${greetId}`,
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
                            text: 'An error occurred while deleting the sambutan kaprodi.',
                            icon: 'error'
                        })
                    }
                });
            }
        })
    })
</script>
@endpush