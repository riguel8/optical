@extends('template.client.layout')

@section('content') 
<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
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
                        <div class="form-floating input-icon mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <i class="fa fa-eye-slash"></i>
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-floating input-icon mb-3">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                            <i class="fa fa-eye-slash"></i>
                            <label for="password_confirmation">Confirm Password</label>
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

@endsection

@section('scripts')
<script src="{{asset('assets/js/password.js')}}"></script>
@endsection