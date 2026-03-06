<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORDA – Centralisez votre E-Commerce Multi-Sites</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    <style>
        :root {
            --color-black: #050505;
            --color-black-light: #121212;
            --color-gold: #D4AF37;
            --color-gold-glow: rgba(212, 175, 55, 0.4);
            --color-white: #FFFFFF;
            --color-gray-text: #A1A1AA;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--color-black); 
            color: var(--color-white); 
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Layout Helpers */
        .container { max-width: 1240px; margin: 0 auto; padding: 0 24px; }
        section { padding: 120px 0; position: relative; }

        /* Typography */
        h1, h2, h3 { line-height: 1.1; font-weight: 800; letter-spacing: -0.03em; }
        .text-gradient {
            background: linear-gradient(135deg, #FFF 0%, var(--color-gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Header */
        .header {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            background: rgba(5, 5, 5, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
        }
        .header-inner { display: flex; justify-content: space-between; align-items: center; height: 80px; }
        .logo { font-size: 24px; font-weight: 800; color: var(--color-white); text-decoration: none; }
        .logo span { color: var(--color-gold); }
        .nav { display: flex; gap: 32px; }
        .nav-link { color: var(--color-gray-text); text-decoration: none; font-size: 14px; font-weight: 500; transition: var(--transition); }
        .nav-link:hover { color: var(--color-gold); }

        /* Buttons */
        .btn {
            padding: 14px 28px; border-radius: 10px; font-weight: 600; font-size: 14px;
            cursor: pointer; transition: var(--transition); border: none; text-decoration: none;
            display: inline-flex; align-items: center; justify-content: center;
        }
        .btn-primary { background: var(--color-gold); color: var(--color-black); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 10px 25px var(--color-gold-glow); }
        .btn-outline { background: transparent; border: 1px solid var(--glass-border); color: var(--color-white); }
        .btn-outline:hover { background: var(--glass-border); }

        /* Hero Section with Video Background */
        .hero {
            height: 100vh; display: flex; align-items: center; overflow: hidden;
            background: #000; padding-top: 80px;
        }
        .video-container {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0;
            opacity: 0.5; filter: grayscale(0.2) contrast(1.1);
        }
        .video-container iframe { width: 100vw; height: 100vh; pointer-events: none; object-fit: cover; }
        .hero-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at center, transparent 0%, var(--color-black) 90%);
            z-index: 1;
        }
        .hero-content { position: relative; z-index: 2; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
        .hero-badge {
            display: inline-block; padding: 6px 16px; background: rgba(212, 175, 55, 0.15);
            border: 1px solid var(--color-gold); color: var(--color-gold);
            border-radius: 100px; font-size: 12px; font-weight: 700; margin-bottom: 24px;
        }
        .hero h1 { font-size: clamp(40px, 5vw, 64px); margin-bottom: 24px; }
        .hero p { font-size: 18px; color: var(--color-gray-text); margin-bottom: 32px; max-width: 90%; }

        /* Dynamic Dashboard Mockup */
        .dashboard-ui {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px; padding: 30px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        
        .db-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px; }
        .db-card { background: var(--glass); border: 1px solid var(--glass-border); padding: 20px; border-radius: 15px; }
        .db-val { font-size: 24px; font-weight: 800; color: var(--color-gold); }
        .db-label { font-size: 12px; color: var(--color-gray-text); text-transform: uppercase; }
        .db-chart { height: 150px; display: flex; align-items: flex-end; gap: 10px; padding-top: 20px; }
        .db-bar { flex: 1; background: linear-gradient(to top, var(--color-gold), transparent); border-radius: 4px; transition: height 1s ease; }

        /* Sections Styling */
        .section-tag { color: var(--color-gold); font-weight: 700; font-size: 13px; letter-spacing: 2px; text-transform: uppercase; display: block; margin-bottom: 12px; }
        .section-title { font-size: 42px; margin-bottom: 48px; }

        /* Problem/Solution Cards */
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
        .feature-card {
            background: var(--color-black-light);
            border: 1px solid var(--glass-border);
            padding: 40px; border-radius: 20px; transition: var(--transition);
        }
        .feature-card:hover { border-color: var(--color-gold); transform: translateY(-10px); background: #181818; }
        .feature-icon { font-size: 32px; margin-bottom: 20px; display: block; }
        .feature-card h3 { margin-bottom: 16px; font-size: 20px; }
        .feature-card p { color: var(--color-gray-text); font-size: 15px; }

        /* Roles (Horizontal Scrolling on mobile) */
        .roles-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .role-pill { 
            text-align: center; padding: 30px 20px; background: var(--glass); 
            border: 1px solid var(--glass-border); border-radius: 20px; 
        }
        .role-pill:hover { border-color: var(--color-gold); color: var(--color-gold); }

        /* FAQ */
        .faq-grid { max-width: 800px; margin: 0 auto; }
        .faq-item { background: var(--glass); margin-bottom: 15px; border-radius: 12px; padding: 25px; border: 1px solid var(--glass-border); }
        .faq-item h3 { font-size: 18px; margin-bottom: 10px; color: var(--color-gold); }

        /* CTA Section */
        .cta-box {
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80');
            background-size: cover; padding: 80px; border-radius: 40px; text-align: center;
            border: 1px solid var(--color-gold-glow);
        }

        /* Footer */
        .footer { padding: 60px 0; border-top: 1px solid var(--glass-border); color: var(--color-gray-text); font-size: 14px; }
        .footer-flex { display: flex; justify-content: space-between; align-items: center; }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-content { grid-template-columns: 1fr; text-align: center; }
            .hero p { margin: 0 auto 32px; }
            .roles-grid { grid-template-columns: 1fr 1fr; }
            .cta-box { padding: 40px 20px; }
        }
        @media (max-width: 600px) {
            .nav { display: none; }
            .roles-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="header-inner">
                <a href="#" class="logo">ORDA<span>.</span></a>
                <nav class="nav">
                    <a href="#problem" class="nav-link">Défis</a>
                    <a href="#solution" class="nav-link">Solution</a>
                    <a href="#roles" class="nav-link">Rôles</a>
                    <a href="#faq" class="nav-link">FAQ</a>
                </nav>
                <div class="header-btns">
                    <a href="#" class="btn btn-outline" style="margin-right: 10px;">Connexion</a>
                    <a href="#cta" class="btn btn-primary">Démo</a>
                </div>
            </div>
        </div>
    </header>

    <section class="hero" id="home">
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&controls=0&loop=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
        <div class="hero-overlay"></div>
        
        <div class="container hero-content">
            <div class="hero-text">
                <span class="hero-badge">Nouveauté 2024</span>
                <h1 class="text-gradient">Centralisez votre Empire E-commerce</h1>
                <p>ORDA unifie vos boutiques Shopify, WooCommerce et Magento dans un tableau de bord unique piloté par l'IA.</p>
                <div class="hero-btns">
                    <a href="#cta" class="btn btn-primary" style="margin-right: 15px;">Démarrer l'essai gratuit</a>
                    <a href="#solution" class="btn btn-outline">Voir la vidéo</a>
                </div>
            </div>

            <div class="hero-image">
                <div class="dashboard-ui">
                    <div class="db-grid">
                        <div class="db-card">
                            <span class="db-label">Commandes</span>
                            <div class="db-val">12,847</div>
                        </div>
                        <div class="db-card">
                            <span class="db-label">Revenus</span>
                            <div class="db-val">$284.5k</div>
                        </div>
                    </div>
                    <div class="db-chart">
                        <div class="db-bar" style="height: 40%"></div>
                        <div class="db-bar" style="height: 70%"></div>
                        <div class="db-bar" style="height: 50%"></div>
                        <div class="db-bar" style="height: 90%"></div>
                        <div class="db-bar" style="height: 65%"></div>
                        <div class="db-bar" style="height: 80%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="problem">
        <div class="container">
            <span class="section-tag">Le Constat</span>
            <h2 class="section-title">Le chaos multi-sites s'arrête ici.</h2>
            <div class="card-grid">
                <div class="feature-card">
                    <span class="feature-icon">🏪</span>
                    <h3>Gestion Fragmentée</h3>
                    <p>Fini les 10 onglets ouverts. Gérez tout depuis une source de vérité unique.</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">📉</span>
                    <h3>Données Aveugles</h3>
                    <p>Visualisez vos marges réelles en temps réel, sur l'ensemble de vos canaux.</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">⚠️</span>
                    <h3>Erreurs de Stock</h3>
                    <p>Synchronisation automatique pour éviter les ruptures et les ventes perdues.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="roles" style="background: var(--color-black-light);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                <span class="section-tag">Écosystème</span>
                <h2 class="section-title">Une solution pour chaque profil</h2>
            </div>
            <div class="roles-grid">
                <div class="role-pill">
                    <h3>Admin</h3>
                    <p>Contrôle total</p>
                </div>
                <div class="role-pill">
                    <h3>Manager</h3>
                    <p>Stratégie & Analytics</p>
                </div>
                <div class="role-pill">
                    <h3>Logistique</h3>
                    <p>Expédition rapide</p>
                </div>
                <div class="role-pill">
                    <h3>Support</h3>
                    <p>Satisfaction client</p>
                </div>
            </div>
        </div>
    </section>

    <section id="faq">
        <div class="container">
            <span class="section-tag">Aide</span>
            <h2 class="section-title">Questions fréquentes</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <h3>Comment ORDA se connecte à mes sites ?</h3>
                    <p>Via nos API sécurisées en un clic pour Shopify, WooCommerce et Prestashop.</p>
                </div>
                <div class="faq-item">
                    <h3>Mes données sont-elles sécurisées ?</h3>
                    <p>Chiffrement AES-256 et conformité RGPD stricte pour toutes vos transactions.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="cta">
        <div class="container">
            <div class="cta-box">
                <h2 style="font-size: 48px; margin-bottom: 20px;">Prêt à passer à l'échelle ?</h2>
                <p style="color: var(--color-gray-text); margin-bottom: 40px; font-size: 18px;">Rejoignez +500 marchands qui ont automatisé leur croissance.</p>
                <a href="#" class="btn btn-primary" style="padding: 20px 40px; font-size: 16px;">Demander ma démo personnalisée</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-flex">
                <div class="footer-logo">ORDA<span>.</span></div>
                <div>© 2024 ORDA Platform. Tous droits réservés.</div>
                <div style="display: flex; gap: 20px;">
                    <a href="#" class="nav-link">Mentions Légales</a>
                    <a href="#" class="nav-link">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Simple script to animate the dashboard bars on load
        window.addEventListener('load', () => {
            const bars = document.querySelectorAll('.db-bar');
            bars.forEach(bar => {
                const height = bar.style.height;
                bar.style.height = '0';
                setTimeout(() => {
                    bar.style.height = height;
                }, 500);
            });
        });
    </script>
</body>
</html>