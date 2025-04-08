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
                    <label for="edit-name" class="control-label">Category Name</label>
                    <input type="text" class="form-control" id="edit-name">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-name"></div>
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
    $('body').on('click','#btn-edit-category', function(){

        // Get the data-id attribute of the clicked row
        let cat_id = $(this).data('id');

        // Fetch the category data from the server using AJAX
        $.ajax({
            url: `/administrator/category/${cat_id}`,
            type: 'GET',
            cache: false,
            success: function(response){
                // fill data to form
                // $('#cat_id').val(response.data.id);
                $('#edit-name').val(response.data.name);

                // show modal
                $('#modal-edit').modal('show');
            },
            error: function(error){
                alert('tidak bisa menampilkan data');
            }
        })

        $('#update').click(function(e){
            e.preventDefault();
            
            let name = $('#edit-name').val();
            let token = $("meta[name='csrf-token']").attr("content");

            // ajax request
            $.ajax({
                url: `/administrator/category/${cat_id}`,
                type: 'PUT',
                data: {
                    'name': name, 
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
                    if (error.responseJSON.name[0]){
                        // show alert
                        $('#alert-edit-name').removeClass('d-none');
                        $('#alert-edit-name').addClass('d-block');

                        // add message to alert
                        $('#alert-edit-name').html(error.responseJSON.name[0]);
                    }
                }
            })
        })
        
    })

    
</script>