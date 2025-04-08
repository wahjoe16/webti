@extends('layouts.admin.admin_layout')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>
<a href="{{ route('labs.create') }}" class="btn btn-success btn-icon-split mb-3" id="btn-add-category">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add new Laboratorium</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Laboratoriums</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="lab-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th class="text-center">Image</th>
                        <th>Kasie Lab</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($labs as $l => $val)
                        <tr>
                            <td class="text-center">{{ $l+1 }}</td>
                            <td>{{ $val->name }}</td>
                            <td class="text-center"><img src="{{ url('/media/labs', $val->image_1) }}" alt="" style="width: 150px; height: auto; border-radius: 5px;"></td>
                            <td>{{ $val->user->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('labs.edit', $val->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" data-id={{ $val->id }} id="btn-delete-lab" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th class="text-center">Image</th>
                        <th>Kasie Lab</th>
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
        /*
        $(document).ready(function() {
            let table;

            table = $('#post-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("post.data") }}',
                },
                columns: [
                    { data: 'DT_RowIndex', className: 'text-center', searchable: false, sortable: false },
                    { data: 'title' },
                    { data: 'status' },
                    { data: 'featured_image', className: 'text-center' },
                    { data: 'visibility' },
                    { data: 'categories.name' },
                    { data: 'user.name' },
                    { data: 'aksi', className: 'text-center', searchable: false, sortable: false }
                ]
            })
        })
        */
    </script>

    <script>
    $('body').on('click', '#btn-delete-lab', function() {
        let labId = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr('content');

        Swal.fire({
            title: 'Delete Lab?',
            text: "Are you sure you want to delete this lab?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) =>{
            if (result.isConfirmed) {
                $.ajax({
                    url: `/administrator/labs/${labId}`,
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
                            text: 'An error occurred while deleting the lab.',
                            icon: 'error'
                        })
                    }
                });
            }
        })
    })
</script>
@endpush