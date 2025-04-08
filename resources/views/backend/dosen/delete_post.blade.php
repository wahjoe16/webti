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
                    url: '/administrator/posts/' + postId,
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