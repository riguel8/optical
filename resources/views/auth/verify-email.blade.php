@extends('layouts.header')

@section('title', 'Verify Email')

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
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <button type="submit" class="btn btn-link text-dark text-decoration-underline">
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
