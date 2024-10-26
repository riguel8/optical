<a id="mobile_btn" class="mobile_btn" href="#sidebar">
    <span class="bar-icon">
        <span></span>
        <span></span>
        <span></span>
    </span>
</a>

<ul class="nav user-menu">

    <li class="nav-item">
        <div class="top-nav-search">
            <a href="" class="responsive-search">
                <i class="fa fa-search"></i>
            </a>
            <form action="#">
                <div class="searchinputs">
                    <input type="text" placeholder="Search Here ...">
                    <div class="search-addon">
                        <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"></span>
                    </div>
                </div>
                <a class="btn" id="searchdiv">
                    <img src="{{ asset('assets/img/icons/search.svg') }}" alt="img">
                </a>
            </form>
        </div>
    </li>

    <li class="nav-item dropdown has-arrow main-drop">
        <a href="#" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
            <span class="user-img">
                <img src="{{ asset('assets/img/users/noimages.jpg') }}" alt="">
                <span class="status online"></span>
            </span>
        </a>
        <div class="dropdown-menu menu-drop-user">
            <div class="profilename">
                <div class="profileset">
                    <span class="user-img">
                        <img src="{{ asset('assets/img/users/noimages.jpg') }}" alt="">
                        <span class="status online"></span>
                    </span>
                    <div class="profilesets">
                        <h6>{{ session('name') }}</h6>
                        <h5>{{ session('usertype') }}</h5>
                    </div>
                </div>
                <hr class="m-0">
                <a class="dropdown-item" href="#">
                    <iconify-icon class="me-2" icon="iconamoon:profile-circle-fill" width="20" height="20"></iconify-icon> My Profile
                </a>
                <a class="dropdown-item" href="#">
                    <iconify-icon class="me-2" icon="material-symbols:settings" width="20" height="20"></iconify-icon>Settings
                </a>
                <hr class="m-0">
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <a class="dropdown-item logout pb-0" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    <iconify-icon class="me-2" icon="material-symbols:logout-sharp" width="20" height="20"></iconify-icon>Logout
                    </a>
                </form>
            </div>
        </div>
    </li>
</ul>

<div class="dropdown mobile-user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="#">My Profile</a>
        <a class="dropdown-item" href="#">Settings</a>
        <a class="dropdown-item" href="{{ url('landingpage') }}">Logout</a>
    </div>
</div>
