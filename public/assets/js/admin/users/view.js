document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.view-user');
    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            console.log('Fetching details for User ID:', id);

            fetch(`/admin/users/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        console.error('User not found or error in data:', data.error);
                    } else {
                        document.getElementById('username').textContent = data.user.name;
                        document.getElementById('useremail').textContent = data.user.email;
                        document.getElementById('usertype').textContent = data.user.usertype;
                        document.getElementById('created_at').textContent = data.user.created_at;

                        $('#viewUser').modal('show');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('Error fetching user details:', 'Error!');
                });
        });
    });
});
