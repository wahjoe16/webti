<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new profil lulusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="title" class="control-label"><strong>Title</strong></label>
                    <input type="text" class="form-control" id="title" placeholder="Sample: Production Planner">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>

                <div class="form-group">
                    <label for="description" class="control-label"><strong>Description</strong></label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-description"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    // event untuk modal pop up
    $('body').on('click', '#btn-add-profil', function(){
        // buka modal
        $('#modal-create').modal('show');
    })

    // event ketika save button
    $('#store').click(function(e){
        let title = $('#title').val();
        let description = $('#description').val();
        let token = $("meta[name='csrf-token']").attr('content');

        // ajax request
        $.ajax({
            url: '/administrator/profil-lulusan',
            type: 'POST',
            data: {
                'title': title,
                'description': description,
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
                $('#title').val('');
                $('#description').val('');

                // close modal
                $('#modal-create').modal('hide');
            },
            error: function(error){
                if (error.responseJSON.title[0]){
                    // show alert
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');

                    // add message to alert
                    $('#alert-title').html(error.responseJSON.title[0]);
                }

                if (error.responseJSON.description[0]){
                    // show alert
                    $('#alert-description').removeClass('d-none');
                    $('#alert-description').addClass('d-block');

                    // add message to alert
                    $('#alert-description').html(error.responseJSON.description[0]);
                }

            }
        })
    })
        
</script>