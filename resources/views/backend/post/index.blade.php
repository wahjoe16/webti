@extends('layouts.admin.admin_layout')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>
<a href="{{ route('post.create') }}" class="btn btn-success btn-icon-split mb-3" id="btn-add-category">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add new Post</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Posts</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="post-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Title</th>
                        <th class="text-center">Status</th>
                        <th>Featured Image</th>
                        <th>Visibility</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Title</th>
                        <th class="text-center">Status</th>
                        <th>Featured Image</th>
                        <th>Visibility</th>
                        <th>Category</th>
                        <th>Author</th>
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

    </script>

    <script>
    $('body').on('click', '#btn-delete-post', function() {
        let postId = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr('content');

        Swal.fire({
            title: 'Delete Post?',
            text: "Are you sure you want to delete this post?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) =>{
            if (result.isConfirmed) {
                $.ajax({
                    url: `/administrator/post/${postId}`,
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
                            text: 'An error occurred while deleting the post.',
                            icon: 'error'
                        })
                    }
                });
            }
        })
    })
</script>
@endpush