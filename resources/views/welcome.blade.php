<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Plateforme Centralisée de Commerce Électronique Multi-Sites - Achetez auprès des meilleurs sites partenaires">
    <meta name="keywords" content="e-commerce, marketplace, shopping, multi-sites, produits variés">
    <meta name="author" content="E-Commerce Multi-Sites">
    <meta name="robots" content="index, follow">
    
    <title>Plateforme E-Commerce Multi-Sites | Achetez auprès des meilleurs partenaires</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|inter:300,400,500,600" rel="stylesheet" />

    <!-- Styles -->
    <style>
        :root {
            --color-gold: #D4AF37;
            --color-gold-light: #E8C966;
            --color-gold-dark: #B8962E;
            --color-beige: #F5F5DC;
            --color-beige-light: #FAF8F0;
            --color-beige-dark: #E8E4D4;
            --color-brown: #4A3728;
            --color-brown-light: #6B5344;
            --color-white: #FFFFFF;
            --color-off-white: #FEFEFE;
            --color-gray-100: #F7F7F7;
            --color-gray-200: #EFEFEF;
            --color-gray-300: #E0E0E0;
            --color-gray-400: #9E9E9E;
            --color-gray-500: #757575;
            --color-gray-600: #616161;
            --color-gray-700: #424242;
            --color-gray-800: #212121;
            --color-gray-900: #121212;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--color-gray-800);
            background-color: var(--color-beige-light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 32px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-primary {
            background-color: var(--color-gold);
            color: var(--color-white);
            border-color: var(--color-gold);
        }

        .btn-primary:hover {
            background-color: var(--color-gold-dark);
            border-color: var(--color-gold-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.35);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--color-brown);
            border-color: var(--color-brown);
        }

        .btn-secondary:hover {
            background-color: var(--color-brown);
            color: var(--color-white);
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--color-white);
            border-color: var(--color-white);
        }

        .btn-outline:hover {
            background-color: var(--color-white);
            color: var(--color-gold);
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: var(--color-white);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .header.scrolled {
            padding: 10px 0;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 0;
            transition: all 0.3s ease;
        }

        .header.scrolled .header-inner {
            padding: 10px 0;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--color-brown);
        }

        .logo span {
            color: var(--color-gold);
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .nav-link {
            font-size: 14px;
            font-weight: 500;
            color: var(--color-gray-700);
            position: relative;
            padding: 5px 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--color-gold);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--color-gold);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--color-beige-light);
            color: var(--color-brown);
            transition: all 0.3s ease;
        }

        .header-icon:hover {
            background-color: var(--color-gold);
            color: var(--color-white);
        }

        /* Mobile Menu */
        .mobile-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 10px;
        }

        .mobile-toggle span {
            width: 25px;
            height: 2px;
            background-color: var(--color-brown);
            transition: all 0.3s ease;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 100px;
            background: linear-gradient(135deg, var(--color-beige-light) 0%, var(--color-beige) 50%, var(--color-beige-dark) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 70%;
            height: 150%;
            background: radial-gradient(ellipse, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-text {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            padding: 8px 20px;
            background-color: var(--color-gold);
            color: var(--color-white);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-radius: 30px;
            margin-bottom: 24px;
            animation: fadeInUp 0.6s ease forwards;
        }

        .hero h1 {
            font-size: 56px;
            color: var(--color-brown);
            margin-bottom: 24px;
            animation: fadeInUp 0.6s ease 0.1s forwards;
            opacity: 0;
        }

        .hero p {
            font-size: 18px;
            color: var(--color-gray-600);
            margin-bottom: 40px;
            max-width: 480px;
            animation: fadeInUp 0.6s ease 0.2s forwards;
            opacity: 0;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            animation: fadeInUp 0.6s ease 0.3s forwards;
            opacity: 0;
        }

        .hero-image {
            position: relative;
            animation: fadeInRight 0.8s ease 0.4s forwards;
            opacity: 0;
        }

        .hero-image-main {
            width: 100%;
            height: 550px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 30px 60px rgba(74, 55, 40, 0.2);
        }

        .hero-image-badge {
            position: absolute;
            bottom: 40px;
            left: -30px;
            background-color: var(--color-white);
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            animation: float 3s ease-in-out infinite;
        }

        .hero-image-badge h4 {
            font-size: 14px;
            color: var(--color-gray-500);
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }

        .hero-image-badge strong {
            font-size: 28px;
            color: var(--color-gold);
            display: block;
            margin-top: 4px;
        }

        /* Categories Section */
        .categories {
            padding: 100px 0;
            background-color: var(--color-white);
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-tag {
            display: inline-block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--color-gold);
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 42px;
            color: var(--color-brown);
            margin-bottom: 16px;
        }

        .section-subtitle {
            font-size: 16px;
            color: var(--color-gray-500);
            max-width: 600px;
            margin: 0 auto;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .category-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background-color: var(--color-beige-light);
            transition: all 0.4s ease;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(74, 55, 40, 0.15);
        }

        .category-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(74, 55, 40, 0.8) 0%, transparent 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 24px;
        }

        .category-title {
            font-size: 22px;
            color: var(--color-white);
            margin-bottom: 8px;
        }

        .category-count {
            font-size: 14px;
            color: var(--color-gold-light);
        }

        .category-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--color-gold);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 12px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .category-card:hover .category-link {
            opacity: 1;
            transform: translateY(0);
        }

        .category-link:hover {
            color: var(--color-white);
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background-color: var(--color-beige-light);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .feature-card {
            background-color: var(--color-white);
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            border-color: var(--color-gold);
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--color-gold) 0%, var(--color-gold-light) 100%);
            border-radius: 50%;
            color: var(--color-white);
            font-size: 32px;
        }

        .feature-title {
            font-size: 20px;
            color: var(--color-brown);
            margin-bottom: 12px;
        }

        .feature-desc {
            font-size: 14px;
            color: var(--color-gray-500);
            line-height: 1.7;
        }

        /* Testimonials Section */
        .testimonials {
            padding: 100px 0;
            background-color: var(--color-brown);
            position: relative;
            overflow: hidden;
        }

        .testimonials::before {
            content: '"';
            position: absolute;
            top: 50px;
            left: 10%;
            font-size: 400px;
            font-family: 'Playfair Display', serif;
            color: rgba(255, 255, 255, 0.03);
            line-height: 1;
        }

        .testimonials .section-tag {
            color: var(--color-gold);
        }

        .testimonials .section-title {
            color: var(--color-white);
        }

        .testimonials .section-subtitle {
            color: rgba(255, 255, 255, 0.6);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            position: relative;
            z-index: 2;
        }

        .testimonial-card {
            background-color: rgba(255, 255, 255, 0.08);
            padding: 36px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            background-color: rgba(255, 255, 255, 0.12);
            transform: translateY(-5px);
        }

        .testimonial-stars {
            display: flex;
            gap: 4px;
            margin-bottom: 20px;
        }

        .testimonial-stars svg {
            width: 18px;
            height: 18px;
            fill: var(--color-gold);
        }

        .testimonial-text {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.8;
            margin-bottom: 24px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--color-gold);
        }

        .testimonial-name {
            font-size: 16px;
            color: var(--color-white);
            font-weight: 600;
            font-family: 'Inter', sans-serif;
        }

        .testimonial-role {
            font-size: 13px;
            color: var(--color-gold);
        }

        /* Newsletter Section */
        .newsletter {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--color-gold) 0%, var(--color-gold-dark) 100%);
            position: relative;
            overflow: hidden;
        }

        .newsletter::before {
            content: '';
            position: absolute;
            top: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .newsletter::after {
            content: '';
            position: absolute;
            bottom: -150px;
            right: -150px;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .newsletter-content {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .newsletter h2 {
            font-size: 36px;
            color: var(--color-white);
            margin-bottom: 16px;
        }

        .newsletter p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 32px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
            gap: 12px;
            background-color: var(--color-white);
            padding: 8px;
            border-radius: 50px;
        }

        .newsletter-input {
            flex: 1;
            padding: 14px 24px;
            border: none;
            background: transparent;
            font-size: 14px;
            outline: none;
        }

        .newsletter-input::placeholder {
            color: var(--color-gray-400);
        }

        .newsletter-btn {
            padding: 14px 32px;
            background-color: var(--color-brown);
            color: var(--color-white);
            border: none;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background-color: var(--color-gray-800);
            transform: scale(1.05);
        }

        /* Footer */
        .footer {
            background-color: var(--color-gray-900);
            color: var(--color-gray-300);
            padding: 80px 0 30px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        .footer-brand p {
            font-size: 14px;
            line-height: 1.8;
            margin-top: 20px;
            max-width: 300px;
            color: var(--color-gray-400);
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--color-white);
        }

        .footer-logo span {
            color: var(--color-gold);
        }

        .footer-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--color-white);
            margin-bottom: 24px;
            font-family: 'Inter', sans-serif;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            font-size: 14px;
            color: var(--color-gray-400);
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--color-gold);
            padding-left: 5px;
        }

        .footer-social {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--color-gray-800);
            border-radius: 50%;
            color: var(--color-gray-400);
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background-color: var(--color-gold);
            color: var(--color-white);
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid var(--color-gray-800);
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-copyright {
            font-size: 13px;
            color: var(--color-gray-500);
        }

        .footer-legal {
            display: flex;
            gap: 30px;
        }

        .footer-legal a {
            font-size: 13px;
            color: var(--color-gray-500);
        }

        .footer-legal a:hover {
            color: var(--color-gold);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero p {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-image {
                max-width: 600px;
                margin: 0 auto;
            }

            .hero-image-badge {
                left: 50%;
                transform: translateX(-50%);
                bottom: -20px;
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .features-grid,
            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .nav {
                display: none;
            }

            .mobile-toggle {
                display: flex;
            }

            .hero {
                padding-top: 120px;
                min-height: auto;
                padding-bottom: 80px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .hero-image-main {
                height: 350px;
            }

            .categories-grid,
            .features-grid,
            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 32px;
            }

            .newsletter-form {
                flex-direction: column;
                border-radius: 16px;
            }

            .newsletter-btn {
                width: 100%;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .footer-legal {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="container">
            <div class="header-inner">
                <a href="#" class="logo">E-Commerce <span>Multi-Sites</span></a>
                
                <nav class="nav">
                    <a href="#categories" class="nav-link">Catégories</a>
                    <a href="#features" class="nav-link">Avantages</a>
                    <a href="#testimonials" class="nav-link">Témoignages</a>
                    <a href="#newsletter" class="nav-link">Newsletter</a>
                </nav>

                <div class="header-actions">
                    <a href="#" class="header-icon" aria-label="Rechercher">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </a>
                    <a href="#" class="header-icon" aria-label="Panier">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    </a>
                    <div class="mobile-toggle" id="mobile-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="hero-badge">Plateforme N°1</span>
                    <h1>Votre Destination Shopping Unifiée</h1>
                    <p>Découvrez une expérience d'achat unique. Accédez à des milliers de produits de qualité auprès de nos sites partenaires fiables. Qualité, confiance et variety à portée de clic.</p>
                    <div class="hero-buttons">
                        <a href="#categories" class="btn btn-primary">Découvrir</a>
                        <a href="#features" class="btn btn-secondary">En savoir plus</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop" alt="E-Commerce Shopping" class="hero-image-main">
                    <div class="hero-image-badge">
                        <h4>Satisfait ou remboursé</h4>
                        <strong>30 jours</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories" id="categories">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Parcourir</span>
                <h2 class="section-title">Nos Catégories</h2>
                <p class="section-subtitle">Explorez notre large sélection de produits soigneusement triés sur le volet par nos partenaires de confiance.</p>
            </div>

            <div class="categories-grid">
                <!-- Category 1 -->
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?w=400&h=300&fit=crop" alt="Mode & Vêtements" class="category-image">
                    <div class="category-overlay">
                        <h3 class="category-title">Mode & Vêtements</h3>
                        <span class="category-count">2,500+ produits</span>
                        <a href="#" class="category-link">
                            Voir plus
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=300&fit=crop" alt="Électronique" class="category-image">
                    <div class="category-overlay">
                        <h3 class="category-title">Électronique</h3>
                        <span class="category-count">1,800+ produits</span>
                        <a href="#" class="category-link">
                            Voir plus
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?w=400&h=300&fit=crop" alt="Maison & Décoration" class="category-image">
                    <div class="category-overlay">
                        <h3 class="category-title">Maison & Décoration</h3>
                        <span class="category-count">3,200+ produits</span>
                        <a href="#" class="category-link">
                            Voir plus
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>

                <!-- Category 4 -->
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=400&h=300&fit=crop" alt="Beauté & Santé" class="category-image">
                    <div class="category-overlay">
                        <h3 class="category-title">Beauté & Santé</h3>
                        <span class="category-count">1,500+ produits</span>
                        <a href="#" class="category-link">
                            Voir plus
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Pourquoi nous choisir</span>
                <h2 class="section-title">Nos Avantages</h2>
                <p class="section-subtitle">Nous nous engageons à vous offrir la meilleure expérience d'achat en ligne.</p>
            </div>

            <div class="features-grid">
                <!-- Feature 1 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <h3 class="feature-title">Livraison Gratuite</h3>
                    <p class="feature-desc">Profitez de la livraison gratuite sur toutes vos commandes supérieures à 50€. Recevez vos produits directement chez vous sans frais supplémentaires.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </div>
                    <h3 class="feature-title">Retours Faciles</h3>
                    <p class="feature-desc">Changez d'avis sans souci. Bénéficiez de retours gratuits sous 30 jours pour tous vos achats. Nous facilitons vos retours.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                    <h3 class="feature-title">Paiement Sécurisé</h3>
                    <p class="feature-desc">Vos transactions sont 100% sécurisées. Nous utilisons les dernières technologies de cryptage pour protéger vos données.</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    </div>
                    <h3 class="feature-title">Support 24/7</h3>
                    <p class="feature-desc">Notre équipe de support est disponible à tout moment pour répondre à vos questions et vous assister.</p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <h3 class="feature-title">Produits de Qualité</h3>
                    <p class="feature-desc">Nous sélectionnons rigoureusement nos partenaires pour vous garantir des produits de qualité supérieure.</p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <h3 class="feature-title">Livraison Rapide</h3>
                    <p class="feature-desc">Recevez vos commandes en 24-48h. Nous collaborons avec les meilleurs transporteurs pour la rapidité.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Témoignages</span>
                <h2 class="section-title">Ce que disent nos clients</h2>
                <p class="section-subtitle">Découvrez les avis de notre communauté satisfaite.</p>
            </div>

            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <p class="testimonial-text">"Une expérience d'achat exceptionnelle ! La variété des produits et la qualité du service client sont incomparables. Je recommande fortement cette plateforme."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="Sophie Martin" class="testimonial-avatar">
                        <div>
                            <h4 class="testimonial-name">Sophie Martin</h4>
                            <span class="testimonial-role">Cliente fidèle</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <p class="testimonial-text">"Livraison ultra rapide et produits conformes aux descriptions. C'est ma plateforme préférée pour mes achats en ligne. Le service est impeccable."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" alt="Thomas Dubois" class="testimonial-avatar">
                        <div>
                            <h4 class="testimonial-name">Thomas Dubois</h4>
                            <span class="testimonial-role">Nouveau client</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <p class="testimonial-text">"Le meilleur site e-commerce que j'ai utilisé. La qualité des produits et le service après-vente sont remarquables. Je suis cliente depuis 2 ans et je ne suis jamais déçue."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop" alt="Marie Lambert" class="testimonial-avatar">
                        <div>
                            <h4 class="testimonial-name">Marie Lambert</h4>
                            <span class="testimonial-role">Cliente fidèle</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter" id="newsletter">
        <div class="container">
            <div class="newsletter-content">
                <h2>Restez informé de nos offres</h2>
                <p>Inscrivez-vous à notre newsletter pour recevoir en avant-première nos offres exclusives, nos nouveaux produits et nosActualités.</p>
                <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Merci pour votre inscription !');">
                    <input type="email" class="newsletter-input" placeholder="Votre adresse email" required>
                    <button type="submit" class="newsletter-btn">S'inscrire</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">E-Commerce <span>Multi-Sites</span></div>
                    <p>Votre plateforme de shopping unifiée. Nous réunissons les meilleurs sites partenaires pour vous offrir une expérience d'achat exceptionnelle.</p>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        </a>
                        <a href="#" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                        </a>
                        <a href="#" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                        <a href="#" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                        </a>
                    </div>
                </div>

                <div class="footer-column">
                    <h4 class="footer-title">Liens Rapides</h4>
                    <ul class="footer-links">
                        <li><a href="#home">Accueil</a></li>
                        <li><a href="#categories">Catégories</a></li>
                        <li><a href="#features">Avantages</a></li>
                        <li><a href="#testimonials">Témoignages</a></li>
                        <li><a href="#newsletter">Newsletter</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-title">Service Client</h4>
                    <ul class="footer-links">
                        <li><a href="#">Centre d'aide</a></li>
                        <li><a href="#">Suivre ma commande</a></li>
                        <li><a href="#">Retours & Échanges</a></li>
                        <li><a href="#">Livraison</a></li>
                        <li><a href="#">Nous contacter</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-title">Informations</h4>
                    <ul class="footer-links">
                        <li><a href="#">À propos de nous</a></li>
                        <li><a href="#">Carrières</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Partenariats</a></li>
                        <li><a href="#">Presse</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2024 E-Commerce Multi-Sites. Tous droits réservés.</p>
                <div class="footer-legal">
                    <a href="#">Politique de confidentialité</a>
                    <a href="#">Conditions générales</a>
                    <a href="#">Mentions légales</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Header scroll effect
        const header = document.getElementById('header');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Mobile menu toggle (placeholder - can be expanded)
        const mobileToggle = document.getElementById('mobile-toggle');
        
        mobileToggle.addEventListener('click', () => {
            // Add mobile menu functionality here
            console.log('Mobile menu toggle');
        });
    </script>
</body>
</html>
