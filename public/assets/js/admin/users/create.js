document.addEventListener('DOMContentLoaded', function () {
    const addUserForm = document.querySelector('#addUsersForm');

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


    addUserForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(addUserForm);

        fetch(addUserForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                toastr.success(data.message, 'Success!');
                addUserForm.reset();
                $('#addUsers').modal('hide');
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const errorMessage = data.errors[field][0];
                        if (field === 'email' && errorMessage.includes('already')) {
                            toastr.error('This email is already registered in the system.', 'Error!');
                        } 
                        else if (field === 'name' && errorMessage.includes('already')) {
                            toastr.error('This name is already registered in the system.', 'Error!');
                        }
                        else {
                            const errorElement = document.querySelector(`#${field}`).nextElementSibling;
                            if (errorElement) {
                                errorElement.textContent = errorMessage;
                            }
                            toastr.error(errorMessage, 'Error!');
                        }
                    });
                } else {
                    toastr.error(data.message || 'An error occurred while adding the user.', 'Error!');
                }
            }
        })
        .catch(error => {
            toastr.error('An unexpected error occurred. Please try again.', 'Error!');
            console.error('Error:', error);
        });
    });
});