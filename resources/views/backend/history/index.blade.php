@extends('layouts.admin.admin_layout')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>
<a href="{{ route('histories.create') }}" class="btn btn-success btn-icon-split mb-3" id="btn-add-category">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add new History</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Histories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="history-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Content</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d => $val)
                        <tr>
                            <td class="text-center">{{ $d+1 }}</td>
                            <td>{{ $val->content }}</td>
                            <td class="text-center"><img src="{{ url('/media/histories', $val->image_1) }}" alt="" style="width: 150px; height: auto; border-radius: 5px;"></td>
                            <td class="text-center">
                                <a href="{{ route('histories.edit', $val->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" data-id={{ $val->id }} id="btn-delete-history" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Content</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
{{-- @include('backend.history.delete_history') --}}

@push('backend_script')
   
<script>
    $('body').on('click', '#btn-delete-history', function() {
        let historyId = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr('content');

        Swal.fire({
            title: 'Delete History?',
            text: "Are you sure you want to delete this history?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) =>{
            if (result.isConfirmed) {
                $.ajax({
                    url: `/administrator/histories/${historyId}`,
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
                            text: 'An error occurred while deleting the history.',
                            icon: 'error'
                        })
                    }
                });
            }
        })
    })
</script>
    
@endpush