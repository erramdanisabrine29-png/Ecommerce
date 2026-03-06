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
</html>