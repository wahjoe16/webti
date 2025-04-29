@extends('layouts.admin.admin_layout')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>

<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">POST CONTENT</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title"><strong>Title:</strong></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter post title">
                        @error('title')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content"><strong>Content:</strong></label>
                        <textarea class="form-control @error('content') is-invalid @enderror ckeditor" id="content" name="content" rows="7" placeholder="Enter post content here..."></textarea>
                        @error('content')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">SEO</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="meta_keywords"><strong>Post meta keywords:</strong><small>(Separated by comma.)</small></label>
                        <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" placeholder="Enter post meta keywords">
                        @error('meta_keywords')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_desc"><strong>Post meta description:</strong></label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_desc" name="meta_description" rows="7" placeholder="Enter post meta description"></textarea>
                        @error('meta_description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">POST DETAIL</h6>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <label for="title"><strong>Post Category:</strong></label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach($category as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <a href="javascript:void(0)" class="btn btn-success btn-icon-split mt-3" id="btn-add-category">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Category</span>
                        </a>
                    </div>
                    <div class="form-group mb-5">
                        <label for="post_date"><strong>Post Date:</strong></label>
                        <input type="text" name="post_date" id="post_date" class="form-control @error('post_date') is-invalid @enderror">
                        @error('post_date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="featured_image"><strong>Featured Image:</strong></label>
                        <input type="file" class="dropify @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image">
                        @error('featured_image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group mb-5">
                        <label for="title"><strong>Tags:</strong></label>
                        <input type="text" name="tags" class="form-control">
                    </div> --}}

                    <div class="form-group mb-5">
                        <label for="title"><strong>Visibility:</strong></label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="visibility" class="custom-control-input @error('visibility') is-invalid @enderror" value="1">
                            <label class="custom-control-label" for="customRadio1">Public</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="visibility" class="custom-control-input @error('visibility') is-invalid @enderror" value="0">
                            <label class="custom-control-label" for="customRadio2">Private</label>
                        </div>
                        @error('visibility')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="title"><strong>Status:</strong></label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio3" name="status" class="custom-control-input @error('status') is-invalid @enderror" value="draft">
                            <label class="custom-control-label" for="customRadio3">Draft</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio4" name="status" class="custom-control-input @error('status') is-invalid @enderror" value="publish">
                            <label class="custom-control-label" for="customRadio4">Publish</label>
                        </div>
                        @error('status')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-md" id="publish">Publish</button>
    </div>
</form>

@include('backend.post.components.modal-create')

@endsection

@push('backend_script')

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('#content');
</script>

<script>
    $('#post_date').datepicker();
</script>

<script>
    $(function() {
        $('.dropify').dropify();
    })
</script>

<script>
    // event untuk modal pop up
    $('body').on('click', '#btn-add-category', function(){
        // buka modal
        $('#modal-create').modal('show');
    })

    // event ketika save button
    $('#store').click(function(e){
        let name = $('#name').val();
        let token = $("meta[name='csrf-token']").attr('content');

        // ajax request
        $.ajax({
            url: '/administrator/category',
            type: 'POST',
            data: {
                'name': name,
                '_token': token
            },
            success: function(response){
                // tampilkan sweet alert sukses message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                // reload page after success
                location.reload();

                // clear form
                $('#name').val('');

                // close modal
                $('#modal-create').modal('hide');
            },
            error: function(error){
                if (error.responseJSON.name[0]){
                    // show alert
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');

                    // add message to alert
                    $('#alert-name').html(error.responseJSON.name[0]);
                }
            }
        })
    }) 
</script>


<script>
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