<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new kelompok keahlian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="control-label">Nama Kelompok Keahlian</label>
                    <input type="text" class="form-control" id="nama_kelompok">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-desc"></div>
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
    $('body').on('click', '#btn-add-kelompok_keahlian', function(){
        // buka modal
        $('#modal-create').modal('show');
    })

    // event ketika save button
    $('#store').click(function(e){
        let nama_kelompok = $('#nama_kelompok').val();
        let description = $('#description').val();
        let token = $("meta[name='csrf-token']").attr('content');

        // ajax request
        $.ajax({
            url: '/administrator/kelompok-keahlian',
            type: 'POST',
            data: {
                'nama_kelompok': nama_kelompok,
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
                $('#nama_kelompok').val('');
                $('#description').val('');

                // close modal
                $('#modal-create').modal('hide');
            },
            error: function(error){
                if (error.responseJSON.nama_kelompok[0]){
                    // show alert
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');

                    // add message to alert
                    $('#alert-name').html(error.responseJSON.nama_kelompok[0]);
                }
            }
        })
    })
        
</script>