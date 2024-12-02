@extends('layouts.header')

@section('title', 'Forgot Password')

@section('content')
<div id="main-wrapper">
	<div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
		<div class="position-relative z-3">
			<div class="row">
				<div class="mx-auto">
					<div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4 ">
						<div class="auth-max-width">
							<div class="row">
                                <a href="{{ route('landing') }}" class="text-nowrap logo-img text-center d-flex align-items-center justify-content-center mb-3 w-100">
                                    <b class="logo-icon">
                                        <img src="{{ asset('assets/landing/images/DELINlogo.png') }}" alt="homepage" class="dark-logo" style="width: 160px;"/>
                                    </b>
                                </a>
							</div>
                            <div class="or-wrapper mb-4 position-relative d-flex align-items-center">
                                <hr class="flex-grow-1">
                                <p class="mx-2 mb-0">o</p>
                                <hr class="flex-grow-1">
                            </div>

                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

							<form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-envelope"></i></span>
                                        <div class="form-floating">
                                            <input id="email" type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required autofocus />
                                            <label for="email">{{ __('Email Address') }}</label>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-2">
                                        {{ __('Email Password Reset Link') }}
                                    </button>
                                </div>
                                <div class="d-flex align-items-center justify-content-center m-3">
									<p class="fs-3 mb-0 text-dark">Remembered your password?</p>
									<a class="text-warning fw-medium ms-2" href="{{ route('login') }}">Login</a>
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
