<footer class="text-center">
    <!-- Grid container -->
    <div class="container pt-4">
        <!-- Section: Social media -->
        <section class="mb-10">
            <!-- Facebook -->
            <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button" data-mdb-ripple-color="dark">
                <i class="fab fa-facebook-f" style="color: #ff9f43;"></i>
            </a>

            <!-- Twitter -->
            <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                <i class="fab fa-twitter" style="color: #ff9f43;"></i>
            </a>

            <!-- Google -->
            <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                <i class="fab fa-google" style="color: #ff9f43;"></i>
            </a>

            <!-- Instagram -->
            <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                <i class="fab fa-instagram" style="color: #ff9f43;"></i>
            </a>

            <!-- LinkedIn -->
            <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                <i class="fab fa-linkedin" style="color: #ff9f43;"></i>
            </a>

            <!-- Github -->
            <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                <i class="fab fa-github" style="color: #ff9f43;"></i>
            </a>
        </section>
        <!-- End Section: Social media -->
    </div>
    <!-- End Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3">
        <p>&copy; 2024 SoftDev, BSIT-4A. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{ asset("assets/lib/wow/wow.min.js")}}"></script>
<script src="{{ asset("assets/lib/easing/easing.min.js")}}"></script>
<script src="{{ asset("assets/lib/waypoints/waypoints.min.js")}}"></script>
<script src="{{ asset("assets/lib/counterup/counterup.min.js")}}"></script>
<script src="{{ asset("assets/lib/owlcarousel/owl.carousel.min.js")}}"></script>
<script src="{{ asset("assets/lib/tempusdominus/js/moment.min.js")}}"></script>
<script src="{{ asset("assets/lib/tempusdominus/js/moment-timezone.min.js")}}"></script>
<script src="{{ asset("assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js")}}"></script>

<!-- Template Javascript -->
<script src="{{ asset("assets/lib/main.js")}}"></script>

<script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
<script src="extensions/fixed-columns/bootstrap-table-fixed-columns.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<script>
    document.querySelectorAll('.scroll-link').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        const target = document.querySelector(this.getAttribute('href'));
        target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
});

</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.querySelector('#eyewearCarousel');
    const carouselItems = carousel.querySelectorAll('.carousel-item');
    const paginationContainer = document.querySelector('.swiper-pagination');

    carouselItems.forEach((item, index) => {
        const bullet = document.createElement('span');
        bullet.classList.add('swiper-pagination-bullet');
        bullet.setAttribute('data-bullet-index', index);
        bullet.setAttribute('aria-label', `Go to slide ${index + 1}`);
        if (index === 0) {
            bullet.classList.add('swiper-pagination-bullet-active');
        }
        paginationContainer.appendChild(bullet);

        bullet.addEventListener('click', () => {
            const bootstrapCarousel = new bootstrap.Carousel(carousel);
            bootstrapCarousel.to(index);
        });
    });

    const updateActiveBullet = () => {
        const activeIndex = [...carouselItems].findIndex((item) => item.classList.contains('active'));
        const bullets = paginationContainer.querySelectorAll('.swiper-pagination-bullet');

        bullets.forEach((bullet) => bullet.classList.remove('swiper-pagination-bullet-active'));
        if (bullets[activeIndex]) {
            bullets[activeIndex].classList.add('swiper-pagination-bullet-active');
        }
    };

    carousel.addEventListener('slid.bs.carousel', updateActiveBullet);
});


</script>

</body>
</html>

