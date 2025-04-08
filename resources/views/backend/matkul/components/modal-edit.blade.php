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
                    <label for="nama" class="control-label">Mata Kuliah</label>
                    <input type="text" class="form-control" id="edit-nama">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="edit-alert-nama"></div>
                </div>

                <div class="form-group">
                    <label for="sks" class="control-label">SKS</label>
                    <input type="text" class="form-control" id="edit-sks">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="edit-alert-sks"></div>
                </div>

                <div class="form-group">
                    <label for="sks" class="control-label">Semester</label>
                    <select class="form-control" id="edit-semester" name="semester">
                        <option value="">Select</option>
                        @foreach ([
                            'Semester 1' => 'Semester 1',
                            'Semester 2' => 'Semester 2',
                            'Semester 3' => 'Semester 3',
                            'Semester 4' => 'Semester 4',
                            'Semester 5' => 'Semester 5',
                            'Semester 6' => 'Semester 6',
                            'Semester 7' => 'Semester 7',
                            'Semester 8' => 'Semester 8'
                        ] as $semester => $semesterLabel)
                            <option value="{{ $semester }}">{{ $semesterLabel }}</option>
                        @endforeach
                    </select>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="edit-alert-semester"></div>
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
    $('body').on('click','#btn-edit-matkul', function(){

        // Get the data-id attribute of the clicked row
        let matkul_id = $(this).data('id');

        // Fetch the category data from the server using AJAX
        $.ajax({
            url: `/administrator/matkul/${matkul_id}`,
            type: 'GET',
            cache: false,
            success: function(response){
                // fill data to form
                $('#edit-nama').val(response.data.nama);
                $('#edit-sks').val(response.data.sks);
                $('#edit-semester').val(response.data.semester);

                // show modal
                $('#modal-edit').modal('show');
            },
            error: function(error){
                alert('tidak bisa menampilkan data');
            }
        })

        $('#update').click(function(e){
            e.preventDefault();
            
            let nama = $('#edit-nama').val();
            let sks = $('#edit-sks').val();
            let semester = $('#edit-semester').val();
            let token = $("meta[name='csrf-token']").attr("content");

            // ajax request
            $.ajax({
                url: `/administrator/matkul/${matkul_id}`,
                type: 'PUT',
                data: {
                    'nama': nama,
                    'sks': sks,
                    'semester': semester, 
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
                    if (error.responseJSON.nama[0]){
                        // show alert
                        $('#alert-edit-nama').removeClass('d-none');
                        $('#alert-edit-nama').addClass('d-block');

                        // add message to alert
                        $('#alert-edit-nama').html(error.responseJSON.nama[0]);
                    }

                    if (error.responseJSON.sks[0]){
                        // show alert
                        $('#alert-edit-sks').removeClass('d-none');
                        $('#alert-edit-sks').addClass('d-block');

                        // add message to alert
                        $('#alert-edit-sks').html(error.responseJSON.sks[0]);
                    }

                    if (error.responseJSON.semester[0]){
                        // show alert
                        $('#alert-edit-semester').removeClass('d-none');
                        $('#alert-edit-semester').addClass('d-block');

                        // add message to alert
                        $('#alert-edit-semester').html(error.responseJSON.semester[0]);
                    }
                }
            })
        })
        
    })

    
</script>