<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ORDA - Plateforme centralisée de commerce électronique multi-sites.">
    <title>ORDA – Plateforme E-Commerce Multi-Sites | Centralisez Vos Ventes</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --color-black: #050505;
            --color-black-light: #121212;
            --color-gold: #D4AF37;
            --color-gold-glow: rgba(212, 175, 55, 0.4);
            --color-white: #FFFFFF;
            --color-gray-100: #F3F3F3;
            --color-gray-400: #A1A1AA;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--color-black); 
            color: var(--color-white); 
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* --- Animations --- */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .reveal { animation: fadeInUp 0.8s ease forwards; }

        /* --- Header --- */
        .header {
            position: fixed; width: 100%; top: 0; z-index: 1000;
            background: rgba(5, 5, 5, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--glass-border);
        }

        .container { max-width: 1280px; margin: 0 auto; padding: 0 40px; }
        
        .header-inner {
            display: flex; justify-content: space-between; align-items: center; height: 90px;
        }

        .logo { font-size: 24px; font-weight: 800; color: #fff; letter-spacing: -1px; }
        .logo span { color: var(--color-gold); }

        .nav { display: flex; gap: 32px; }
        .nav-link { font-size: 14px; font-weight: 500; color: var(--color-gray-400); transition: var(--transition); }
        .nav-link:hover { color: var(--color-gold); }

        /* --- Hero Section with Video --- */
        .hero {
            position: relative; height: 100vh; min-height: 800px;
            display: flex; align-items: center; overflow: hidden;
            padding-top: 90px;
        }

        .video-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1; object-fit: cover; opacity: 0.6;
        }

        .hero-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(5,5,5,0.7), var(--color-black));
            z-index: -1;
        }

        .hero-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;
        }

        .hero h1 { font-size: clamp(40px, 5vw, 68px); line-height: 1.1; margin-bottom: 24px; }
        .hero h1 span { color: var(--color-gold); text-shadow: 0 0 20px var(--color-gold-glow); }
        
        .hero p { font-size: 18px; color: var(--color-gray-400); margin-bottom: 40px; max-width: 500px; }

        .btn {
            padding: 18px 36px; border-radius: 12px; font-weight: 700; cursor: pointer;
            transition: var(--transition); display: inline-flex; align-items: center; gap: 10px;
        }

        .btn-gold { background: var(--color-gold); color: #000; border: none; }
        .btn-gold:hover { transform: translateY(-3px); box-shadow: 0 10px 30px var(--color-gold-glow); }

        .btn-outline { border: 1px solid var(--glass-border); color: #fff; background: var(--glass-bg); }
        .btn-outline:hover { background: #fff; color: #000; }

        /* --- Dashboard Mockup --- */
        .dashboard-container {
            position: relative; animation: float 6s ease-in-out infinite;
        }

        .dashboard-mockup {
            background: #18181b; border: 1px solid var(--glass-border);
            border-radius: 20px; padding: 24px; box-shadow: 0 50px 100px rgba(0,0,0,0.5);
        }

        .db-header { display: flex; gap: 8px; margin-bottom: 24px; }
        .dot { width: 10px; height: 10px; border-radius: 50%; }
        .db-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .db-card { 
            background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); 
            padding: 20px; border-radius: 12px;
        }
        .db-val { font-size: 24px; font-weight: 800; color: var(--color-gold); }

        /* --- General Sections --- */
        section { padding: 140px 0; }
        .section-tag { color: var(--color-gold); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 12px; margin-bottom: 12px; display: block; }
        .section-title { font-size: 42px; margin-bottom: 60px; }

        /* --- Grid Cards --- */
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
        
        .card {
            background: var(--color-black-light); border: 1px solid var(--glass-border);
            padding: 40px; border-radius: 24px; transition: var(--transition);
        }
        .card:hover { 
            border-color: var(--color-gold); 
            transform: translateY(-10px) scale(1.02);
            background: rgba(212, 175, 55, 0.02);
        }

        .card-icon { font-size: 40px; margin-bottom: 20px; display: block; }

        /* --- Timeline --- */
        .timeline { display: flex; gap: 20px; margin-top: 60px; }
        .t-item { flex: 1; position: relative; text-align: center; }
        .t-circle { 
            width: 60px; height: 60px; background: var(--color-black-light); 
            border: 2px solid var(--color-gold); border-radius: 50%; margin: 0 auto 20px;
            display: grid; place-items: center; position: relative; z-index: 2;
        }

        /* --- FAQ --- */
        .faq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .faq-item { background: var(--color-black-light); padding: 30px; border-radius: 15px; border: 1px solid var(--glass-border); }

        /* --- CTA --- */
        .cta-box {
            background: linear-gradient(45deg, #121212, #1a1a1a);
            padding: 80px; border-radius: 40px; text-align: center;
            border: 1px solid var(--color-gold);
            position: relative; overflow: hidden;
        }

        /* --- Responsive --- */
        @media (max-width: 1024px) {
            .hero-grid { grid-template-columns: 1fr; text-align: center; }
            .hero-grid p { margin: 0 auto 40px; }
            .hero { height: auto; padding: 150px 0 100px; }
            .faq-grid { grid-template-columns: 1fr; }
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
                    <a href="#performance" class="nav-link">Stats</a>
                    <a href="#faq" class="nav-link">FAQ</a>
                </nav>
                <div class="header-actions">
                    <button class="btn btn-outline" style="padding: 10px 20px; font-size: 13px;">Connexion</button>
                    <button class="btn btn-gold" style="padding: 10px 20px; font-size: 13px;">Demo</button>
                </div>
            </div>
        </div>
    </header>

    <section class="hero">
        <video autoplay muted loop playsinline class="video-bg">
            <source src="https://assets.mixkit.co/videos/preview/mixkit-digital-animation-of-a-golden-circuit-board-4431-large.mp4" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        
        <div class="container">
            <div class="hero-grid">
                <div class="hero-text reveal">
                    <span class="section-tag">Enterprise Ready</span>
                    <h1>ORDA – Centralisez Vos Ventes <span>Multi-Sites</span></h1>
                    <p>La plateforme intelligente pour piloter l'ensemble de votre écosystème e-commerce depuis une interface unique, sécurisée et ultra-performante.</p>
                    <div class="btn-group" style="display:flex; gap:15px;">
                        <a href="#cta" class="btn btn-gold">Demander une Démo <i data-lucide="arrow-right"></i></a>
                        <a href="#solution" class="btn btn-outline">Voir la Solution</a>
                    </div>
                </div>
                
                <div class="dashboard-container reveal">
                    <div class="dashboard-mockup">
                        <div class="db-header">
                            <div class="dot" style="background:#ff5f57"></div>
                            <div class="dot" style="background:#febc2e"></div>
                            <div class="dot" style="background:#28c840"></div>
                        </div>
                        <div class="db-grid">
                            <div class="db-card">
                                <span style="font-size:12px; color:var(--color-gray-400)">Commandes</span>
                                <div class="db-val">12,847</div>
                            </div>
                            <div class="db-card">
                                <span style="font-size:12px; color:var(--color-gray-400)">Revenus</span>
                                <div class="db-val">$284.5k</div>
                            </div>
                        </div>
                        <div class="db-card" style="margin-top:15px; height: 120px; display: flex; align-items: flex-end; gap: 8px;">
                            <div style="height:40%; width:20%; background:var(--color-gold); opacity:0.3; border-radius:4px"></div>
                            <div style="height:70%; width:20%; background:var(--color-gold); opacity:0.6; border-radius:4px"></div>
                            <div style="height:90%; width:20%; background:var(--color-gold); border-radius:4px"></div>
                            <div style="height:60%; width:20%; background:var(--color-gold); opacity:0.5; border-radius:4px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="problem">
        <div class="container">
            <span class="section-tag">Les Défis</span>
            <h2 class="section-title">Pourquoi choisir ORDA ?</h2>
            <div class="card-grid">
                <div class="card">
                    <span class="card-icon">🏪</span>
                    <h3>Gestion Dispersée</h3>
                    <p>Fini le jonglage entre 10 onglets. Centralisez tout pour éviter les erreurs coûteuses.</p>
                </div>
                <div class="card">
                    <span class="card-icon">📉</span>
                    <h3>Manque de Visibilité</h3>
                    <p>Obtenez une vision macro de votre business en temps réel, sans agrégation manuelle.</p>
                </div>
                <div class="card">
                    <span class="card-icon">⚠️</span>
                    <h3>Risques d'Erreurs</h3>
                    <p>L'automatisation ORDA réduit le facteur d'erreur humaine de 95%.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="roles" style="background: var(--color-black-light);">
        <div class="container">
            <span class="section-tag">Utilisateurs</span>
            <h2 class="section-title">Une solution, plusieurs rôles</h2>
            <div class="card-grid">
                <div class="card" style="background: var(--color-black); text-align: center;">
                    <div class="t-circle"><i data-lucide="shield-check"></i></div>
                    <h3>Admin</h3>
                    <p>Contrôle total des accès et configuration globale du système.</p>
                </div>
                <div class="card" style="background: var(--color-black); text-align: center;">
                    <div class="t-circle"><i data-lucide="user"></i></div>
                    <h3>Client</h3>
                    <p>Interface intuitive pour un suivi de commande fluide et transparent.</p>
                </div>
                <div class="card" style="background: var(--color-black); text-align: center;">
                    <div class="t-circle"><i data-lucide="truck"></i></div>
                    <h3>Livreur</h3>
                    <p>Gestion des tournées et validation des étapes de livraison en un clic.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="faq">
        <div class="container">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Questions Fréquentes</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <h4>Comment fonctionne l'intégration ?</h4>
                    <p>ORDA se connecte via API à vos boutiques existantes en quelques minutes seulement.</p>
                </div>
                <div class="faq-item">
                    <h4>Mes données sont-elles sécurisées ?</h4>
                    <p>Nous utilisons un chiffrement AES-256 et des protocoles de sécurité de niveau bancaire.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="cta">
        <div class="container">
            <div class="cta-box">
                <h2 style="font-size: 48px; margin-bottom: 20px;">Prêt à transformer votre logistique ?</h2>
                <p style="color: var(--color-gray-400); margin-bottom: 40px;">Rejoignez les leaders du e-commerce qui font confiance à ORDA.</p>
                <div class="btn-group" style="display: flex; justify-content: center; gap: 20px;">
                    <button class="btn btn-gold">Démarrer l'essai gratuit</button>
                    <button class="btn btn-outline">Contacter un expert</button>
                </div>
            </div>
        </div>
    </section>

    <footer style="padding: 60px 0; border-top: 1px solid var(--glass-border);">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="logo">ORDA<span>.</span></div>
            <p style="color: var(--color-gray-400); font-size: 14px;">© 2026 ORDA Global. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Smooth scroll reveal effect
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>
</body>
</html>