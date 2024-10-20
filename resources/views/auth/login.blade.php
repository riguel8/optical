@extends('layouts.header')

@section('title', 'Sign In')

@section('content')
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>
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

                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                   
                                    <div class="col-md-12">
                                        <div class="form-floating mb-2">
                                            <input id="email" type="email" name="email" placeholder="Email" class="form-control" required autofocus value="{{ old('Email') }}" />
                                            <label for="email">Email Address</label>
                                        </div>
                                        @error('email')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-floating mb-4">
                                            <input id="password" type="password" name="password" placeholder="Password" class="form-control" required />
                                            <label for="password">Password</label>
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
                                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-2">Sign In</button>

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

@include('layouts.footer')
