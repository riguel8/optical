@extends('layouts.header')

@section('title', 'Verify Email')

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

                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="mb-4 font-medium text-sm text-success">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif

                            <div class="d-flex align-items-center justify-content-between mt-4">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary py-2 px-4">
                                        {{ __('Resend Verification Email') }}
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-dark text-decoration-none">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
