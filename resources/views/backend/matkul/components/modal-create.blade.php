<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new mata kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="nama" class="control-label"><strong>Mata Kuliah</strong></label>
                    <input type="text" class="form-control" id="nama" placeholder="Sample: Bahasa Inggris">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                </div>

                <div class="form-group">
                    <label for="sks" class="control-label"><strong>SKS</strong></label>
                    <input type="number" class="form-control" id="sks" placeholder="Sample: 1">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sks"></div>
                </div>

                <div class="form-group">
                    <label for="sks" class="control-label"><strong>Semester</strong></label>
                    <select class="form-control" id="semester" name="semester">
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
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-semester"></div>
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
    $('body').on('click', '#btn-add-matkul', function(){
        // buka modal
        $('#modal-create').modal('show');
    })

    // event ketika save button
    $('#store').click(function(e){
        let nama = $('#nama').val();
        let sks = $('#sks').val();
        let semester = $('#semester').val();
        let token = $("meta[name='csrf-token']").attr('content');

        // ajax request
        $.ajax({
            url: '/administrator/matkul',
            type: 'POST',
            data: {
                'nama': nama,
                'sks': sks,
                'semester': semester,
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
                $('#nama').val('');
                $('#sks').val('');
                $('#semester').val('');

                // close modal
                $('#modal-create').modal('hide');
            },
            error: function(error){
                if (error.responseJSON.nama[0]){
                    // show alert
                    $('#alert-nama').removeClass('d-none');
                    $('#alert-nama').addClass('d-block');

                    // add message to alert
                    $('#alert-nama').html(error.responseJSON.nama[0]);
                }

                if (error.responseJSON.sks[0]){
                    // show alert
                    $('#alert-sks').removeClass('d-none');
                    $('#alert-sks').addClass('d-block');

                    // add message to alert
                    $('#alert-sks').html(error.responseJSON.sks[0]);
                }

                if (error.responseJSON.semester[0]){
                    // show alert
                    $('#alert-semester').removeClass('d-none');
                    $('#alert-semester').addClass('d-block');

                    // add message to alert
                    $('#alert-semester').html(error.responseJSON.semester[0]);
                }
            }
        })
    })
        
</script>