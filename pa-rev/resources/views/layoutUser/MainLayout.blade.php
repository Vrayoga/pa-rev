<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekstrakurikuler - SMKN 1 Sumenep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('') }}assets/images/logo-smk1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/css/viewUser.min.css">
</head>

<body>
    <!-- Floating Elements -->
    <div class="floating-element" style="width: 300px; height: 300px; top: -100px; right: -100px;"></div>
    <div class="floating-element" style="width: 200px; height: 200px; bottom: 100px; left: -50px;"></div>


    @include('layoutUser.Navbar')

    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <div class="footer-logo">SMKN 1 Sumenep</div>
                    <p class="footer-text">Sebagai pusat pengembangan bakat unggulan, kami berkomitmen untuk
                        menyediakan program ekstrakurikuler berkualitas tinggi yang mendorong potensi maksimal setiap
                        siswa dalam lingkungan yang inspiratif dan profesional.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2 mb-5">
                    <h4 class="footer-title">Navigasi</h4>
                    <ul class="footer-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#statistik">Statistik</a></li>
                        <li><a href="#fitur">Fitur</a></li>
                        <li><a href="#faq">Informasi</a></li>
                        <li><a href="#">Galeri</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>

                <div class="col-md-4 col-lg-3 mb-5">
                    <h4 class="footer-title">Program Unggulan</h4>
                    <ul class="footer-links">
                        <li><a href="#">Robotic Elite</a></li>
                        <li><a href="#">Digital Creative</a></li>
                        <li><a href="#">Young Entrepreneurs</a></li>
                        <li><a href="#">Debate Masterclass</a></li>
                        <li><a href="#">Sports Academy</a></li>
                        <li><a href="#">Arts Performance</a></li>
                    </ul>
                </div>

                <div class="col-md-4 col-lg-3 mb-5">
                    <h4 class="footer-title">Hubungi Kami</h4>
                    <div class="contact-info">
                        <i class="bi bi-geo-alt-fill"></i>
                        <p>Jl. Trunojoyo No. 294, Sumenep, Jawa Timur 69451</p>
                    </div>
                    <div class="contact-info">
                        <i class="bi bi-telephone-fill"></i>
                        <p>(0328) 662025<br>+62 812-3456-7890</p>
                    </div>
                    <div class="contact-info">
                        <i class="bi bi-envelope-fill"></i>
                        <p>info@smkn1sumenep.sch.id<br>ekskul@smkn1sumenep.sch.id</p>
                    </div>
                </div>
            </div>

            <div class="copyright">
                &copy; 2025 SMKN 1 Sumenep. All rights reserved. | Designed with <i class="bi bi-heart-fill"
                    style="color: var(--gold);"></i> IT PENS 2022
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            duration: 1000
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '12px 0';
                navbar.style.backgroundColor = 'rgba(10, 26, 58, 0.98)';
            } else {
                navbar.style.padding = '18px 0';
                navbar.style.backgroundColor = 'rgba(10, 26, 58, 0.98)';
            }
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 90,
                        behavior: 'smooth'
                    });

                    // Update active nav link
                    document.querySelectorAll('.nav-link').forEach(navLink => {
                        navLink.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        });

        // Carousel functionality
        const carousel = document.querySelector('.carousel-container');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');

        if (carousel && prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => {
                carousel.scrollBy({
                    left: -340,
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', () => {
                carousel.scrollBy({
                    left: 340,
                    behavior: 'smooth'
                });
            });
        }

        // Highlight active section on scroll
        window.addEventListener('scroll', highlightNavItem);

        function highlightNavItem() {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');

            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        }

        // Scroll indicator functionality
        const scrollIndicator = document.querySelector('.scroll-indicator');
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', () => {
                window.scrollBy({
                    top: window.innerHeight - 90,
                    behavior: 'smooth'
                });
            });

            window.addEventListener('scroll', () => {
                if (window.scrollY > window.innerHeight * 0.5) {
                    scrollIndicator.style.opacity = '0';
                    scrollIndicator.style.pointerEvents = 'none';
                } else {
                    scrollIndicator.style.opacity = '1';
                    scrollIndicator.style.pointerEvents = 'auto';
                }
            });
        }

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    navbarCollapse.classList.remove('show');
                }
            });
        });

        // Prevent horizontal scrolling on mobile
        document.addEventListener('touchmove', function(e) {
            if (e.touches.length === 1) {
                const touch = e.touches[0];
                if (touch.clientX <= 10 || touch.clientX >= window.innerWidth - 10) {
                    e.preventDefault();
                }
            }
        }, {
            passive: false
        });
    </script>
</body>

</html>
