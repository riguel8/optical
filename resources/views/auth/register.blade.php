@extends('layouts.header')

@section('title', 'Sign Up')

@section('content')
<div id="global-loader">
	<div class="whirly-loader"> </div>
</div>
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

								<div class="col-md-12">									
									<div class="form-floating mb-2">
										<input id="name" type="text" class="form-control" placeholder="Enter name" name="name" value="{{ old('name') }}" required autofocus />
										<label for="name">Name</label>
									</div>
									@error('name')
									    <div class="text-danger mb-3">{{ $message }}</div>
									@enderror
								</div>

								<div class="col-md-12">									
									<div class="form-floating mb-2">										
										<input id="email" type="email" class="form-control" placeholder="Enter email" name="email" value="{{ old('email') }}" required />
										<label for="email">Email Address</label>
									</div>
									@error('email')
									    <div class="text-danger mb-3">{{ $message }}</div>
									@enderror									
								</div>

								<div class="col-md-12">										
									<div class="form-floating mb-2 input-icon">											
										<input type="password" class="form-control" id="password"  placeholder="Enter password" name="password" required />
										<!-- <i class="fa fa-eye-slash"></i> -->
										<label for="password">Password</label>                                               
									</div>	
									@error('password')
										<div class="text-danger mb-3">{{ $message }}</div>
									@enderror									
								</div>

								<div class="col-md-12">										
									<div class="form-floating mb-4 input-icon">											
										<input type="password"  id="password_confirmation" class="form-control"  placeholder="Confirm password" name="password_confirmation" required />
										<!-- <i class="fa fa-eye-slash"></i> -->
										<label for="password_confirmation">Confirm password</label>                                                
									</div>	
									@error('password_confirmation')
									    <div class="text-danger mb-2">{{ $message }}</div>
									@enderror										
								</div>
								
								<button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</button>

								<div class="d-flex align-items-center justify-content-center">
									<p class="fs-3 mb-0 text-dark">Already have an Account?</p>
									<a class="text-warning fw-medium ms-2" href="{{ route('login') }}">Sign In</a>
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

@include('layouts.footer')
