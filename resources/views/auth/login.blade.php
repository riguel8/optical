@extends('layouts.header')

@section('title', 'Login')

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
                                            <input id="email" type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username"/>
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-lock"></i></span>
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
