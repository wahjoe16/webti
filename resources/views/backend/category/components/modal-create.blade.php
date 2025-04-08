<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="control-label">Category Name</label>
                    <input type="text" class="form-control" id="name">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
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

                // table category
                /* let category = `
                    <tr>
                       <td class="text-center">${response.data.id}</td>
                       <td>${response.data.name}</td>
                       <td class="text-center"></td>
                       <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-category" data-id="{{ $value->id }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                            <a href="javascript:void(0)" id="btn-delete-category" data-id="{{ $value->id }}" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
                       </td>
                    </tr>
                `;

                $('#table-category').prepend(category);
                */

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