@extends('layouts.header')

@section('title', 'Confirm Password')

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
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <!-- Password -->
                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-key"></i></span>
                                        <div class="form-floating">
                                            <input id="password" type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
                                            <label for="password">{{ __('Password') }}</label>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary py-2 px-4">
                                        {{ __('Confirm') }}
                                    </button>
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
