@extends('layouts.header')

@section('title', 'Login')

@section('content')
<div id="main-wrapper">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3 auth-card">
                    <div class="card mb-0">
                        <div class="card-body p-5">
                            <a href="{{ route('landing') }}" class="text-nowrap logo-img text-center d-flex align-items-center justify-content-center mb-5 w-100">
                                <b class="logo-icon">
                                    <img src="{{ asset('assets/landing/images/DELINlogo.png') }}" alt="homepage" class="dark-logo" />
                                </b>
                            </a>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif


                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-envelope"></i></span>
                                        <div class="form-floating">
                                            <input id="email" type="email" name="email" placeholder="Email" class="form-control" required autofocus value="{{ old('email') }}" />
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-key"></i></span>
                                        <div class="form-floating input-icon">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                            <i class="fa fa-eye-slash"></i>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                        <label class="form-check-label text-dark" for="remember_me">{{ __('Remember this Device') }}</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="text-warning fw-medium" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 rounded-2">Login</button>

                                <div class="d-flex align-items-center justify-content-center mt-3">
                                    <a class="text-warning fw-medium" href="{{ route('register') }}">Create an account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
