@extends('template.admin.header')

@section('content')
<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Users</h4>
                <h6>Users Lists</h6>
            </div>
            <div class="page-btn">
                <a data-bs-target="#addUsers" data-bs-toggle="modal" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" alt="img">Add Users
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf">
                                    <img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                                    <img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print">
                                    <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>User Type</th>
                                <th>Email</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->usertype}}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="me-3 view-user" href="#" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#viewUser">
                                                <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View User">
                                            </a>                                        
                                            <a class="me-3 edit-user" href="#" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#editUser">
                                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="Edit User">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Users Modal -->
<div class="modal fade" id="addUsers">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">Add Users</h4>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <input type="hidden" id="id" name="userID" value="">
                    <div class="form-floating mb-3">
                        <input id="name" type="text" name="name" placeholder="Name" class="form-control" required autofocus value="{{ old('complete_name') }}" />
                        <label for="name">Complete Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="email" type="text" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}" />
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select name="usertype" class="form-control" id="floatingSelect" required>
                            <option value="" disabled selected>Select Usertype</option>
                            <option value="admin">Admin</option>
                            <option value="client">Client</option>
                            <option value="ophthal">Ophthal/Doctor</option>
                            <option value="staff">Staff</option>
                        </select>
                        <span class="arrow"></span>
                        <label for="floatingSelect">UserType</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" placeholder="Password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                        <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- View User Modal -->
<div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="viewUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="text-align: center; width: 100%;" class="modal-title" id="viewUserLabel">User Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="productdetails">
                    <ul class="product-bar">
                        <li>
                            <h4><strong>User's Name:</strong>
                            <h6><span id="username"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Email:</strong></h4>
                            <h6><span id="useremail"></span></h6>
                        </li>
                        <li>
                            <h4><strong>User Type:</strong></h4>
                            <h6><span id="usertype"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Date Created:</strong></h4>
                            <h6><span id="created_at"></span></h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Editing User -->
<div class="modal fade" id="editUser">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="editUserForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id" name="id" value="">

                    <div class="form-floating mb-3">
                        <input id="edit_username" type="text" name="name" placeholder="Name" class="form-control" required autofocus value="{{ old('name') }}" />
                        <label for="edit_username">Complete Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="edit_useremail" type="text" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}" />
                        <label for="edit_useremail">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select name="usertype" class="form-control" id="edit_floatingSelect" required>
                            <option value="" disabled selected>User Type</option>
                            <option value="admin">Admin</option>
                            <option value="client">Client</option>
                            <option value="Staff">Staff</option>
                            <option value="ophthal">Ophthal/Doctor</option>
                        </select>
                        <span class="arrow"></span>
                        <label for="edit_floatingSelect">User Type</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="edit_userpassword" type="password" name="password" class="form-control" placeholder="New Password" />
                        <label for="edit_userpassword">New Password</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input id="edit_userpassword_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" />
                        <label for="edit_userpassword_confirmation">Confirm New Password</label>
                    </div>

                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-sm btn-primary" type="submit">Save Changes</button>
                        <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@section('scripts')
    
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>


    <!-- View User -->
    <script>
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
                        console.error('Error fetching user details:', error);
                    });
            });
        });
    });

    </script>


    <!-- Script to open Edit and Update Appointments-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-user');
            const editForm = document.querySelector('#editUserForm');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
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
                        .catch(error => console.error('Error fetching user details:', error));
                });
            });
        
            // Form submission handling
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
                    if (data.success) {
                        alert(data.success);
                        $('#editUser').modal('hide');
                        location.reload();
                    } else {
                        alert(data.error || 'Error updating user');
                    }
                })
                .catch(error => console.error('Error updating user:', error));
            });
        });
        </script>
        

    @endsection

@endsection