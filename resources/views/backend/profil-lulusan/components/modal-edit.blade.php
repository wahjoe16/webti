<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="cat_id">

                <div class="form-group">
                    <label for="edit-title" class="control-label"><strong>Title</strong></label>
                    <input type="text" class="form-control" id="edit-title" placeholder="Sample: Production Planner">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-title"></div>
                </div>

                <div class="form-group">
                    <label for="edit-description" class="control-label"><strong>Description</strong></label>
                    <textarea name="edit-description" id="edit-description" class="form-control" cols="30" rows="10"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-description"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').on('click','#btn-edit-profil-lulusan', function(){

        // Get the data-id attribute of the clicked row
        let profil_id = $(this).data('id');

        // Fetch the category data from the server using AJAX
        $.ajax({
            url: `/administrator/profil-lulusan/${profil_id}`,
            type: 'GET',
            cache: false,
            success: function(response){
                // fill data to form
                $('#edit-title').val(response.data.title);
                $('#edit-description').val(response.data.description);

                // show modal
                $('#modal-edit').modal('show');
            },
            error: function(error){
                alert('tidak bisa menampilkan data');
            }
        })

        $('#update').click(function(e){
            e.preventDefault();
            
            let title = $('#edit-title').val();
            let description = $('#edit-description').val();
            let token = $("meta[name='csrf-token']").attr("content");

            // ajax request
            $.ajax({
                url: `/administrator/profil-lulusan/${profil_id}`,
                type: 'PUT',
                data: {
                    'title': title,
                    'description': description,
                    '_token': token
                },
                cache: false,
                success: function(response){

                    // show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    // reload page after success
                    location.reload();

                    // close modal
                    $('#modal-edit').modal('hide');
                },
                error: function(error){
                    if (error.responseJSON.title[0]){
                        // show alert
                        $('#alert-edit-title').removeClass('d-none');
                        $('#alert-edit-title').addClass('d-block');

                        // add message to alert
                        $('#alert-edit-title').html(error.responseJSON.title[0]);
                    }

                    if (error.responseJSON.description[0]){
                        // show alert
                        $('#alert-edit-description').removeClass('d-none');
                        $('#alert-edit-description').addClass('d-block');

                        // add message to alert
                        $('#alert-edit-description').html(error.responseJSON.description[0]);
                    }

                }
            })
        })
        
    })

    
</script>