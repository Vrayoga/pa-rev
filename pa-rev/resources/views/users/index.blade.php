<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekstrakurikuler Premium - SMKN 1 Sumenep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <style>
        :root {
            --primary: #0B2447;
            --secondary: #19376D;
            --accent: #A5D7E8;
            --light: #F8F9FA;
            --gold: #D4AF37;
            --gold-light: #E8C873;
            --silver: #C0C0C0;
            --dark: #121212;
            --cream: #F5F3EE;
            --navy: #0A1A3A;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            width: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream);
            scroll-behavior: smooth;
            color: #333;
            position: relative;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        .display-font {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        /* Navbar Styling */
        .navbar {
            background-color: rgba(10, 26, 58, 0.98);
            backdrop-filter: blur(12px);
            padding: 18px 0;
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }   

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: white;
            display: flex;
            align-items: center;
            letter-spacing: 0.5px;
        }

        .navbar-brand img {
            filter: none !important;
            -webkit-filter: none !important;
            background: white;
            padding: 3px;
            border-radius: 4px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin: 0 15px;
            position: relative;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 10px 0;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            transition: width 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--navy);
            font-weight: 600;
            border-radius: 50px;
            padding: 10px 28px;
            border: none;
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.4);
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            letter-spacing: 0.8px;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.5);
            color: var(--navy);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-outline-gold {
            border: 2px solid var(--gold);
            color: var(--gold);
            background: transparent;
            font-weight: 600;
            border-radius: 50px;
            padding: 10px 28px;
            transition: all 0.4s ease;
        }

        .btn-outline-gold:hover {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--navy);
            border-color: transparent;
        }

        /* Hero Section */
        .hero-section {
            padding: 160px 0 100px;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--navy), var(--primary));
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/dummy_ekstra/background.png') center/cover;
            opacity: 0.08;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(transparent, rgba(10, 26, 58, 0.7));
        }

        .hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            font-size: 3.5rem;
            line-height: 1.2;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            letter-spacing: 0.5px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            border-radius: 50px;
        }

        .section-subtitle {
            color: var(--accent);
            font-size: 1.3rem;
            margin-bottom: 40px;
            font-weight: 300;
            max-width: 700px;
            line-height: 1.7;
        }

        /* Ekskul Cards Carousel */
        .ekskul-carousel {
            position: relative;
            margin: 60px 0;
            padding: 30px 0;
            width: 100%;
            overflow: hidden;
        }

        .carousel-container {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 30px;
            padding: 30px 15px;
            scrollbar-width: none;
            -ms-overflow-style: none;
            width: 100%;
        }

        .carousel-container::-webkit-scrollbar {
            display: none;
        }

        .ekskul-card {
            flex: 0 0 340px;
            scroll-snap-align: start;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transition: all 0.5s cubic-bezier(0.215, 0.61, 0.355, 1);
            position: relative;
            height: 420px;
            background-color: white;
            transform: translateY(0);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .ekskul-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }

        .ekskul-img {
            height: 220px;
            width: 100%;
            object-fit: cover;
            border-bottom: 4px solid var(--gold);
            transition: all 0.5s ease;
        }

        .ekskul-card:hover .ekskul-img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 25px;
            position: relative;
            z-index: 2;
            background: white;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.4rem;
            margin-bottom: 12px;
            color: var(--navy);
            letter-spacing: 0.3px;
        }

        .card-schedule {
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .card-schedule i {
            margin-right: 8px;
            color: var(--gold);
        }

        .card-description {
            font-size: 14px;
            color: #666;
            line-height: 1.7;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-button {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--navy), var(--primary));
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            box-shadow: 0 5px 20px rgba(19, 36, 71, 0.3);
            letter-spacing: 0.5px;
        }

        .card-button:hover {
            background: linear-gradient(135deg, var(--primary), var(--navy));
            box-shadow: 0 10px 25px rgba(19, 36, 71, 0.4);
            color: white;
            transform: translateX(-50%) translateY(-3px);
        }

        .carousel-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            padding: 0 15px;
            pointer-events: none;
        }

        .carousel-control {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            pointer-events: auto;
            transition: all 0.3s ease;
            color: var(--navy);
            font-size: 1.2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .carousel-control:hover {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--navy);
            transform: scale(1.1);
        }

        /* Statistics Section */
        .statistics-section {
            padding: 120px 0;
            background-color: white;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .statistics-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1518655048521-f130df041f66?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') center/cover fixed;
            opacity: 0.03;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-top: 5px solid var(--gold);
            transition: all 0.5s cubic-bezier(0.215, 0.61, 0.355, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 2;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(245, 243, 238, 0.9));
            z-index: -1;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 3rem;
            color: var(--gold);
            margin-bottom: 25px;
            background: rgba(212, 175, 55, 0.1);
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: rotateY(180deg);
            background: rgba(212, 175, 55, 0.2);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: transparent;
            font-family: 'Playfair Display', serif;
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--navy), var(--gold));
            -webkit-background-clip: text;
            background-clip: text;
            position: relative;
        }

        .stat-number::after {
            content: '+';
            position: absolute;
            top: 0;
            right: -15px;
            color: var(--gold);
        }

        .stat-title {
            font-size: 1.1rem;
            color: #666;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* Features Section */
        .features-section {
            padding: 120px 0;
            background-color: var(--cream);
            position: relative;
            width: 100%;
        }

        .features-section::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(rgba(245, 243, 238, 0), var(--cream));
            z-index: 1;
        }

        .feature-card {
            padding: 40px 30px;
            border-radius: 16px;
            background: white;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: all 0.5s cubic-bezier(0.215, 0.61, 0.355, 1);
            border-left: 5px solid var(--gold);
            position: relative;
            overflow: hidden;
            z-index: 2;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(245, 243, 238, 0.9));
            z-index: -1;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--gold);
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.2);
            color: var(--navy);
        }

        .feature-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.4rem;
            margin-bottom: 20px;
            color: var(--navy);
            letter-spacing: 0.3px;
        }

        .feature-desc {
            color: #666;
            font-size: 1rem;
            line-height: 1.8;
        }

        /* FAQ Section */
        .faq-section {
            padding: 120px 0;
            background-color: white;
            position: relative;
            width: 100%;
        }

        .faq-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1518655048521-f130df041f66?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') center/cover fixed;
            opacity: 0.03;
        }

        .accordion-item {
            border: none;
            margin-bottom: 20px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            background-color: white;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .accordion-button {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--navy);
            background-color: white;
            padding: 25px 30px;
            font-size: 1.1rem;
            letter-spacing: 0.3px;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            color: white;
            background: linear-gradient(135deg, var(--navy), var(--primary));
        }

        .accordion-button::after {
            background-size: 18px;
            transition: all 0.3s ease;
        }

        .accordion-body {
            padding: 25px 30px;
            color: #555;
            font-size: 1rem;
            line-height: 1.8;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--navy), var(--primary));
            padding: 80px 0 40px;
            color: white;
            position: relative;
            width: 100%;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1518655048521-f130df041f66?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') center/cover fixed;
            opacity: 0.05;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
            position: relative;
            display: inline-block;
        }

        .footer-logo::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .footer-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.4rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
            display: inline-block;
            position: relative;
        }

        .footer-links a::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--gold);
            transition: width 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 8px;
        }

        .footer-links a:hover::before {
            width: 20px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            font-size: 1.1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .social-link:hover {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            transform: translateY(-5px);
            color: var(--navy);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
        }

        .contact-info {
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
        }

        .contact-info i {
            color: var(--gold);
            margin-right: 15px;
            font-size: 1.2rem;
            margin-top: 3px;
        }

        .contact-info p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0;
            line-height: 1.7;
        }

        .copyright {
            text-align: center;
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.5);
            position: relative;
            z-index: 2;
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            filter: blur(30px);
            z-index: 0;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            color: var(--gold);
            font-size: 1.5rem;
            animation: bounce 2s infinite;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .scroll-indicator span {
            font-size: 0.8rem;
            margin-top: 5px;
            color: white;
            letter-spacing: 1px;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0) translateX(-50%);
            }

            40% {
                transform: translateY(-20px) translateX(-50%);
            }

            60% {
                transform: translateY(-10px) translateX(-50%);
            }
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 1199.98px) {
            .carousel-controls {
                padding: 0 15px;
            }
            
            .carousel-control {
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
        }

        @media (max-width: 991.98px) {
            .hero-section {
                padding: 140px 0 80px;
            }
            
            .section-title {
                font-size: 2.8rem;
            }
            
            .section-subtitle {
                font-size: 1.1rem;
            }
            
            .carousel-controls {
                display: none;
            }
            
            .stat-card {
                padding: 30px 20px;
            }
            
            .feature-card {
                padding: 30px 20px;
            }
            
            .accordion-button,
            .accordion-body {
                padding: 20px;
            }
        }

        @media (max-width: 767.98px) {
            .hero-section {
                padding: 120px 0 60px;
                min-height: auto;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
                margin-bottom: 30px;
            }
            
            .ekskul-card {
                flex: 0 0 85%;
                height: 380px;
            }
            
            .ekskul-img {
                height: 180px;
            }
            
            .card-content {
                padding: 20px;
            }
            
            .card-title {
                font-size: 1.2rem;
            }
            
            .card-description {
                font-size: 13px;
                -webkit-line-clamp: 2;
            }
            
            .statistics-section,
            .features-section,
            .faq-section {
                padding: 80px 0;
            }
            
            .stat-card {
                padding: 25px 15px;
            }
            
            .stat-number {
                font-size: 2.2rem;
            }
            
            .footer-logo {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-section {
                padding: 100px 0 40px;
            }
            
            .navbar-brand {
                font-size: 1.4rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .section-subtitle {
                font-size: 0.95rem;
            }
            
            .ekskul-card {
                flex: 0 0 90%;
                height: 350px;
            }
            
            .ekskul-img {
                height: 150px;
            }
            
            .card-button {
                padding: 8px 20px;
                font-size: 13px;
            }
            
            .stat-card {
                padding: 20px 15px;
            }
            
            .stat-icon {
                width: 70px;
                height: 70px;
                font-size: 2.2rem;
            }
            
            .stat-number {
                font-size: 1.8rem;
            }
            
            .stat-title {
                font-size: 0.95rem;
            }
            
            .feature-card {
                padding: 25px 20px;
            }
            
            .feature-icon {
                font-size: 2rem;
                margin-bottom: 15px;
            }
            
            .feature-title {
                font-size: 1.2rem;
                margin-bottom: 15px;
            }
            
            .feature-desc {
                font-size: 0.9rem;
            }
            
            .accordion-button,
            .accordion-body {
                padding: 15px;
            }
            
            .accordion-button {
                font-size: 1rem;
            }
            
            .footer-logo {
                font-size: 1.6rem;
            }
            
            .footer-title {
                font-size: 1.2rem;
                margin-bottom: 20px;
            }
            
            .footer-links a {
                font-size: 0.9rem;
            }
            
            .contact-info p {
                font-size: 0.9rem;
            }
            
            .social-link {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .btn-login, .btn-outline-gold {
                padding: 8px 20px;
                font-size: 14px;
            }
            
            .nav-item {
                margin: 5px 0;
            }
            
            .nav-item.ms-3 {
                margin-left: 0 !important;
                margin-top: 10px;
            }
        }

        @media (max-width: 400px) {
            .section-title {
                font-size: 1.6rem;
            }
            
            .ekskul-card {
                height: 320px;
            }
            
            .card-button {
                padding: 6px 15px;
                font-size: 12px;
            }
            
            .stat-number {
                font-size: 1.6rem;
            }
        }

        /* Perbaikan khusus untuk orientasi landscape */
        @media (max-width: 992px) and (orientation: landscape) {
            .hero-section {
                padding: 100px 0 40px;
                min-height: auto;
            }
            
            .ekskul-carousel {
                margin: 30px 0;
            }
        }
    </style>
</head>

<body>
    <!-- Floating Elements -->
    <div class="floating-element" style="width: 300px; height: 300px; top: -100px; right: -100px;"></div>
    <div class="floating-element" style="width: 200px; height: 200px; bottom: 100px; left: -50px;"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('') }}assets/images/smk1.png" width="40" class="me-2" alt="logo">
                SMKN 1 Sumenep
            </a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#statistik">Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="/register" class="btn btn-outline-gold">
                            Daftar
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-login" href="/login">Masuk <i class="bi bi-arrow-right ms-2"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <i class="bi bi-chevron-down"></i>
        <span>SCROLL</span>
    </div>

    <!-- Hero Section with Ekstrakurikuler (Beranda) -->
    <section id="beranda" class="hero-section">
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-7 mb-5" data-aos="fade-right" data-aos-duration="1000">
                    <h3 class="section-title">Ekstrakurikuler SMK 1 SUMENEP</h3>
                    <p class="section-subtitle">Temukan dan kembangkan bakat Anda melalui kegiatan ekstrakurikuler
                        premium di SMKN 1 Sumenep. Program eksklusif kami dirancang untuk membentuk karakter dan
                        keahlian siswa.</p>
                    <a href="#statistik" class="btn btn-outline-gold mt-3">Jelajahi Lebih Lanjut</a>
                </div>
            </div>

            <div class="ekskul-carousel" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="carousel-container">
                    @foreach ($ekstrakurikulers as $ekskul)
                        <div class="ekskul-card">
                            <img src="{{ asset('storage/' . $ekskul->gambar) }}" class="ekskul-img"
                                alt="{{ $ekskul->nama_ekstrakurikuler }}">
                            <div class="card-content">
                                <h3 class="card-title">{{ $ekskul->nama_ekstrakurikuler }}</h3>
                                <div class="card-schedule">
                                    <i class="bi bi-clock-fill"></i>
                                    @if ($ekskul->jadwals->isNotEmpty())
                                        @foreach ($ekskul->jadwals as $jadwal)
                                            {{ $jadwal->hari }} ({{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">Belum ada jadwal</span>
                                    @endif
                                </div>
                                <p class="card-description">
                                    {{ \Illuminate\Support\Str::limit($ekskul->deskripsi, 120, '...') }}</p>
                                <a href="{{ route('ekstrakurikuler.show', $ekskul->id) }}"
                                    class="card-button text-decoration-none">Selengkapnya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel-controls">
                    <div class="carousel-control prev-btn">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="carousel-control next-btn">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section id="statistik" class="statistics-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="section-title mx-auto" style="color: var(--navy);">Prestasi Kami</h2>
                <p class="text-muted">Kualitas dan keunggulan dalam setiap kegiatan ekstrakurikuler</p>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="0">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-collection"></i>
                        </div>
                        <h3 class="stat-number">24</h3>
                        <p class="stat-title">Program Unggulan</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="1000"
                    data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3 class="stat-number">850</h3>
                        <p class="stat-title">Siswa Aktif</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="1000"
                    data-aos-delay="400">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <h3 class="stat-number">18</h3>
                        <p class="stat-title">Kegiatan Rutin</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="1000"
                    data-aos-delay="600">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <h3 class="stat-number">75</h3>
                        <p class="stat-title">Penghargaan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="features-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="section-title mx-auto" style="color: var(--navy);">Fitur Eksklusif</h2>
                <p class="text-muted">Pengalaman premium dalam pengembangan bakat siswa</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                    <div class="feature-card">
                        <i class="bi bi-calendar-plus feature-icon"></i>
                        <h3 class="feature-title">Pendaftaran Premium</h3>
                        <p class="feature-desc">Sistem pendaftaran eksklusif dengan prioritas akses dan konfirmasi
                            instan untuk pengalaman yang lebih personal.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="200">
                    <div class="feature-card">
                        <i class="bi bi-journal-text feature-icon"></i>
                        <h3 class="feature-title">Manajemen Jadwal</h3>
                        <p class="feature-desc">Sistem penjadwalan canggih dengan notifikasi real-time dan integrasi
                            kalender personal.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="400">
                    <div class="feature-card">
                        <i class="bi bi-person-badge feature-icon"></i>
                        <h3 class="feature-title">Pembina Profesional</h3>
                        <p class="feature-desc">Dibimbing oleh mentor berpengalaman dengan rekam jejak prestasi di
                            bidangnya masing-masing.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="200">
                    <div class="feature-card">
                        <i class="bi bi-award feature-icon"></i>
                        <h3 class="feature-title">Program Prestasi</h3>
                        <p class="feature-desc">Kurikulum terstruktur untuk memaksimalkan potensi siswa dalam kompetisi
                            dan ajang bergengsi.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="400">
                    <div class="feature-card">
                        <i class="bi bi-camera-video feature-icon"></i>
                        <h3 class="feature-title">Dokumentasi Profesional</h3>
                        <p class="feature-desc">Portofolio kegiatan dalam format high-quality untuk kebutuhan akademik
                            dan profesional.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="600">
                    <div class="feature-card">
                        <i class="bi bi-chat-dots feature-icon"></i>
                        <h3 class="feature-title">Konsultasi Eksklusif</h3>
                        <p class="feature-desc">Sesi konsultasi privat dengan pembina untuk pengembangan bakat yang
                            lebih terarah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="section-title mx-auto" style="color: var(--navy);">Informasi Penting</h2>
                <p class="text-muted">Pertanyaan yang sering diajukan tentang program eksklusif kami</p>
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="accordion" id="faqAccordion" data-aos="fade-up" data-aos-duration="1000"
                        data-aos-delay="200">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Bagaimana sistem seleksi untuk program eksklusif ini?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Program eksklusif kami memiliki proses seleksi bertahap yang mencakup penilaian
                                    minat, bakat, dan komitmen siswa. Tahap pertama adalah pendaftaran online, diikuti
                                    dengan sesi wawancara dengan pembina terkait, dan mungkin tes bakat khusus untuk
                                    beberapa program. Kami berkomitmen untuk memastikan setiap siswa ditempatkan di
                                    program yang paling sesuai dengan potensi mereka.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2">
                                    Apa keunggulan program ini dibanding ekskul biasa?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Program eksklusif kami menawarkan rasio mentor-siswa yang lebih kecil (maksimal
                                    1:10), kurikulum terstruktur dengan target pencapaian, akses ke fasilitas premium,
                                    pelatihan khusus untuk kompetisi, sertifikat resmi yang diakui industri, serta
                                    kesempatan untuk mengikuti berbagai event bergengsi. Selain itu, kami menyediakan
                                    laporan perkembangan berkala untuk memantau kemajuan siswa.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3">
                                    Apakah ada biaya tambahan untuk program eksklusif?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Program eksklusif kami memiliki kontribusi operasional yang disesuaikan dengan
                                    kebutuhan masing-masing program. Biaya ini mencakup pelatihan khusus, akses
                                    fasilitas premium, materi pelatihan, seragam khusus, dan pendampingan intensif.
                                    Namun, kami juga menyediakan skema beasiswa untuk siswa berprestasi dengan kondisi
                                    ekonomi terbatas. Informasi detail dapat diperoleh melalui konsultasi dengan tim
                                    kami.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4">
                                    Bagaimana sistem penilaian dan evaluasi peserta?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami menerapkan sistem penilaian komprehensif yang mencakup aspek keterampilan,
                                    kedisiplinan, perkembangan, dan kontribusi dalam kegiatan. Evaluasi dilakukan secara
                                    berkala setiap bulan dengan laporan tertulis, disertai sesi konsultasi personal
                                    dengan pembina. Di akhir program, siswa akan menerima sertifikat dengan penilaian
                                    terperinci yang dapat menjadi nilai tambah untuk portofolio akademik maupun
                                    profesional.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5">
                                    Apa saja fasilitas yang didapatkan peserta program?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Peserta program eksklusif mendapatkan akses ke berbagai fasilitas premium termasuk
                                    ruang latihan khusus, peralatan profesional, modul pelatihan eksklusif, seragam
                                    kegiatan, asuransi kegiatan, akses ke webinar dan workshop khusus, konsultasi
                                    pembinaan karir, serta kesempatan untuk mengikuti kompetisi bergengsi dengan biaya
                                    ditanggung sekolah. Fasilitas tambahan disesuaikan dengan kebutuhan masing-masing
                                    program.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
        }, { passive: false });
    </script>
</body>

</html>