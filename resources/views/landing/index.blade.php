@include('template.header')

<header class="topheader py-0 sticky-top" id="top">
<div class="landingpage">
    <div class="main-wrapper" id="home">
        <header class="topheader py-0 sticky-top" id="top">
            <div class="container">
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
                                <a class="nav-link scroll-link" href="#eyewears">Eyewears</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll-link" href="#services">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll-link" href="#ophthalmologist">Ophthalmologist</a>
                            </li>
                            <li class="nav-item ms-3 mt-2 mt-md-0">
                                <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="{{ asset('assets/img/carousel1.jpg') }}" alt="Image" style="max-height: 400px;">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 img-small-height" src="{{ asset('assets/img/carousel2.jpg') }}" alt="Image" style="max-height: 400px;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->

        <!-- About Section -->
        <div class="container-xxl py-5" id="about">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-warning text-uppercase">About</h6>
                        <h1 class="mb-4">Welcome to Delin Optical</h1>
                        <p class="mb-4">Computerized eye examination. 30 years in providing good quality eyecare in the province of Bukidnon.</p>
                        <p><strong>Address: 2nd Level Robinsons Place Valencia, Sayre Highway, Brgy. Hagkol, Valencia City, Bukidnon, Philippines</strong></p>
                        <a id="contactUsBtn" class="btn btn-outline-primary py-3 px-5 mt-2" href="#" data-bs-toggle="modal" data-bs-target="#chatbotModal">Contact Us</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="{{ asset('assets/img/delin/img4.jpg') }}" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="{{ asset('assets/img/delin/img3.jpg') }}" style="height: 100%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="{{ asset('assets/img/delin/img2.jpg') }}">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="{{ asset('assets/img/delin/img1.jpg') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Start -->
        <div class="container-xxl py-5" style="background-size: cover; background-image: url(./assets/img/carousel2.jpg); background-attachment: fixed;">
            <div class="container" id="services">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <!-- <h6 class="section-title text-center text-white text-uppercase">Our Services</h6> -->
                    <h1 class="mb-5 text-white">Explore Our <span class="text-warning text-uppercase">Services</span></h1>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card h-100 border-0 shadow">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="service-icon bg-transparent border rounded-circle p-3 mb-3">
                                    <iconify-icon icon="fxemoji:glasses" width="36" height="36"></iconify-icon>
                                    <!-- <i class="fas fa-glasses fa-2x text-warning"></i> -->
                                </div>
                                <h5 class="card-title mb-3">Prescription Glasses</h5>
                                <p class="card-text text-center">Customized eyewear crafted to your specific vision requirements, enhancing clarity and comfort in your daily activities.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card h-100 border-0 shadow">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="service-icon bg-transparent border rounded-circle p-3 mb-3">
                                    <iconify-icon icon="fxemoji:darksunglasses" width="36" height="36"></iconify-icon>
                                    <!-- <i class="fas fa-sun fa-2x text-warning"></i> -->
                                </div>
                                <h5 class="card-title mb-3">Sunglasses</h5>
                                <p class="card-text text-center">Stylish and protective eyewear designed to shield your eyes from harmful UV rays while adding flair to your look.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="card h-100 border-0 shadow">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="service-icon bg-transparent border rounded-circle p-3 mb-3">
                                    <iconify-icon icon="fluent-emoji:eyes" width="36" height="36"></iconify-icon>
                                    <!-- <i class="fas fa-eye fa-2x text-warning"></i> -->
                                </div>
                                <h5 class="card-title mb-3">Eye Examinations</h5>
                                <p class="card-text text-center">Thorough assessments conducted by experienced optometrists to evaluate your vision health, detect any potential issues, and prescribe appropriate solutions for clearer vision and overall eye wellness.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Add Modals here -->
        <!-- Add Appointment Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="add">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Book an Appointment</h4>
                        <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="appointmentDate" class="form-label">Appointment Date</label>
                                        <input type="date" class="form-control" name="appointment_date" id="appointmentDate" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="appointmentTime" class="form-label">Appointment Time</label>
                                        <input type="time" class="form-control" name="appointment_time" id="appointmentTime" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Add Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>            
      

@include('template.footer')
</header>