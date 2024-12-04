<nav class="navbar navbar-expand-md navbar-light ps-0">
	<a class="navbar-brand logo-img" href="{{ url('/') }}">
		<img src="{{ asset('assets/img/Dlogo1.png') }}" alt="logo" />
	</a>

	<div class="dropdown mobile-user-menu d-md-none">
        <iconify-icon type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" icon="mdi:hamburger-menu"></iconify-icon>
        <!-- Navigation Links -->
		 <ul class="dropdown-menu dropdown-menu-end">
			<li>
				<a class="dropdown-item" href="#home">Home</a>
			</li>
			<li>
				<a class="dropdown-item" href="#about">About</a>
			</li>
			<li>
				<a class="dropdown-item" href="#eyewears">Eyewear</a>
			</li>
			<li>
				<a class="dropdown-item" href="#services">Services</a>
			</li>
			<li>
				<a class="dropdown-item" href="#ophthalmologist">Ophthalmologist</a>
			</li>
			<!-- Login/Dashboard Links -->
			@if (Route::has('login'))
			@auth
			<li>
				<a class="dropdown-item" href="{{ url(session('usertype') . '/dashboard') }}">Dashboard</a>
			</li>
			<li><hr class="dropdown-divider"></li>
			<form method="POST" action="{{ route('logout') }}">
				@csrf
				<li>
					<a class="dropdown-item" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
					Logout
					</a>
				</li>
			</form>
			@else
			<li>
				<a class="dropdown-item" href="{{ route('login') }}">Login</a>
			</li>
			@endauth
			@endif
		</ul>
	</div>



	<!-- Desktop view -->
	<div class="collapse navbar-collapse d-none d-md-block" id="navbarNavDropdown">
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
				<a class="nav-link scroll-link" href="#optal">Ophthalmologist</a>
			</li>
			@if (Route::has('login'))
			@auth
			<li class="nav-item ms-2 mt-2 mt-md-0">
				<a class="btn btn-primary" href="{{ url(session('usertype') . '/dashboard') }}">Dashboard</a>
			</li>
			<form method="POST" action="{{ route('logout') }}">
				@csrf
				<li class="nav-item ms-2 mt-2 mt-md-0">
					<a class="nav-link scroll-link text-danger" style="text-decoration: underline;" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
					Logout
					</a>
				</li>
			</form>
			@else
			<li class="nav-item ms-2 mt-2 mt-md-0">
				<a class="btn btn-primary" href="{{ route('login') }}">Login</a>
			</li>
			@endauth
			@endif
		</ul>
	</div>
</nav>
