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

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream);
            overflow-x: hidden;
            scroll-behavior: smooth;
            color: #333;
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
            height: 42px;
            margin-right: 12px;
            transition: all 0.4s ease;
            filter: brightness(0) invert(1);
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

        /* Main Content Container */
        .main-content-container {
            margin-top: 100px;
            padding: 0;
            max-width: 100%;
            width: 100%;
        }

        /* Ekskul Profile Full Width */
        .ekskul-profile {
            background: white;
            border-radius: 0;
            box-shadow: none;
            overflow: hidden;
            margin-bottom: 0;
            width: 100%;
        }

        /* Header Section */
        .ekskul-header {
            position: relative;
            width: 100%;
        }

        .ekskul-cover {
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
            width: 100%;
        }

        .ekskul-cover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(transparent 60%, rgba(0, 0, 0, 0.7));
        }

        .ekskul-title {
            position: absolute;
            bottom: 50px;
            left: 0;
            width: 100%;
            padding: 0 5%;
            color: white;
            z-index: 2;
        }

        .ekskul-title h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            font-size: 3rem;
        }

        .badge-kategori {
            background: var(--gold);
            color: var(--navy);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
        }

        /* Content Section */
        .ekskul-content {
            padding: 60px 5%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .info-section {
            margin-bottom: 40px;
        }

        .info-section h4 {
            font-family: 'Playfair Display', serif;
            color: var(--navy);
            border-bottom: 2px solid var(--gold);
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            font-size: 1.8rem;
        }

        .info-section h4 i {
            margin-right: 15px;
            color: var(--gold);
            font-size: 1.8rem;
        }

        /* Description Box */
        .description-box {
            background: rgba(165, 215, 232, 0.1);
            border-radius: 8px;
            padding: 25px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .description-box p {
            white-space: pre-line;
            text-align: justify;
            line-height: 1.8;
            margin-bottom: 0;
            word-wrap: break-word;
            font-size: 1.1rem;
            color: #555;
        }

        /* Prestasi Container */
        .prestasi-container {
            max-height: 600px;
            overflow-y: auto;
            padding-right: 15px;
        }

        /* Custom Scrollbar */
        .prestasi-container::-webkit-scrollbar {
            width: 8px;
        }

        .prestasi-container::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        .prestasi-container::-webkit-scrollbar-thumb {
            background: var(--gold);
            border-radius: 10px;
        }

        .prestasi-container::-webkit-scrollbar-thumb:hover {
            background: var(--gold-light);
        }

        /* Prestasi List */
        .prestasi-list {
            border-left: 3px solid var(--gold);
            padding-left: 30px;
            padding-bottom: 10px;
        }

        .prestasi-item {
            display: flex;
            margin-bottom: 30px;
            position: relative;
            padding-right: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .prestasi-item:hover {
            transform: translateX(5px);
        }

        .prestasi-year {
            background: var(--navy);
            color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.4rem;
            flex-shrink: 0;
            margin-right: 25px;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .prestasi-item:hover .prestasi-year {
            background: var(--gold);
            color: var(--navy);
            transform: scale(1.05);
        }

        .prestasi-detail {
            background: rgba(165, 215, 232, 0.1);
            padding: 20px 25px;
            border-radius: 8px;
            flex-grow: 1;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .prestasi-item:hover .prestasi-detail {
            background: rgba(165, 215, 232, 0.2);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .prestasi-detail h5 {
            color: var(--navy);
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .prestasi-detail p {
            color: #666;
            margin-bottom: 0;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Sidebar Info */
        .sidebar-info {
            position: sticky;
            top: 120px;
        }

        .info-box {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .info-box h4 {
            font-family: 'Playfair Display', serif;
            color: var(--navy);
            font-size: 1.4rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            border-bottom: 2px solid var(--gold);
            padding-bottom: 10px;
        }

        .info-box h4 i {
            margin-right: 15px;
            color: var(--gold);
            font-size: 1.4rem;
        }

        .info-box ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-box ul li {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
        }

        .info-box ul li:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-box ul li i {
            color: var(--gold);
            margin-right: 15px;
            font-size: 1.2rem;
            margin-top: 3px;
        }

        .info-box ul li strong {
            color: var(--navy);
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .info-box ul li p {
            margin: 0;
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Gallery Preview */
        .gallery-preview {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .gallery-preview img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .gallery-preview img:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Back Button */
        .btn-back {
            background: var(--navy);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-top: 20px;
            border: none;
        }

        .btn-back i {
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: var(--primary);
            color: white;
            transform: translateX(-5px);
        }

        .btn-back:hover i {
            margin-right: 12px;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--navy), var(--primary));
            color: white;
            border-bottom: 3px solid var(--gold);
            border-radius: 12px 12px 0 0;
            padding: 25px 30px;
        }

        .modal-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            margin: 0;
            font-size: 1.8rem;
        }

        .btn-close {
            filter: brightness(0) invert(1);
            font-size: 1.2rem;
        }

        .modal-body {
            padding: 30px;
        }

        .info-group {
            margin-bottom: 25px;
        }

        .info-group h5 {
            color: var(--navy);
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            font-size: 1.2rem;
        }

        .info-group h5 i {
            margin-right: 12px;
            color: var(--gold);
            font-size: 1.3rem;
        }

        .info-group p {
            color: #555;
            margin-bottom: 0;
            padding-left: 35px;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .prestasi-image {
            margin-top: 15px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #eee;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .prestasi-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .modal-footer {
            border-top: 1px solid #eee;
            padding: 20px 30px;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--navy), var(--primary));
            padding: 80px 0 40px;
            color: white;
            position: relative;
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

        /* Responsive Design */
        @media (max-width: 1199px) {
            .ekskul-title h2 {
                font-size: 2.5rem;
            }

            .info-section h4 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 991px) {
            .ekskul-cover {
                height: 350px;
            }

            .ekskul-title {
                bottom: 40px;
            }

            .ekskul-title h2 {
                font-size: 2.2rem;
            }

            .prestasi-item {
                flex-direction: column;
            }

            .prestasi-year {
                margin-bottom: 15px;
                margin-right: 0;
                width: 70px;
                height: 70px;
            }

            .sidebar-info {
                margin-top: 50px;
            }
        }

        @media (max-width: 767px) {
            .ekskul-cover {
                height: 300px;
            }

            .ekskul-title h2 {
                font-size: 2rem;
            }

            .ekskul-content {
                padding: 40px 5%;
            }

            .info-section h4 {
                font-size: 1.4rem;
            }

            .description-box p {
                font-size: 1rem;
            }

            .prestasi-detail h5 {
                font-size: 1.1rem;
            }

            .prestasi-detail p {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 575px) {
            .ekskul-cover {
                height: 250px;
            }

            .ekskul-title h2 {
                font-size: 1.8rem;
            }

            .badge-kategori {
                font-size: 0.8rem;
            }

            .info-box {
                padding: 20px;
            }

            .info-box h4 {
                font-size: 1.2rem;
            }

            .modal-title {
                font-size: 1.4rem;
            }

            .info-group h5 {
                font-size: 1.1rem;
            }

            .info-group p {
                font-size: 0.95rem;
                padding-left: 30px;
            }
        }

        /* Sidebar Styles */
        .sidebar-info {
            position: sticky;
            top: 120px;
            display: grid;
            gap: 25px;
        }

        .info-box {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .info-box-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        .info-box-header i {
            font-size: 1.6rem;
            color: var(--gold);
            margin-right: 15px;
        }

        .info-box-header h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--navy);
            margin: 0;
            font-size: 1.3rem;
        }

        .badge-schedule {
            background: rgba(10, 180, 110, 0.1);
            color: #0AB46E;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: auto;
        }

        .view-all {
            font-size: 0.85rem;
            color: var(--gold);
            text-decoration: none;
            margin-left: auto;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            color: var(--navy);
            text-decoration: underline;
        }

        /* Schedule Timeline */
        .schedule-timeline {
            padding: 10px 0;
        }

        .schedule-item {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .schedule-item:last-child {
            border-bottom: none;
        }

        .schedule-icon {
            width: 40px;
            height: 40px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            color: var(--gold);
            font-size: 1.1rem;
        }

        .schedule-detail {
            flex-grow: 1;
        }

        .schedule-day,
        .schedule-location {
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 3px;
        }

        .schedule-time,
        .schedule-room {
            color: #666;
            font-size: 0.9rem;
        }

        .schedule-footer {
            margin-top: 20px;
        }

        .btn-add-calendar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold);
            padding: 10px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-add-calendar i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .btn-add-calendar:hover {
            background: var(--gold);
            color: white;
        }

        /* Mentor List */
        .mentor-list {
            margin-top: 15px;
        }

        .mentor-item {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .mentor-item:last-child {
            border-bottom: none;
        }

        .mentor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 3px solid rgba(212, 175, 55, 0.2);
        }

        .mentor-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mentor-info {
            flex-grow: 1;
        }

        .mentor-name {
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 3px;
            font-size: 1rem;
        }

        .mentor-role {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .mentor-contacts a {
            color: var(--gold);
            margin-right: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .mentor-contacts a:hover {
            color: var(--navy);
        }

        /* Stats Box */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background: rgba(165, 215, 232, 0.1);
            border-radius: 8px;
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--navy);
            line-height: 1;
            margin-bottom: 5px;
            background: linear-gradient(135deg, var(--navy), var(--gold));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #666;
        }

        .progress-container {
            margin-top: 25px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.85rem;
            color: #666;
        }

        .progress {
            height: 8px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            border-radius: 10px;
        }

        /* Gallery Box */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 15px;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 1/1;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 26, 58, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
            color: white;
            font-size: 1.5rem;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .sidebar-info {
                margin-top: 50px;
                position: static;
            }

            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 767px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .info-box {
                padding: 20px;
            }
        }

        @media (max-width: 575px) {
            .info-box-header h4 {
                font-size: 1.1rem;
            }

            .mentor-avatar {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/api/placeholder/50/50" width="40" class="me-2" alt="logo">
                SMKN 1 Sumenep
            </a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
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
                    <li class="nav-item ms-3">
                        <a href="" class="btn btn-outline-gold">
                            Daftar
                        </a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-login" href="/login">Masuk <i class="bi bi-arrow-right ms-2"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="main-content-container">
        <!-- Ekskul Profile Section -->
        <div class="ekskul-profile">
            <!-- Header Section -->
            <div class="ekskul-header">
                <div class="ekskul-cover"
                    style="background-image: url('{{ asset('storage/' . $ekstrakurikuler->Gambar) }}')"></div>
                <div class="ekskul-title">
                    <h2>Ekstrakurikuler {{ $ekstrakurikuler->nama_ekstrakurikuler }}</h2>
                    <span class="badge-kategori">Kegiatan {{ $ekstrakurikuler->jenis }}</span>
                </div>
            </div>

            <!-- Content Section -->
            <div class="ekskul-content">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Deskripsi Kegiatan -->
                        <div class="info-section">
                            <h4><i class="bi bi-info-circle"></i> Deskripsi Kegiatan</h4>
                            <div class="description-box">
                                <p>{{ $ekstrakurikuler->Deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Prestasi -->
                        <div class="info-section">
                            <h4><i class="bi bi-trophy"></i> Prestasi</h4>
                            <div class="prestasi-container">
                                <div class="prestasi-list">
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2023</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 1 Lomba Tingkat III Kwarcab Sumenep</h5>
                                            <p>Lomba Pionering dan Sandi Morse</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2023</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 2 Jambore Regional Jawa Timur</h5>
                                            <p>Kategori Keterampilan Pioneering</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2022</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara Harapan 1 Jambore Daerah Jawa Timur</h5>
                                            <p>Kategori Penggalang Tegak</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2022</div>
                                        <div class="prestasi-detail">
                                            <h5>Peserta Terbaik Perkemahan Bakti</h5>
                                            <p>Kegiatan Tingkat Kabupaten</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2021</div>
                                        <div class="prestasi-detail">
                                            <h5>Peserta Terbaik Perkemahan Wirakarya</h5>
                                            <p>Kegiatan Kepramukaan Tingkat Nasional</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2021</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 3 Lomba Cerdas Cermat Pramuka</h5>
                                            <p>Tingkat Kecamatan</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2020</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 1 Lomba Keterampilan Baris Berbaris</h5>
                                            <p>HUT Pramuka Ke-59</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal"
                                        data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2020</div>
                                        <div class="prestasi-detail">
                                            <h5>Peserta Teraktif Kegiatan Virtual Pramuka</h5>
                                            <p>Masa Pandemi COVID-19</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal"
                                        data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2019</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara Umum Perkemahan Sabtu Minggu</h5>
                                            <p>Kegiatan Gabungan Sekolah Se-Kabupaten</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal"
                                        data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2019</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 2 Lomba Kreasi Seni Pramuka</h5>
                                            <p>Festival Pramuka Kabupaten</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <a href="/" class="btn btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Ekskul
                        </a>
                    </div>

                    <!-- Sidebar Info -->

                    <div class="col-lg-4">
                        <div class="sidebar-info">
                            <!-- Jadwal Kegiatan Box -->
                            <div class="info-box schedule-box">
                                <div class="info-box-header">
                                    <i class="bi bi-calendar-week"></i>
                                    <h4>Jadwal Kegiatan & detail</h4>
                                    <span class="badge-schedule">{{ $ekstrakurikuler->Periode }}</span>
                                </div>

                                <div class="schedule-timeline">
                                    <div class="schedule-timeline">
                                        @foreach ($ekstrakurikuler->jadwals as $jadwal)
                                            <div class="schedule-item">
                                                <div class="schedule-icon">
                                                    <i class="bi bi-clock"></i>
                                                </div>
                                                <div class="schedule-detail">
                                                    <div class="schedule-day">{{ $jadwal->hari }}</div>
                                                    <div class="schedule-time">{{ $jadwal->jam_mulai }} -
                                                        {{ $jadwal->jam_selesai }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="schedule-item">
                                        <div class="schedule-icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div class="schedule-detail">
                                            <div class="schedule-location">Tempat kegiatan</div>
                                            <div class="schedule-room">{{ $ekstrakurikuler->Lokasi }}</div>
                                        </div>
                                    </div>
                                    <div class="schedule-item">
                                        <div class="schedule-icon">
                                            <i class="bi bi-credit-card"></i>
                                        </div>
                                        <div class="schedule-detail">
                                            <div class="schedule-location">Kategori</div>
                                            <div class="schedule-kategori">
                                                {{ $ekstrakurikuler->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Pembina Box -->
                            <div class="info-box mentor-box">
                                <div class="info-box-header">
                                    <i class="bi bi-person-badge"></i>
                                    <h4>guru pembimbing</h4>
                                </div>

                                <div class="mentor-list">
                                    <div class="mentor-item">
                                        <div class="mentor-avatar">
                                            <img src="{{ asset('assets/images/users/user-dummy-img.jpg') }}"
                                                alt="Pembina">
                                        </div>
                                        <div class="mentor-info">
                                            @if ($ekstrakurikuler->user)
                                                <h5 class="mentor-name">{{ $ekstrakurikuler->user->name }}</h5>
                                                <p class="mentor-role">Guru pembimbing</p>
                                            @else
                                                <p class="text-muted">Belum ada pembimbing</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistik Box -->
                            <div class="info-box stats-box">
                                <div class="info-box-header">
                                    <i class="bi bi-graph-up"></i>
                                    <h4>Statistik</h4>
                                </div>

                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <div class="stat-value">{{ $ekstrakurikuler->jumlah_anggota ?? 0 }}</div>
                                        <div class="stat-label">Anggota Diterima</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-value">12</div>
                                        <div class="stat-label">Prestasi</div>
                                    </div>
                                </div>

                                @if ($ekstrakurikuler->jenis === 'wajib')
                                    <div class="alert alert-info mt-2">
                                        <i class="bi bi-info-circle"></i> Ekstrakurikuler wajib — kuota tidak dibatasi.
                                    </div>
                                @else
                                    <div class="progress-container">
                                        <div class="progress-info">
                                            <span>Kuota Tersedia</span>
                                            <span>{{ $ekstrakurikuler->sisa_kuota }}/{{ $ekstrakurikuler->kuota }}</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar"
                                                style="width: {{ $ekstrakurikuler->persentase_kuota }}%;
                       background-color: {{ $ekstrakurikuler->persentase_kuota >= 100 ? '#dc3545' : '#28a745' }};">
                                            </div>
                                        </div>
                                        <div class="progress-text text-center mt-2 small">
                                            @if ($ekstrakurikuler->persentase_kuota >= 100)
                                                <span class="text-danger"><i class="bi bi-exclamation-circle"></i>
                                                    Kuota Penuh!</span>
                                            @else
                                                <span class="text-success">{{ $ekstrakurikuler->sisa_kuota }} tempat
                                                    tersisa</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prestasi Modal -->
    <div class="modal fade" id="prestasiModal" tabindex="-1" aria-labelledby="prestasiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="prestasiModalLabel">Detail Prestasi</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group mb-4">
                                <h5><i class="bi bi-trophy-fill"></i> Nama Kegiatan</h5>
                                <p>Juara 1 Lomba Tingkat III Kwarcab Sumenep</p>
                            </div>

                            <div class="info-group mb-4">
                                <h5><i class="bi bi-award-fill"></i> Peringkat</h5>
                                <p>Juara 1</p>
                            </div>

                            <div class="info-group mb-4">
                                <h5><i class="bi bi-calendar-date-fill"></i> Tanggal Kejuaraan</h5>
                                <p>15 Agustus 2023</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-group mb-4">
                                <h5><i class="bi bi-globe"></i> Tingkat Kejuaraan</h5>
                                <p>Kabupaten</p>
                            </div>

                            <div class="info-group mb-4">
                                <h5><i class="bi bi-card-text"></i> Deskripsi</h5>
                                <p>Lomba pionering dan sandi morse yang diikuti oleh 30 sekolah se-Kabupaten Sumenep.
                                    Tim kami berhasil menyelesaikan semua tantangan dengan sempurna dalam waktu
                                    tercepat.</p>
                            </div>

                            <div class="info-group">
                                <h5><i class="bi bi-image-fill"></i> Dokumentasi</h5>
                                <div class="prestasi-image">
                                    <img src="https://via.placeholder.com/800x500" alt="Foto Prestasi"
                                        class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

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
                    style="color: var(--gold);"></i> for Excellence
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

        // Initialize all modals
        document.querySelectorAll('.prestasi-item').forEach(item => {
            item.addEventListener('click', function() {
                // In a real implementation, you would fetch and populate modal content here
                // based on the clicked item's data attributes
            });
        });
    </script>
</body>

</html>
