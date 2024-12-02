@extends('layouts.header')

@section('title', 'Confirm Password')

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
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

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
