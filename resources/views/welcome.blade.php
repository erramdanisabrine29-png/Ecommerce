<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ORDA - Plateforme centralisée de commerce électronique multi-sites. Gérez toutes vos commandes e-commerce depuis une seule interface performante et sécurisée.">
    <meta name="keywords" content="ORDA, e-commerce, multi-sites, gestion commandes, dashboard, plateforme entreprise, solution e-commerce">
    <meta name="author" content="ORDA">
    <meta name="robots" content="index, follow">
    
    <title>ORDA – Plateforme E-Commerce Multi-Sites | Centralisez et Optimisez Vos Ventes</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    <style>
        :root {
            --color-black: #0A0A0A;
            --color-black-light: #1A1A1A;
            --color-black-medium: #2D2D2D;
            --color-white: #FFFFFF;
            --color-white-off: #F8F8F8;
            --color-white-light: #F5F5F5;
            --color-gold: #D4AF37;
            --color-gold-light: #E8C966;
            --color-gold-dark: #B8962E;
            --color-gold-muted: #C9A962;
            --color-gray-100: #F3F3F3;
            --color-gray-200: #E5E5E5;
            --color-gray-300: #CCCCCC;
            --color-gray-400: #999999;
            --color-gray-500: #666666;
            --color-gray-600: #444444;
            --color-gray-700: #333333;
            --color-success: #22C55E;
            --color-info: #3B82F6;
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--color-black);
            background-color: var(--color-white);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.02em;
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
            padding: 0 24px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 32px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .btn-primary {
            background-color: var(--color-gold);
            color: var(--color-black);
            border-color: var(--color-gold);
        }

        .btn-primary:hover {
            background-color: var(--color-gold-dark);
            border-color: var(--color-gold-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--color-white);
            border-color: var(--color-white);
        }

        .btn-secondary:hover {
            background-color: var(--color-white);
            color: var(--color-black);
            transform: translateY(-2px);
        }

        .btn-dark {
            background-color: var(--color-black);
            color: var(--color-white);
            border-color: var(--color-black);
        }

        .btn-dark:hover {
            background-color: var(--color-black-light);
            border-color: var(--color-black-light);
            transform: translateY(-2px);
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 0;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            color: var(--color-black);
            letter-spacing: -0.03em;
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
            color: var(--color-gray-600);
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--color-gold);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--color-black);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 120px;
            padding-bottom: 100px;
            background: linear-gradient(180deg, var(--color-white) 0%, var(--color-white-off) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: radial-gradient(ellipse at top right, rgba(212, 175, 55, 0.08) 0%, transparent 60%);
            pointer-events: none;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 80px;
            align-items: center;
        }

        .hero-text {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: var(--color-white);
            border: 1px solid var(--color-gray-200);
            color: var(--color-gray-600);
            font-size: 13px;
            font-weight: 600;
            border-radius: 50px;
            margin-bottom: 32px;
        }

        .hero-badge-dot {
            width: 8px;
            height: 8px;
            background-color: var(--color-success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .hero h1 {
            font-size: 56px;
            color: var(--color-black);
            margin-bottom: 24px;
            line-height: 1.1;
        }

        .hero h1 span {
            color: var(--color-gold);
        }

        .hero p {
            font-size: 18px;
            color: var(--color-gray-500);
            margin-bottom: 40px;
            max-width: 500px;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
        }

        .hero-image {
            position: relative;
        }

        .dashboard-mockup {
            background-color: var(--color-white);
            border-radius: 16px;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            border: 1px solid var(--color-gray-200);
        }

        .dashboard-header {
            background-color: var(--color-black);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dashboard-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .dashboard-dot.red { background-color: #FF5F57; }
        .dashboard-dot.yellow { background-color: #FEBC2E; }
        .dashboard-dot.green { background-color: #28C840; }

        .dashboard-body {
            padding: 24px;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .dashboard-stat {
            background-color: var(--color-white-off);
            padding: 16px;
            border-radius: 12px;
            border: 1px solid var(--color-gray-100);
        }

        .dashboard-stat-label {
            font-size: 12px;
            color: var(--color-gray-400);
            margin-bottom: 4px;
        }

        .dashboard-stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--color-black);
        }

        .dashboard-stat-value.gold {
            color: var(--color-gold);
        }

        .dashboard-chart {
            background-color: var(--color-white-off);
            border-radius: 12px;
            padding: 20px;
            height: 200px;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            border: 1px solid var(--color-gray-100);
        }

        .chart-bar {
            width: 40px;
            background: linear-gradient(180deg, var(--color-gold) 0%, var(--color-gold-light) 100%);
            border-radius: 4px 4px 0 0;
            transition: all 0.3s ease;
        }

        .chart-bar:hover {
            background: var(--color-gold-dark);
        }

        /* Problem & Solution */
        .problem-solution {
            padding: 120px 0;
            background-color: var(--color-white);
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 80px;
        }

        .section-tag {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--color-gold);
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 44px;
            color: var(--color-black);
            margin-bottom: 20px;
        }

        .section-subtitle {
            font-size: 18px;
            color: var(--color-gray-500);
        }

        .problem-grid, .solution-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }

        .problem-card {
            background-color: var(--color-white-off);
            padding: 40px;
            border-radius: 16px;
            border: 1px solid var(--color-gray-100);
            transition: all 0.3s ease;
        }

        .problem-card:hover {
            border-color: var(--color-gray-300);
            transform: translateY(-4px);
        }

        .problem-icon {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(239, 68, 68, 0.1);
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .problem-card h3, .solution-card h3 {
            font-size: 20px;
            margin-bottom: 12px;
            color: var(--color-black);
        }

        .problem-card p, .solution-card p {
            font-size: 15px;
            color: var(--color-gray-500);
            line-height: 1.7;
        }

        .solution-card {
            background-color: var(--color-white);
            padding: 40px;
            border-radius: 16px;
            border: 2px solid var(--color-gold);
            transition: all 0.3s ease;
        }

        .solution-card:hover {
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.15);
            transform: translateY(-4px);
        }

        .solution-icon {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--color-gold);
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 24px;
        }

        /* Roles Section */
        .roles {
            padding: 120px 0;
            background-color: var(--color-black);
            position: relative;
            overflow: hidden;
        }

        .roles::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(ellipse at top left, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .roles .section-tag {
            color: var(--color-gold);
        }

        .roles .section-title {
            color: var(--color-white);
        }

        .roles .section-subtitle {
            color: var(--color-gray-400);
        }

        .roles-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            position: relative;
            z-index: 2;
        }

        .role-card {
            background-color: var(--color-black-light);
            padding: 40px 32px;
            border-radius: 16px;
            border: 1px solid var(--color-gray-700);
            text-align: center;
            transition: all 0.3s ease;
        }

        .role-card:hover {
            border-color: var(--color-gold);
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.2);
        }

        .role-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--color-gold) 0%, var(--color-gold-dark) 100%);
            border-radius: 50%;
            font-size: 32px;
        }

        .role-card h3 {
            font-size: 22px;
            color: var(--color-white);
            margin-bottom: 12px;
        }

        .role-card p {
            font-size: 14px;
            color: var(--color-gray-400);
            line-height: 1.6;
        }

        /* Performance Section */
        .performance {
            padding: 120px 0;
            background-color: var(--color-white);
        }

        .performance-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
        }

        .performance-card {
            text-align: center;
            padding: 48px 32px;
            border-radius: 16px;
            background-color: var(--color-white);
            border: 1px solid var(--color-gray-100);
            transition: all 0.3s ease;
        }

        .performance-card:hover {
            border-color: var(--color-gold);
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
        }

        .performance-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--color-white-off);
            border-radius: 50%;
            font-size: 28px;
        }

        .performance-card h3 {
            font-size: 20px;
            color: var(--color-black);
            margin-bottom: 12px;
        }

        .performance-card p {
            font-size: 14px;
            color: var(--color-gray-500);
            line-height: 1.7;
        }

        /* Timeline Section */
        .timeline-section {
            padding: 120px 0;
            background-color: var(--color-white-off);
        }

        .timeline {
            display: flex;
            justify-content: space-between;
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--color-gold), var(--color-gold-dark));
        }

        .timeline-item {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .timeline-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--color-white);
            border: 3px solid var(--color-gold);
            border-radius: 50%;
            font-size: 28px;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .timeline-item:hover .timeline-icon {
            background-color: var(--color-gold);
            transform: scale(1.1);
        }

        .timeline-item h3 {
            font-size: 18px;
            color: var(--color-black);
            margin-bottom: 8px;
        }

        .timeline-item p {
            font-size: 14px;
            color: var(--color-gray-500);
            max-width: 180px;
            margin: 0 auto;
        }

        /* FAQ Section */
        .faq-section {
            padding: 120px 0;
            background-color: var(--color-white);
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .faq-item {
            background-color: var(--color-white-off);
            border-radius: 16px;
            padding: 32px;
            border: 1px solid var(--color-gray-100);
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: var(--color-gold);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .faq-question {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .faq-icon {
            font-size: 14px;
            color: var(--color-gold);
            margin-top: 4px;
        }

        .faq-question h3 {
            font-size: 18px;
            color: var(--color-black);
            font-weight: 600;
        }

        .faq-answer p {
            font-size: 15px;
            color: var(--color-gray-500);
            line-height: 1.7;
            padding-left: 26px;
        }

        .faq-answer strong {
            color: var(--color-gold);
        }

        /* CTA Section */
        .cta {
            padding: 120px 0;
            background: linear-gradient(135deg, var(--color-black) 0%, var(--color-black-light) 100%);
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(ellipse at center, rgba(212, 175, 55, 0.15) 0%, transparent 60%);
        }

        .cta-content {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .cta h2 {
            font-size: 48px;
            color: var(--color-white);
            margin-bottom: 24px;
        }

        .cta p {
            font-size: 20px;
            color: var(--color-gray-400);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-phone {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            color: var(--color-gold);
            font-weight: 600;
            margin-bottom: 32px;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        /* Footer */
        .footer {
            background-color: var(--color-black);
            padding: 60px 0 30px;
            border-top: 1px solid var(--color-gray-700);
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .footer-logo {
            font-size: 32px;
            font-weight: 800;
            color: var(--color-white);
        }

        .footer-logo span {
            color: var(--color-gold);
        }

        .footer-contact {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--color-gray-400);
            font-size: 16px;
        }

        .footer-contact a {
            color: var(--color-gold);
            font-weight: 600;
        }

        .footer-bottom {
            border-top: 1px solid var(--color-gray-700);
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-copyright {
            font-size: 14px;
            color: var(--color-gray-500);
        }

        .footer-legal {
            display: flex;
            gap: 30px;
        }

        .footer-legal a {
            font-size: 14px;
            color: var(--color-gray-500);
        }

        .footer-legal a:hover {
            color: var(--color-gold);
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
                max-width: 700px;
                margin: 40px auto 0;
            }

            .problem-grid, .solution-grid {
                grid-template-columns: 1fr;
            }

            .roles-grid, .performance-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .timeline {
                flex-wrap: wrap;
                gap: 40px;
            }

            .timeline::before {
                display: none;
            }

            .timeline-item {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .nav {
                display: none;
            }

            .hero {
                padding-top: 100px;
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

            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .section-title {
                font-size: 32px;
            }

            .roles-grid, .performance-grid {
                grid-template-columns: 1fr;
            }

            .faq-grid {
                grid-template-columns: 1fr;
            }

            .cta h2 {
                font-size: 32px;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .footer-content {
                flex-direction: column;
                gap: 24px;
                text-align: center;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 20px;
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
                <a href="#" class="logo">ORDA<span>.</span></a>
                
                <nav class="nav">
                    <a href="#problem" class="nav-link">Problème</a>
                    <a href="#solution" class="nav-link">Solution</a>
                    <a href="#roles" class="nav-link">Rôles</a>
                    <a href="#performance" class="nav-link">Performance</a>
                    <a href="#faq" class="nav-link">FAQ</a>
                </nav>

                <div class="header-actions" style="display: flex; gap: 12px; align-items: center;">
                    <a href="{{ route('login') }}" class="btn" style="padding: 12px 24px; font-size: 13px; background: transparent; color: var(--color-black); border: 2px solid var(--color-gray-200);">Connexion</a>
                    <a href="#cta" class="btn btn-primary">Démander une Démo</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        Solution Enterprise
                    </div>
                    <h1>ORDA – Centralisez et Optimisez Vos Ventes <span>Multi-Sites</span></h1>
                    <p>Une plateforme intelligente permettant de gérer toutes vos commandes e-commerce depuis une seule interface performante et sécurisée.</p>
                    <div class="hero-buttons">
                        <a href="#cta" class="btn btn-primary">Demander une Démo</a>
                        <a href="#solution" class="btn btn-dark">Commencer Maintenant</a>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="dashboard-mockup">
                        <div class="dashboard-header">
                            <span class="dashboard-dot red"></span>
                            <span class="dashboard-dot yellow"></span>
                            <span class="dashboard-dot green"></span>
                        </div>
                        <div class="dashboard-body">
                            <div class="dashboard-stats">
                                <div class="dashboard-stat">
                                    <div class="dashboard-stat-label">Commandes</div>
                                    <div class="dashboard-stat-value">12,847</div>
                                </div>
                                <div class="dashboard-stat">
                                    <div class="dashboard-stat-label">Revenus</div>
                                    <div class="dashboard-stat-value gold">$284,592</div>
                                </div>
                                <div class="dashboard-stat">
                                    <div class="dashboard-stat-label">Clients</div>
                                    <div class="dashboard-stat-value">8,429</div>
                                </div>
                                <div class="dashboard-stat">
                                    <div class="dashboard-stat-label">Taux de conversion</div>
                                    <div class="dashboard-stat-value">3.24%</div>
                                </div>
                            </div>
                            <div class="dashboard-chart">
                                <div class="chart-bar" style="height: 40%;"></div>
                                <div class="chart-bar" style="height: 65%;"></div>
                                <div class="chart-bar" style="height: 50%;"></div>
                                <div class="chart-bar" style="height: 80%;"></div>
                                <div class="chart-bar" style="height: 60%;"></div>
                                <div class="chart-bar" style="height: 90%;"></div>
                                <div class="chart-bar" style="height: 75%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem Section -->
    <section class="problem-solution" id="problem">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Les Défis</span>
                <h2 class="section-title">Les Problèmes Courants</h2>
                <p class="section-subtitle">Gérer plusieurs boutiques e-commerce peut rapidement devenir un cauchemar logistique.</p>
            </div>

            <div class="problem-grid">
                <div class="problem-card">
                    <div class="problem-icon">🏪</div>
                    <h3>Gestion Dispersée</h3>
                    <p>Vous devez jongler entre plusieurs interfaces pour suivre vos commandes, ce qui multiplie les risques d'erreurs et de perte de temps.</p>
                </div>

                <div class="problem-card">
                    <div class="problem-icon">📉</div>
                    <h3>Manque de Visibilité</h3>
                    <p>Sans vue d'ensemble, impossible d'analyser efficacement vos performances globales et de prendre des décisions stratégiques éclairées.</p>
                </div>

                <div class="problem-card">
                    <div class="problem-icon">📊</div>
                    <h3>Analyse Complexe</h3>
                    <p>L'agrégation manuelle des données de plusieurs plateformes rend l'analyse des performances longue et sujette aux erreurs.</p>
                </div>

                <div class="problem-card">
                    <div class="problem-icon">⚠️</div>
                    <h3>Risques d'Erreurs</h3>
                    <p>Le traitement manuel des commandes augmente les risques de doublons, de retards et de clients mécontents.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Solution Section -->
    <section class="problem-solution" id="solution" style="background-color: var(--color-white-off);">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">La Solution</span>
                <h2 class="section-title">Pourquoi Choisir ORDA ?</h2>
                <p class="section-subtitle">Une plateforme tout-en-un pour simplifier votre gestion e-commerce.</p>
            </div>

            <div class="solution-grid">
                <div class="solution-card">
                    <div class="solution-icon">🔗</div>
                    <h3>Centralisation Complète</h3>
                    <p>Unifiez toutes vos boutiques en une seule interface. Gérez vos commandes, clients et inventaires depuis un tableau de bord unique.</p>
                </div>

                <div class="solution-card">
                    <div class="solution-icon">📈</div>
                    <h3>Tableau de Bord Intelligent</h3>
                    <p>Accédez à des statistiques en temps réel, des graphiques interactifs et des rapports détaillés pour piloter votre activité.</p>
                </div>

                <div class="solution-card">
                    <div class="solution-icon">⏱️</div>
                    <h3>Suivi en Temps Réel</h3>
                    <p>Surveillez chaque étape de vos commandes instantanément. Automatisez les mises à jour et notifications.</p>
                </div>

                <div class="solution-card">
                    <div class="solution-icon">🔒</div>
                    <h3>Transactions Sécurisées</h3>
                    <p>Bénéficiez d'un système de paiement sécurisé avec chiffrement de bout en bout et conformité RGPD.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section class="roles" id="roles">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Gestion des Accès</span>
                <h2 class="section-title">Des Rôles Adaptés à Vos Besoins</h2>
                <p class="section-subtitle">ORDA propose une gestion des permissions granulaire pour chaque membre de votre équipe.</p>
            </div>

            <div class="roles-grid">
                <div class="role-card">
                    <div class="role-icon">👩‍💼</div>
                    <h3>Administrateur</h3>
                    <p>Supervision globale et gestion complète de la plateforme, des utilisateurs et des configurations.</p>
                </div>

                <div class="role-card">
                    <div class="role-icon">🛍️</div>
                    <h3>Commerçant</h3>
                    <p>Gestion des ventes, du portefeuille clients et des produits sur l'ensemble des boutiques.</p>
                </div>

                <div class="role-card">
                    <div class="role-icon">📊</div>
                    <h3>Manager</h3>
                    <p>Analyse de performance, génération de rapports stratégiques et suivi des KPIs.</p>
                </div>

                <div class="role-card">
                    <div class="role-icon">🧑‍💻</div>
                    <h3>Employé</h3>
                    <p>Traitement opérationnel des commandes et gestion quotidienne au jour le jour.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Performance Section -->
    <section class="performance" id="performance">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Pourquoi ORDA</span>
                <h2 class="section-title">Performance & Sécurité</h2>
                <p class="section-subtitle">Une solution robuste conçue pour les exigences des entreprises.</p>
            </div>

            <div class="performance-grid">
                <div class="performance-card">
                    <div class="performance-icon">⚡</div>
                    <h3>Haute Performance</h3>
                    <p>Technologie de pointe pour des temps de réponse ultra-rapides et une expérience utilisateur fluide.</p>
                </div>

                <div class="performance-card">
                    <div class="performance-icon">🛡️</div>
                    <h3>Sécurité Avancée</h3>
                    <p>Protection des données de bout en bout avec chiffrement SSL, authentification MFA et sauvegarde automatique.</p>
                </div>

                <div class="performance-card">
                    <div class="performance-icon">🧩</div>
                    <h3>Architecture Modulaire</h3>
                    <p>Extension et personnalisation facilités selon vos besoins spécifiques grâce à une architecture évolutive.</p>
                </div>

                <div class="performance-card">
                    <div class="performance-icon">🚀</div>
                    <h3>Expérience Optimisée</h3>
                    <p>Interface intuitive et ergonomie pensée pour maximiser la productivité de vos équipes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Questions Fréquentes</span>
                <h2 class="section-title">Tout ce que vous devez savoir</h2>
                <p class="section-subtitle">Des réponses claires à vos questions les plus courantes.</p>
            </div>

            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-icon">🔹</span>
                        <h3>Qu'est-ce que ORDA ?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>ORDA est une plateforme centralisée de gestion e-commerce multi-sites qui permet d'unifier toutes vos commandes, vos équipes et vos performances depuis une seule interface.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-icon">🔹</span>
                        <h3>À qui s'adresse ORDA ?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>ORDA est conçue pour les entreprises, commerçants et gestionnaires qui possèdent plusieurs boutiques e-commerce et souhaitent centraliser leur gestion.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-icon">🔹</span>
                        <h3>Est-ce que la plateforme est sécurisée ?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Oui. ORDA intègre des protocoles de sécurité avancés, un chiffrement SSL et des transactions sécurisées pour garantir la protection des données.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-icon">🔹</span>
                        <h3>Puis-je gérer plusieurs rôles sur la plateforme ?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Oui. ORDA permet une gestion intelligente des rôles : Administrateur, Commerçant, Manager et Employé, chacun avec des permissions spécifiques.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-icon">🔹</span>
                        <h3>La plateforme est-elle adaptée aux entreprises en croissance ?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Absolument. ORDA est conçue avec une architecture scalable qui s'adapte à l'augmentation du nombre d'utilisateurs et de boutiques.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-icon">🔹</span>
                        <h3>Comment puis-je obtenir une démonstration ?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Il suffit de nous contacter au : <strong>0621651204</strong> ou de cliquer sur "Planifier une Démonstration".</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Passez à une gestion e-commerce intelligente avec ORDA</h2>
                <p>Rejoignez les entreprises qui font confiance à ORDA pour optimiser leurs ventes multi-sites.</p>
                <div class="cta-phone">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    0621651204
                </div>
                <div class="cta-buttons">
                    <a href="tel:0621651204" class="btn btn-primary">Planifier une Démonstration</a>
                    <a href="#home" class="btn btn-secondary">Commencer Maintenant</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">ORDA<span>.</span></div>
                <div class="footer-contact">
                    <span>Contact :</span>
                    <a href="tel:0621651204">0621651204</a>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-copyright">© 2025 ORDA. Tous droits réservés.</p>
                <div class="footer-legal">
                    <a href="#">Mentions légales</a>
                    <a href="#">Politique de confidentialité</a>
                    <a href="#">Conditions générales</a>
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
                header.style.padding = '0';
            } else {
                header.style.padding = '0';
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

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.problem-card, .solution-card, .role-card, .performance-card, .faq-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>
