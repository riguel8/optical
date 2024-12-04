@extends('template.landing.layout')

@section('content')

        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="{{ asset('assets/img/carousel1.jpg') }}" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 img-small-height" src="{{ asset('assets/img/carousel2.jpg') }}" alt="Image">
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
        <div class="container-fluid py-5 section-padding" id="about" style="scroll-margin-top: 60px;">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h3 class="section-title text-start text-warning text-uppercase"><strong>About</strong></h3>
                        <h2 class="mb-4 text-uppercase"><strong>Welcome to Delin Optical</strong></h2>
                        <p class="mb-4">Computerized eye examination. 30 years in providing good quality eyecare in the province of Bukidnon.</p>
                        <p><strong>Address: 2nd Level Robinsons Place Valencia, Sayre Highway, Brgy. Hagkol, Valencia City, Bukidnon, Philippines</strong></p>
                        <!-- <a id="contactUsBtn" class="btn btn-outline-primary py-3 px-5 mt-2" data-bs-toggle="modal" data-bs-target="#chatbotModal">Contact Us</a> -->
                        <a href="#footer" class="btn btn-outline-primary py-2 px-4 mt-2 scroll-link" >CONTACT US</a>
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

        <!-- Eyewear Section -->
        <div class="container-fluid py-5 section-padding" id="eyewears" style="scroll-margin-top: 60px;">
            <div class="text-center wow fadeInUp mb-5" data-wow-delay="0.1s">
                <h2 class="text-warning"><strong>EYEWEAR</strong></h2>
                <h5>Elevate your vision, enhance your style.</h5>
            </div>
            <div id="eyewearCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                @if(isset($groupedByBrand) && $groupedByBrand->count())
                    @foreach($groupedByBrand as $brand => $products)
                        @foreach($products->chunk(4) as $chunkedProducts)
                        <div class="carousel-item @if($loop->parent->first && $loop->first) active @endif">
                            <!-- <div class="text-center mb-2">
                                <h3 class="brand-caption" style="text-transform:uppercase"><strong>{{ $brand }}</strong></h3>
                            </div> -->
                            <div class="row justify-content-center">
                                @foreach($chunkedProducts as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="productset flex-fill text-center">
                                        <div class="productsetimg">
                                            <img src="{{ asset('storage/eyewears/' . $product->image) }}" alt="Eyewear" class="img-fluid d-block w-100" style="max-width: 100%; max-height: 150px; height: auto; object-fit: cover;">
                                        </div>
                                        <div class="productsetcontent">
                                            <h4>{{ $product->Brand }} {{ $product->Model }}</h4>
                                            <h6>₱{{ number_format($product->Price, 2) }}</h6>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        <button class="carousel-control-prev" type="button" data-bs-target="#eyewearCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#eyewearCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"></div>
                    @endforeach
                @else
                    <div class="col-12 justify-content-center align-items-center">
                        <div class="alert alert-info px-4 py-2 text-center text-sm text-gray-500 wow fadeInUp" data-wow-delay="0.1s" colspan="6">
                            {{ __('No products available.') }}
                        </div>
                    </div>
                @endif
                </div>
            </div> 
        </div>
        <!-- Eyewears End -->

        <!-- Service Start -->
        <div class="container-fluid py-5 section-padding" id="services" style="scroll-margin-top: 130px; background-size: cover; background-image: url(./assets/img/carousel2.jpg); background-attachment: fixed;" >
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <!-- <h6 class="section-title text-center text-white text-uppercase">Our Services</h6> -->
                    <h1 class="mb-4 text-white">Explore Our <span class="text-warning text-uppercase"><strong>Services</strong></span></h1>
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
                                <iconify-icon icon="material-symbols:ophthalmology-outline" width="36" height="36"></iconify-icon>
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

<!-- Optometrist Hero Section -->
<div class="container-fluid py-5 section-padding optometrist-hero" id="optal" style="scroll-margin-top: 60px;">
    <div class="container-fluid p-0">
        <div class="hero-content">
            <div class="row g-0">
                <div class="col-lg-6 content-col">
                    <div class="content-wrapper wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="hero-title">EXPERT EYE CARE PROFESSIONALS</h1>
                        <p class="hero-subtitle">Experience exceptional eye care from our dedicated team of specialists with over 30 years of combined expertise.</p>
                        <a href="{{ route("login")}}" class="btn btn-light btn-appointment">Book an Appointment</a>
                    </div>
                </div>
                <div class="col-lg-6 image-col">
                    <div class="doctors-wrapper">
                        <div class="doctor-card">
                            <div class="doctor-image">
                                <img src="{{ asset('assets/img/users/pupu.jpg') }}" alt="Doctor 1">
                            </div>
                            <div class="doctor-info">
                                <h3>Dr. Kim Chaewon</h3>
                                <p>Pediatric Optometry Specialist</p>
                            </div>
                        </div>
                        <div class="doctor-card">
                            <div class="doctor-image">
                                <img src="{{ asset('assets/img/users/rina.jpg') }}" alt="Doctor 2">
                            </div>
                            <div class="doctor-info">
                                <h3>Dr. Yoo Jimin</h3>
                                <p>Vision Therapy Expert</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


       <!-- Footer Start -->
<div class="container-fluid footer-section py-5 section-padding" id="footer" style="scroll-margin-top: 80px;">
    <div class="container">
        <div class="row gx-5">
            <!-- Get in Touch Card -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="get-in-touch-card">
                    <div class="card-header">
                        <h4>Get in Touch</h4>
                        <p class="subtitle">We're here to help you</p>
                    </div>
                    
                    <div class="contact-grid">
                        <!-- Location -->
                        <div class="contact-grid-item">
                            <div class="icon-box">
                                <iconify-icon icon="material-symbols:location-on" width="24"></iconify-icon>
                            </div>
                            <div class="info">
                                <h6>Visit Us</h6>
                                <p>2nd Level Robinsons Place Valencia, Sayre Highway, Brgy. Hagkol, Valencia City, Bukidnon</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="contact-grid-item">
                            <div class="icon-box">
                                <iconify-icon icon="material-symbols:phone-android" width="24"></iconify-icon>
                            </div>
                            <div class="info">
                                <h6>Call Us</h6>
                                <div class="phone-numbers">
                                    <a href="tel:09123456789">09123456789</a>
                                    <a href="tel:09987654321">09987654321</a>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="contact-grid-item">
                            <div class="icon-box">
                                <iconify-icon icon="material-symbols:mail" width="24"></iconify-icon>
                            </div>
                            <div class="info">
                                <h6>Email Us</h6>
                                <a href="mailto:customerservice@delinoptical.com">customerservice@delinoptical.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="social-connect">
                        <h6>Connect With Us</h6>
                        <div class="social-buttons">
                            <a href="https://www.facebook.com/DelinOptical" class="social-btn facebook" aria-label="Facebook">
                                <iconify-icon icon="ri:facebook-fill"></iconify-icon>
                                <span>Facebook</span>
                            </a>
                            <a href="https://www.facebook.com/DelinOptical" class="social-btn messenger" aria-label="Messenger">
                                <iconify-icon icon="ri:messenger-fill"></iconify-icon>
                                <span>Messenger</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="col-lg-8 col-md-12">
                <div class="footer-links-container">
                    <div class="row g-4">
                        <!-- Products -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="footer-link-group">
                                <h5>Products</h5>
                                <ul>
                                    <li><a href="#">Eyeglasses</a></li>
                                    <li><a href="#">Contact Lens</a></li>
                                    <li><a href="#">Reading Glasses</a></li>
                                    <li><a href="#">Sunglasses</a></li>
                                    <li><a href="#">Accessories</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Information -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="footer-link-group">
                                <h5>Information</h5>
                                <ul>
                                    <li><a href="#">Branch Locator</a></li>
                                    <li><a href="#">Corporate Partners</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">What's New</a></li>
                                    <li><a href="#">Our Blog</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Help -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="footer-link-group">
                                <h5>Help</h5>
                                <ul>
                                    <li><a href="#">Book Appointment</a></li>
                                    <li><a href="#">Return & Warranty</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">FAQ</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Legal -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="footer-link-group">
                                <h5>Legal</h5>
                                <ul>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Cookie Policy</a></li>
                                    <li><a href="#">Loyalty Rewards</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright & Payment Methods -->
        <div class="footer-bottom">
            <hr>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">&copy; 2024 BSIT SOFTWARE DEVELOPMENT. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection