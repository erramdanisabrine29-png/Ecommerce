<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORDA – Plateforme E-Commerce Multi-Sites</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    
    <style>
        :root {
            --color-black: #0A0A0A;
            --color-black-light: #151515;
            --color-gold: #D4AF37;
            --color-gold-light: #F2D06B;
            --color-white: #FFFFFF;
            --color-gray: #888888;
            --glass: rgba(255, 255, 255, 0.03);
            --border-glass: rgba(255, 255, 255, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--color-black); 
            color: var(--color-white);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Background Effects */
        .bg-glow {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 50% -20%, #2a220a 0%, transparent 50%);
            z-index: -1;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

        /* Navigation */
        header {
            padding: 24px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-glass);
        }
        .nav-inner { display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 24px; font-weight: 800; color: var(--color-white); text-decoration: none; }
        .logo span { color: var(--color-gold); }
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { color: var(--color-gray); text-decoration: none; font-size: 14px; transition: 0.3s; }
        .nav-links a:hover { color: var(--color-gold); }

        /* Hero Section - Directement inspiré de la vidéo */
        .hero {
            padding: 100px 0 60px;
            text-align: center;
        }
        .hero-badge {
            display: inline-block;
            padding: 8px 16px;
            background: var(--glass);
            border: 1px solid var(--border-glass);
            border-radius: 100px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 24px;
            color: var(--color-gold);
        }
        .hero h1 {
            font-size: clamp(40px, 8vw, 80px);
            font-weight: 800;
            line-height: 1;
            margin-bottom: 30px;
            letter-spacing: -3px;
        }
        .hero h1 span {
            background: linear-gradient(to right, var(--color-gold), var(--color-gold-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p {
            max-width: 600px;
            margin: 0 auto 40px;
            color: var(--color-gray);
            font-size: 18px;
        }

        /* Bento Grid - Le style clé de la vidéo */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 240px;
            gap: 20px;
            margin-top: 40px;
        }
        .bento-item {
            background: var(--color-black-light);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            padding: 30px;
            position: relative;
            overflow: hidden;
            transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }
        .bento-item:hover {
            border-color: var(--color-gold);
            transform: translateY(-5px);
        }
        .large { grid-column: span 2; }
        .tall { grid-row: span 2; }

        .bento-item h3 { font-size: 20px; margin-bottom: 10px; }
        .bento-item p { color: var(--color-gray); font-size: 14px; }

        /* Dashboard Mockup - Floating Style */
        .mockup {
            background: linear-gradient(135deg, #1a1a1a, #0a0a0a);
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        .bar { 
            height: 8px; background: var(--glass); border-radius: 4px; margin-bottom: 10px; 
            overflow: hidden; position: relative;
        }
        .bar-fill { 
            height: 100%; background: var(--color-gold); 
            animation: fill 2s ease-out forwards;
            width: 0%;
        }

        @keyframes fill { to { width: 70%; } }

        /* Buttons */
        .btn {
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-gold {
            background: var(--color-gold);
            color: var(--color-black);
        }
        .btn-gold:hover {
            background: var(--color-gold-light);
            transform: scale(1.05);
        }
        .btn-outline {
            border: 1px solid var(--border-glass);
            color: var(--white);
        }

        /* Responsive */
        @media (max-width: 900px) {
            .bento-grid { grid-template-columns: 1fr; grid-auto-rows: auto; }
            .large, .tall { grid-column: span 1; grid-row: span 1; }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>

    <header>
        <div class="container">
            <div class="nav-inner">
                <a href="#" class="logo">ORDA<span>.</span></a>
                <nav class="nav-links">
                    <a href="#features">Features</a>
                    <a href="#solution">Solution</a>
                    <a href="#pricing">Tarifs</a>
                </nav>
                <a href="#" class="btn btn-outline" style="padding: 10px 20px; font-size: 13px;">Login</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-badge">Plateforme Next-Gen</div>
            <h1>Centralisez Vos Ventes<br><span>Multi-Sites.</span></h1>
            <p>Simplifiez la gestion de votre empire e-commerce avec une interface unifiée, rapide et intelligente.</p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="#" class="btn btn-gold">Démarrer gratuitement</a>
                <a href="#" class="btn btn-outline">Voir la démo</a>
            </div>

            <div class="bento-grid">
                <div class="bento-item large">
                    <div style="text-align: left;">
                        <h3>Gestion Dispersée ?</h3>
                        <p>Ne perdez plus de temps à passer d'un onglet à l'autre. ORDA synchronise tout en temps réel.</p>
                        <div class="mockup">
                            <div class="bar"><div class="bar-fill" style="width: 80%;"></div></div>
                            <div class="bar"><div class="bar-fill" style="width: 40%; background: #444;"></div></div>
                            <div class="bar"><div class="bar-fill" style="width: 60%;"></div></div>
                        </div>
                    </div>
                </div>

                <div class="bento-item tall">
                    <div style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                        <span style="font-size: 60px; font-weight: 800; color: var(--color-gold);">+250%</span>
                        <p>D'efficacité opérationnelle constatée par nos clients.</p>
                    </div>
                </div>

                <div class="bento-item">
                    <h3>Sécurité Pro</h3>
                    <p>Vos données sont protégées par un cryptage de grade bancaire.</p>
                    <div style="font-size: 40px; margin-top: 20px;">🛡️</div>
                </div>

                <div class="bento-item">
                    <h3>Multi-Boutiques</h3>
                    <p>Shopify, WooCommerce, Magento... Connectez tout.</p>
                    <div style="font-size: 40px; margin-top: 20px;">🌐</div>
                </div>
            </div>
        </div>
    </section>

    <footer style="padding: 60px 0; text-align: center; border-top: 1px solid var(--border-glass); margin-top: 100px;">
        <div class="container">
            <p style="color: var(--color-gray);">&copy; 2024 ORDA. Elevating E-commerce Management.</p>
        </div>
    </footer>
</body>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ORDA - Plateforme centralisée de commerce électronique multi-sites.">
    <title>ORDA – Centralisez et Optimisez Vos Ventes Multi-Sites</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    <style>
        :root {
            --color-black: #0A0A0A;
            --color-black-light: #161616;
            --color-gold: #D4AF37;
            --color-gold-light: #E8C966;
            --color-gold-dark: #B8962E;
            --color-white: #FFFFFF;
            --color-white-off: #F9F9F9;
            --color-gray-100: #F3F3F3;
            --color-gray-200: #E5E5E5;
            --color-gray-400: #999999;
            --color-gray-600: #444444;
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--color-black); 
            background-color: var(--color-white); 
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container { max-width: 1240px; margin: 0 auto; padding: 0 24px; }

        /* --- Typography --- */
        h1, h2, h3 { font-weight: 800; letter-spacing: -0.03em; line-height: 1.1; }
        .section-tag {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--color-gold);
            margin-bottom: 16px;
        }

        /* --- Buttons --- */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 14px 28px;
            border-radius: 100px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
        }
        .btn-primary { background: var(--color-gold); color: var(--color-black); }
        .btn-primary:hover { background: var(--color-gold-light); transform: translateY(-3px); box-shadow: 0 15px 30px rgba(212, 175, 55, 0.3); }
        .btn-outline { border: 1px solid var(--color-gray-200); background: transparent; color: var(--color-black); }
        .btn-outline:hover { background: var(--color-black); color: var(--color-white); border-color: var(--color-black); }

        /* --- Header --- */
        .header {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .header-inner { display: flex; justify-content: space-between; align-items: center; height: 80px; }
        .logo { font-size: 24px; font-weight: 800; color: var(--color-black); }
        .logo span { color: var(--color-gold); }
        .nav { display: flex; gap: 32px; }
        .nav-link { font-size: 14px; font-weight: 600; color: var(--color-gray-600); }
        .nav-link:hover { color: var(--color-gold); }

        /* --- Hero Section with Video Background --- */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            padding-top: 80px;
            overflow: hidden;
        }

        .video-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1; background: #000;
        }
        .video-bg iframe {
            width: 100vw; height: 56.25vw; /* 16:9 ratio */
            min-height: 100vh; min-width: 177.77vh;
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none; opacity: 0.6;
        }
        .hero-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.8) 100%);
            z-index: 0;
        }

        .hero-content {
            position: relative; z-index: 1;
            display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;
        }
        .hero h1 { font-size: clamp(40px, 5vw, 64px); margin-bottom: 24px; }
        .hero p { font-size: 18px; color: rgba(255,255,255,0.8); margin-bottom: 32px; max-width: 500px; }

        /* --- Modern Dashboard Mockup --- */
        .dashboard-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 20px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }

        .mockup-header { display: flex; gap: 8px; margin-bottom: 20px; }
        .dot { width: 10px; height: 10px; border-radius: 50%; }
        .dot-1 { background: #ff5f56; } .dot-2 { background: #ffbd2e; } .dot-3 { background: #27c93f; }

        .mockup-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .mockup-card {
            background: rgba(255,255,255,0.1); padding: 15px; border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .mockup-label { font-size: 11px; color: var(--color-gold); text-transform: uppercase; margin-bottom: 5px; }
        .mockup-val { font-size: 20px; font-weight: 700; }
        
        .mockup-chart {
            margin-top: 15px; height: 100px; display: flex; align-items: flex-end; gap: 8px;
        }
        .bar { 
            flex: 1; background: var(--color-gold); border-radius: 4px 4px 0 0; 
            animation: grow 2s ease-out forwards; transform-origin: bottom; transform: scaleY(0);
        }
        @keyframes grow { to { transform: scaleY(1); } }

        /* --- Sections General --- */
        section { padding: 120px 0; }
        .text-center { text-align: center; margin-bottom: 60px; }

        /* --- Bento Grid Solution --- */
        .bento-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
        }
        .bento-item {
            background: var(--color-white-off); padding: 40px; border-radius: 24px;
            border: 1px solid var(--color-gray-100); transition: var(--transition);
        }
        .bento-item:hover { transform: translateY(-10px); border-color: var(--color-gold); }
        .bento-item.dark { background: var(--color-black); color: white; grid-column: span 2; }
        .icon-box { font-size: 32px; margin-bottom: 20px; display: block; }

        /* --- FAQ --- */
        .faq-item {
            max-width: 800px; margin: 0 auto 16px; 
            background: var(--color-white-off); padding: 24px; border-radius: 16px;
        }
        .faq-item h3 { font-size: 18px; margin-bottom: 10px; color: var(--color-gold-dark); }

        /* --- CTA --- */
        .cta-box {
            background: var(--color-black); color: white; padding: 80px; border-radius: 40px;
            text-align: center; position: relative; overflow: hidden;
        }
        .cta-box::after {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(212,175,55,0.1) 0%, transparent 70%);
        }

        /* --- Footer --- */
        footer { padding: 60px 0; border-top: 1px solid var(--color-gray-100); }
        .footer-wrap { display: flex; justify-content: space-between; align-items: center; }

        /* --- Responsive --- */
        @media (max-width: 992px) {
            .hero-content { grid-template-columns: 1fr; text-align: center; }
            .hero p { margin: 0 auto 32px; }
            .bento-grid { grid-template-columns: 1fr; }
            .bento-item.dark { grid-column: span 1; }
            .nav { display: none; }
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="header-inner">
                <a href="#" class="logo">ORDA<span>.</span></a>
                <nav class="nav">
                    <a href="#problem" class="nav-link">Le Problème</a>
                    <a href="#solution" class="nav-link">La Solution</a>
                    <a href="#performance" class="nav-link">Performance</a>
                    <a href="#faq" class="nav-link">FAQ</a>
                </nav>
                <div class="actions">
                    <a href="#" class="btn btn-outline" style="margin-right: 12px; padding: 10px 20px;">Login</a>
                    <a href="#cta" class="btn btn-primary" style="padding: 10px 20px;">Essai Gratuit</a>
                </div>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="video-bg">
            <iframe src="https://www.youtube.com/embed/rP7D7-0p0Ew?autoplay=1&mute=1&controls=0&loop=1&playlist=rP7D7-0p0Ew&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media"></iframe>
        </div>
        <div class="hero-overlay"></div>
        
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="section-tag" style="color: var(--color-gold-light);">Intelligence Artificielle</span>
                    <h1>Centralisez Vos Ventes <span style="color: var(--color-gold);">Multi-Sites</span></h1>
                    <p>La plateforme Enterprise pour orchestrer vos boutiques Shopify, WooCommerce et Amazon depuis un centre de commande unique.</p>
                    <div class="hero-btns">
                        <a href="#cta" class="btn btn-primary">Réserver une Démo</a>
                        <a href="#solution" class="btn" style="color: white; border: 1px solid rgba(255,255,255,0.3); margin-left: 15px;">Explorer</a>
                    </div>
                </div>

                <div class="dashboard-container">
                    <div class="mockup-header">
                        <div class="dot dot-1"></div>
                        <div class="dot dot-2"></div>
                        <div class="dot dot-3"></div>
                    </div>
                    <div class="mockup-grid">
                        <div class="mockup-card">
                            <div class="mockup-label">Commandes</div>
                            <div class="mockup-val">12,847</div>
                        </div>
                        <div class="mockup-card">
                            <div class="mockup-label">Revenus</div>
                            <div class="mockup-val" style="color: var(--color-gold-light);">$284,592</div>
                        </div>
                    </div>
                    <div class="mockup-chart">
                        <div class="bar" style="height: 40%; animation-delay: 0.1s;"></div>
                        <div class="bar" style="height: 70%; animation-delay: 0.2s;"></div>
                        <div class="bar" style="height: 55%; animation-delay: 0.3s;"></div>
                        <div class="bar" style="height: 90%; animation-delay: 0.4s;"></div>
                        <div class="bar" style="height: 65%; animation-delay: 0.5s;"></div>
                        <div class="bar" style="height: 80%; animation-delay: 0.6s;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="problem">
        <div class="container">
            <div class="text-center">
                <span class="section-tag">Analyse du Marché</span>
                <h2>Le Chaos du Multi-Boutiques</h2>
            </div>
            <div class="bento-grid">
                <div class="bento-item">
                    <span class="icon-box">🏪</span>
                    <h3>Dispersion</h3>
                    <p>Trop d'onglets, trop de mots de passe, trop d'erreurs humaines.</p>
                </div>
                <div class="bento-item dark">
                    <span class="icon-box">📊</span>
                    <h3>L'Aveuglement Statistique</h3>
                    <p>Sans une vue agrégée, vous pilotez votre entreprise à l'aveugle. ORDA fusionne vos données en temps réel pour une clarté absolue.</p>
                </div>
                <div class="bento-item">
                    <span class="icon-box">⚠️</span>
                    <h3>Risques Logistiques</h3>
                    <p>Les stocks non synchronisés sont les ennemis de votre croissance.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="solution" style="background: var(--color-white-off);">
        <div class="container">
            <div class="text-center">
                <span class="section-tag">Notre Solution</span>
                <h2>Un Écosystème Unifié</h2>
            </div>
            <div class="bento-grid">
                <div class="bento-item dark" style="grid-column: span 1;">
                    <span class="icon-box" style="color: var(--color-gold);">01</span>
                    <h3>Sync Temps Réel</h3>
                    <p>Chaque vente met à jour l'ensemble de votre inventaire instantanément.</p>
                </div>
                <div class="bento-item">
                    <span class="icon-box">🛡️</span>
                    <h3>Sécurité Bancaire</h3>
                    <p>Vos données sont protégées par un chiffrement de bout en bout conforme aux normes ISO.</p>
                </div>
                <div class="bento-item">
                    <span class="icon-box">⚡</span>
                    <h3>Vitesse de Traitement</h3>
                    <p>Réduisez le temps de gestion des commandes de 65% dès le premier mois.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="faq">
        <div class="container">
            <div class="text-center">
                <span class="section-tag">Des questions ?</span>
                <h2>Questions Fréquentes</h2>
            </div>
            <div class="faq-item">
                <h3>Est-ce compatible avec Shopify ?</h3>
                <p>Oui, ORDA propose une intégration native pour Shopify, WooCommerce, Magento et les principales places de marché.</p>
            </div>
            <div class="faq-item">
                <h3>Quel est le temps d'installation ?</h3>
                <p>La configuration initiale prend moins de 30 minutes grâce à nos connecteurs API intelligents.</p>
            </div>
        </div>
    </section>

    <section id="cta">
        <div class="container">
            <div class="cta-box">
                <h2>Prêt à passer à l'échelle supérieure ?</h2>
                <p style="margin-bottom: 30px; opacity: 0.8;">Rejoignez plus de 500 e-commerçants qui ont centralisé leur succès.</p>
                <a href="#" class="btn btn-primary">Démarrer l'essai gratuit de 14 jours</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-wrap">
                <div class="logo">ORDA<span>.</span></div>
                <div style="color: var(--color-gray-600); font-size: 14px;">
                    &copy; 2024 ORDA Technology. Tous droits réservés.
                </div>
                <div class="nav">
                    <a href="#" class="nav-link">Mentions Légales</a>
                    <a href="#" class="nav-link">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>