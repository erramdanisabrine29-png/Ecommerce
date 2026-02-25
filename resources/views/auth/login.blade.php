<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ORDA - Connexion à votre espace administrateur">
    
    <title>Connexion – ORDA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Anurati&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'orda-black': '#0A0A0A',
                        'orda-black-light': '#1A1A1A',
                        'orda-black-medium': '#2D2D2D',
                        'orda-white': '#FFFFFF',
                        'orda-white-off': '#F8F8F8',
                        'orda-white-light': '#F5F5F5',
                        'orda-gold': '#D4AF37',
                        'orda-gold-light': '#E8C966',
                        'orda-gold-dark': '#B8962E',
                        'orda-gray-100': '#F3F3F3',
                        'orda-gray-200': '#E5E5E5',
                        'orda-gray-300': '#CCCCCC',
                        'orda-gray-400': '#999999',
                        'orda-gray-500': '#666666',
                        'orda-gray-600': '#444444',
                        'orda-gray-700': '#333333',
                    },
                    fontFamily: {
                        'plus': ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .input-focus-gold:focus {
            outline: none;
            border-color: #D4AF37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        }
        
        .btn-gold {
            background-color: #D4AF37;
            color: #0A0A0A;
            border: 2px solid #D4AF37;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-gold:hover {
            background-color: #B8962E;
            border-color: #B8962E;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }
        
        .link-gold {
            color: #D4AF37;
            transition: all 0.3s ease;
        }
        
        .link-gold:hover {
            color: #B8962E;
        }
        
        /* Smooth animations */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        
        .font-anurati {
            font-family: 'Anurati', sans-serif;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="bg-orda-white min-h-screen flex items-center justify-center">
    
    <!-- Background decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-1/2 -right-1/4 w-[800px] h-[800px] rounded-full bg-gradient-to-br from-orda-gold/5 to-transparent"></div>
        <div class="absolute -bottom-1/2 -left-1/4 w-[600px] h-[600px] rounded-full bg-gradient-to-tr from-orda-black/5 to-transparent"></div>
    </div>

    <div class="w-full max-w-md px-6 py-12 relative z-10">
        
        <!-- Logo -->
        <div class="text-center mb-10 fade-in-up">
            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2">
                <span class="font-anurati text-4xl font-extrabold text-orda-black">ORDA<span class="text-orda-gold">.</span></span>
            </a>
        </div>

        <!-- Card -->
        <div class="bg-orda-white rounded-2xl shadow-[0_40px_80px_rgba(0,0,0,0.08)] border border-orda-gray-100 p-10 fade-in-up delay-100">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-orda-black mb-2">Bienvenue</h1>
                <p class="text-orda-gray-500">Connectez-vous à votre espace administrateur</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-orda-black mb-3">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="vous@entreprise.com"
                        class="w-full px-5 py-4 bg-orda-white-off border-2 border-orda-gray-200 rounded-xl text-orda-black placeholder-orda-gray-400 transition-all duration-300 input-focus-gold @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @else
                        <p class="mt-2 text-sm text-orda-gray-400 hidden" id="emailError">Veuillez entrer une adresse email valide</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-orda-black mb-3">Mot de passe</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-5 py-4 bg-orda-white-off border-2 border-orda-gray-200 rounded-xl text-orda-black placeholder-orda-gray-400 transition-all duration-300 input-focus-gold @error('password') border-red-500 @enderror"
                        >
                        <button 
                            type="button" 
                            id="togglePassword"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-orda-gray-400 hover:text-orda-gray-600 transition-colors"
                        >
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @else
                        <p class="mt-2 text-sm text-orda-gray-400 hidden" id="passwordError">Le mot de passe est requis</p>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-2 border-orda-gray-300 text-orda-gold focus:ring-orda-gold focus:ring-offset-0 cursor-pointer accent-orda-gold"
                        >
                        <span class="text-sm text-orda-gray-600">Se souvenir de moi</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium link-gold">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    id="submitBtn"
                    class="w-full btn-gold font-semibold py-4 px-6 rounded-xl flex items-center justify-center gap-2"
                >
                    <span>Se connecter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-8 text-center">
                <p class="text-orda-gray-500">
                    Pas encore de compte ?
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="font-semibold link-gold ml-1">
                            S'inscrire
                        </a>
                    @endif
                </p>
            </div>
        </div>

        <!-- Back to home -->
        <div class="text-center mt-8 fade-in-up delay-300">
            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 text-orda-gray-500 hover:text-orda-black transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="text-sm font-medium">Retour à l'accueil</span>
            </a>
        </div>
    </div>

    <script>
        // Email validation
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        emailInput.addEventListener('blur', function() {
            if (this.value && !validateEmail(this.value)) {
                emailError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                emailError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });
        
        emailInput.addEventListener('input', function() {
            if (validateEmail(this.value)) {
                emailError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        // Password validation
        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('passwordError');
        
        passwordInput.addEventListener('blur', function() {
            if (this.value === '' && this.hasAttribute('required')) {
                passwordError.classList.remove('hidden');
                this.classList.add('border-red-500');
            }
        });
        
        passwordInput.addEventListener('input', function() {
            if (this.value) {
                passwordError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');
        
        togglePassword.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        });

        // Form submission
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate email
            if (!emailInput.value || !validateEmail(emailInput.value)) {
                emailError.classList.remove('hidden');
                emailInput.classList.add('border-red-500');
                isValid = false;
            }
            
            // Validate password
            if (!passwordInput.value) {
                passwordError.classList.remove('hidden');
                passwordInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Add animation on page load
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('opacity-0');
            setTimeout(() => {
                document.body.classList.add('transition-opacity', 'duration-500');
                document.body.classList.remove('opacity-0');
            }, 100);
        });
    </script>
</body>
</html>
