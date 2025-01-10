document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right", 
        timeOut: 2000,
        showMethod: "slideDown", 
        hideMethod: "slideUp",   
        showDuration: 300,     
        hideDuration: 200,      
        extendedTimeOut: 1000      
    };

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: 'Confirm Deletion',
                text: 'Are you sure you want to delete this entry? Once deleted, it cannot be restored.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff9f43',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/chatbot/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            toastr.success(data.message, 'Deleted!');
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(data.message, 'Error!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        toastr.error('There was a problem deleting the Question and Response.', 'Error!');
                    });
                }
            });
        });
    });
});
