@include('template.client.header')

@include('template.client.navbar')
@include('template.client.sidebar')

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4 style="text-transform:uppercase;">My Account</h4>
                <h6>Account Details</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('client.updateAccount') }}" method="POST">
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
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ old('email', Auth::user()->email) }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password" class="pass-input">
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <div class="pass-group">
                                            <input type="password" name="password_confirmation" class=" pass-input">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                                        <a href="{{ route('client.dashboard') }}" class="btn btn-cancel">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@include('template.client.footer')