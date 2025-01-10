       document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-user');
            const editForm = document.querySelector('#editUserForm');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
        
        
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById('id').value = id;
                    editForm.action = `/admin/users/update/${id}`;
        
                    fetch(`/admin/users/edit/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('edit_username').value = data.user.name;
                            document.getElementById('edit_useremail').value = data.user.email;
                            document.getElementById('edit_floatingSelect').value = data.user.usertype;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            toastr.error('Failed to fetch user details', 'Error!');
                        });
                });
            });
        
                editForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                fetch(editForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success(data.message, 'Success!');
                        $('#editUser').modal('hide');
                        
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error(data.message, 'Error!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('An unexpected error occurred', 'Error!');
                });
            });
        });
