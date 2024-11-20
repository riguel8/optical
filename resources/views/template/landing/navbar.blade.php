<nav class="navbar navbar-expand-md navbar-light ps-0">
	<a class="navbar-brand logo-img" href="{{ url('/') }}">
		<img src="{{ asset('assets/img/Dlogo1.png') }}" alt="logo" />
	</a>
	<button class="navbar-toggler navbar-toggler-right border-0 p-0 fs-8" type="button" data-bs-toggle="offcanvas" href="#right-sidebar">
		<iconify-icon icon="solar:hamburger-menu-line-duotone"></iconify-icon>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav ms-auto stylish-nav">
			<li class="nav-item">
				<a class="nav-link scroll-link" href="#home">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scroll-link" href="#about">About</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scroll-link" href="#eyewears">Eyewear</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scroll-link" href="#services">Services</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scroll-link" href="#ophthalmologist">Ophthalmologist</a>
			</li>
			@if (Route::has('login'))
			@auth
			<li class="nav-item ms-3 mt-2 mt-md-0">
				<a class="btn btn-primary" href="{{ url(session('usertype') . '/dashboard') }}">Dashboard</a>
			</li>
			@else
			<li class="nav-item ms-3 mt-2 mt-md-0">
				<a class="btn btn-primary" href="{{ route('login') }}">Login</a>
			</li>
			@endauth
			@endif
		</ul>
	</div>
</nav>