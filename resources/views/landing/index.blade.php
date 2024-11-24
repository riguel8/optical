@extends('template.landing.layout')

@section('content')

        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="{{ asset('assets/img/carousel1.jpg') }}" alt="Image" style="max-height: 450px;">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 img-small-height" src="{{ asset('assets/img/carousel2.jpg') }}" alt="Image" style="max-height: 450px;">
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
        <div class="container-xxl py-5 section-padding" id="about" style="scroll-margin-top: 60px;">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title text-start text-warning text-uppercase"><strong>About</strong></h2>
                        <h1 class="mb-4">Welcome to Delin Optical</h1>
                        <p class="mb-4">Computerized eye examination. 30 years in providing good quality eyecare in the province of Bukidnon.</p>
                        <p><strong>Address: 2nd Level Robinsons Place Valencia, Sayre Highway, Brgy. Hagkol, Valencia City, Bukidnon, Philippines</strong></p>
                        <!-- <a id="contactUsBtn" class="btn btn-outline-primary py-3 px-5 mt-2" data-bs-toggle="modal" data-bs-target="#chatbotModal">Contact Us</a> -->
                        <a href="#contact" class="btn btn-outline-primary py-3 px-5 mt-2 scroll-link" >Contact Us</a>
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
        <div class="container-xl py-5 section-padding" id="eyewears" style="scroll-margin-top: 60px;">
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
        <div class="container-xxl py-5 section-padding" id="services" style="scroll-margin-top: 130px; background-size: cover; background-image: url(./assets/img/carousel2.jpg); background-attachment: fixed;" >
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

        <!-- Contact us -->
        <div class="container-xxl py-5 section-padding" id="contact" style="scroll-margin-top: 60px;">
            <div class="container">
                <div class="text-center wow fadeInUp mb-3" data-wow-delay="0.1s">
                    <h2 class="text-warning"><strong>CONTACT US</strong></h2>
                    <p>We'd love to speak with you. Feel free to reach out using the details below.</p>
                </div>
                
                <div class="contact-card">
                    <!-- Left side with contact details -->
                    <div class="contact-details">
                        <h3 class="mb-3"><strong>Get In Touch</strong></h3>
                        <p>We would love to speak with you. Feel free to reach out using the below details:</p>
                        <ul>
                            <li>
                                <iconify-icon icon="material-symbols-light:phone-android-outline"></iconify-icon>
                                <span>09123456789</span>
                            </li>
                            <li>
                                <iconify-icon icon="material-symbols-light:phone-android-outline"></iconify-icon>
                                <span>09123456789</span>
                            </li>
                            <li>
                                <iconify-icon icon="material-symbols-light:phone-android-outline"></iconify-icon>
                                <span>09123456789</span>
                            </li>
                            <li>
                                <iconify-icon icon="material-symbols-light:phone-android-outline"></iconify-icon>
                                <span>09123456789</span>
                            </li>
                            <li>
                                <iconify-icon icon="material-symbols-light:phone-android-outline"></iconify-icon>
                                <span>09123456789</span>
                            </li>
                            <li>
                                <iconify-icon icon="nrk:some-email"></iconify-icon>
                                <span>customerservice@delinoptical.com</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Right side with contact form -->
                    <div class="contact-form">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" id="name" placeholder="Enter Name" name="name" required>
                                <label for="name">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="email" id="email" placeholder="Enter Email" name="email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Enter Message" id="message" name="message" rows="4" style="height: 150px" required></textarea>
                                <label for="message">Message</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact us end -->

        <!-- Floating Chat Button -->
        <a id="contactUsBtn" class="chat-float-btn" data-bs-toggle="modal" data-bs-target="#chatbotModal">
            <iconify-icon icon="simple-icons:chatbot" width="24" height="24"></iconify-icon>
            <span>Chat with our Assistant</span>
        </a>

@endsection