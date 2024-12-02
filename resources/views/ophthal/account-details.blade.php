@extends('template.ophthal.layout')

@section('content')
<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title" style="text-transform:uppercase;">My Account</h3>
                    <ul class="breadcrumb">
                        <iconify-icon icon="eva:arrow-back-outline" width="18" height="18"></iconify-icon>
                        <li class="breadcrumb-item">
                            <a href="{{url("ophthal/dashboard")}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Back to dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Account Details</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <form action="{{ route('ophthal.update', Auth::user()->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="profile-set">
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentname">
                                    <h2>{{ session('name') }}</h2>
                                    <h4>Updates Your Personal Details.</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Display status messages -->
                    @if(session('status') == 'success')
                        <div class="alert alert-success fade-out">{{ session('message') }}</div>
                    @elseif(session('status') == 'error')
                        <div class="alert alert-danger fade-out">{{ session('message') }}</div>
                    @elseif(session('status') == 'no_changes')
                        <div class="alert alert-info fade-out">{{ session('message') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" id="name" placeholder="Name" name="name" value="{{ old('name', Auth::user()->name) }}">
                                <label for="name">Name</label>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="email" id="email" placeholder="Email" name="email" value="{{ old('email', Auth::user()->email) }}">
                                <label for="email">Email</label>
                            </div>
                        </div>
                    
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-floating input-icon  mb-3">
                                <input id="edit_password" type="password" name="password" class="form-control" placeholder="New Password" minlength="8">
                                <i class="fa fa-eye-slash"></i>
                                <label for="edit_password">New Password</label>
                            </div>
                            <small id="password-error" class="text-danger d-none">Password must be at least 8 characters.</small>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-floating input-icon">
                                <input id="edit_password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" minlength="8">
                                <i class="fa fa-eye-slash"></i>
                                <label for="edit_password_confirmation">Confirm Password</label>
                            </div>
                            <small id="confirm-password-error" class="text-danger d-none">Passwords do not match or are less than 8 characters.</small>
                        </div>


                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{ route('ophthal.dashboard') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    @section('scripts')
        <script src="{{ asset('assets/js/password.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const passwordInput = document.getElementById('edit_password');
                const confirmPasswordInput = document.getElementById('edit_password_confirmation');
                const passwordError = document.getElementById('password-error');
                const confirmPasswordError = document.getElementById('confirm-password-error');

                function validatePassword() {
                    if (passwordInput.value.length < 8 && passwordInput.value !== '') {
                        passwordError.classList.remove('d-none');
                        passwordError.style.opacity = '1';
                    } else {
                        fadeOutError(passwordError);
                    }
                }
                function validatePasswordMatch() {
                    if ((confirmPasswordInput.value !== passwordInput.value || confirmPasswordInput.value.length < 8) && confirmPasswordInput.value !== '') {
                        confirmPasswordError.classList.remove('d-none');
                        confirmPasswordError.style.opacity = '1';
                    } else {
                        fadeOutError(confirmPasswordError);
                    }
                }
                function fadeOutError(element) {
                    element.style.transition = 'opacity 0.5s ease';
                    element.style.opacity = '0';
                    setTimeout(() => element.classList.add('d-none'), 500);
                }

                passwordInput.addEventListener('input', validatePassword);
                confirmPasswordInput.addEventListener('input', validatePasswordMatch);

                const alertMessage = document.querySelector('.fade-out');
                if (alertMessage) {
                    setTimeout(() => {
                        alertMessage.style.transition = 'opacity 0.5s ease';
                        alertMessage.style.opacity = '0';
                    }, 5000); 

                    setTimeout(() => alertMessage.remove(), 5500); 
                }
            });
        </script>
    @endsection

@endsection