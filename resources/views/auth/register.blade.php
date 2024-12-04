@extends('layouts.header')

@section('title', 'Register')

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
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
							</div>
                            <div class="or-wrapper mb-4 position-relative d-flex align-items-center">
                                <hr class="flex-grow-1">
                                <p class="mx-2 mb-0">o</p>
                                <hr class="flex-grow-1">
                            </div>

							<form method="POST" action="{{ route('register') }}">
                                @csrf
								<div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-user"></i></span>
                                        <div class="form-floating">
                                            <input id="name" type="text" class="form-control" placeholder="Enter name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
											<label for="name">Name</label>
                                        </div>
                                    </div>
									@error('name')
									    <div class="text-danger mb-3">{{ $message }}</div>
									@enderror
                                </div>
								
								<div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-envelope"></i></span>
                                        <div class="form-floating">
                                            <input id="email" 
                                                type="email" 
                                                name="email" 
                                                class="form-control email-input" 
                                                placeholder="Email"
                                                value="{{ old('email') }}" 
                                                required 
                                                autocomplete="username"
                                                pattern="[a-z0-9._%+-]+@gmail\.com$"/>
                                            <label for="email">Email Address</label>
                                            <span class="gmail-suffix">@gmail.com</span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="text-danger mb-3">{{ $message }}</div>
                                    @enderror
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-key"></i></span>
                                        <div class="form-floating input-icon">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required autocomplete="new-password">
                                            <i class="fa fa-eye-slash"></i>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="text-danger mb-3">{{ $message }}</div>
                                    @enderror
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-solid fa-key"></i></span>
                                        <div class="form-floating input-icon">
										<input type="password"  id="password_confirmation" class="form-control"  placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password" />
                                            <i class="fa fa-eye-slash"></i>
                                            <label for="password_confirmation">Confirm password</label>   
                                        </div>
                                    </div>
									@error('password_confirmation')
									    <div class="text-danger mb-2">{{ $message }}</div>
									@enderror	
                                </div>
								
								<button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Register</button>

								<div class="d-flex align-items-center justify-content-center">
									<p class="fs-3 mb-0 text-dark">Already have an Account?</p>
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
<style>
.form-floating {
    position: relative;
}

.gmail-suffix {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    pointer-events: none;
    z-index: 4;
}

.email-input {
    padding-right: 85px !important;
}
</style>
@endsection

