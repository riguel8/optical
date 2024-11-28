@extends('layouts.header')

@section('title', 'Register')

@section('content')
<div id="main-wrapper">
	<form method="POST" action="{{ route('register') }}">
		@csrf
		<div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
			<div class="d-flex align-items-center justify-content-center w-100">
				<div class="row justify-content-center w-100">
					<div class="col-md-8 col-lg-6 col-xxl-3 auth-card">
						<div class="card mb-0">
							<div class="card-body p-5">
								<a href="{{ route('landing') }}" class="text-nowrap logo-img text-center d-flex align-items-center justify-content-center mb-5 w-100">
									<b class="logo-icon">
										<img src="{{ asset('./assets/landing/images/DELINlogo.png')}}" alt="homepage" class="dark-logo" />
									</b>
								</a>


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
                                            <input id="email" type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}" required autocomplete="username"/>
                                            <label for="email">Email Address</label>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="dark-transparent sidebartoggler"></div>
@endsection

