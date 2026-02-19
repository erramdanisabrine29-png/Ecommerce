<x-layouts.app>
<style>
* {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.big-container {
    padding: 80px 20px;
    background: linear-gradient(135deg, #f4f7fb 0%, #e8f0f5 100%);
    min-height: 100vh;
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.premium-card {
    max-width: 1300px;
    margin: auto;
    background: white;
    padding: 80px;
    border-radius: 30px;
    box-shadow: 0 30px 70px rgba(0,0,0,0.08);
    animation: slideUp 0.6s ease-out 0.2s both;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.premium-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 35px 80px rgba(0,0,0,0.12);
}

.top-header {
    animation: fadeIn 0.8s ease-out 0.3s both;
}

.top-header h1 {
    font-size: 50px;
    font-weight: 800;
    margin-bottom: 15px;
    background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: all 0.3s ease;
}

.top-header p {
    font-size: 24px;
    color: #6c757d;
    margin-bottom: 70px;
    line-height: 1.6;
    transition: color 0.3s ease;
}

.input-block {
    margin-bottom: 70px;
    animation: fadeIn 0.6s ease-out;
    animation-fill-mode: both;
}

.input-block:nth-child(1) {
    animation-delay: 0.4s;
}

.input-block:nth-child(2) {
    animation-delay: 0.5s;
}

.input-block label {
    display: block;
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 25px;
    letter-spacing: 1px;
    color: #1e293b;
    transition: color 0.3s ease;
}

.input-line {
    display: flex;
    gap: 25px;
    align-items: center;
}

.input-line input {
    flex: 1;
    height: 85px;
    font-size: 22px;
    padding: 0 35px;
    border-radius: 22px;
    border: 2px solid #e0e6ed;
    background: #f9fafc;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    color: #1e293b;
}

.input-line input:hover {
    border-color: #cbd5e1;
    background: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.input-line input:focus {
    outline: none;
    border-color: #5e8e3e;
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(94, 142, 62, 0.15);
}

.input-line button {
    height: 85px;
    padding: 0 45px;
    font-size: 22px;
    font-weight: 800;
    border-radius: 22px;
    border: none;
    background: linear-gradient(135deg, #95bf47, #5e8e3e);
    color: white;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.input-line button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.input-line button:hover::before {
    left: 100%;
}

.input-line button:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(94, 142, 62, 0.3);
    background: linear-gradient(135deg, #a5cf57, #6e9e4e);
}

.input-line button:active {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(94, 142, 62, 0.25);
}

.input-line button.copied {
    background: linear-gradient(135deg, #10b981, #059669);
    animation: pulse 0.5s ease;
}

.input-line button .btn-text {
    display: inline-block;
    transition: all 0.3s ease;
}

.input-line button.copied .btn-text {
    transform: scale(1.1);
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.empty-state {
    text-align: center;
    animation: fadeIn 0.8s ease-out 0.4s both;
}

.empty-state h2 {
    font-size: 32px;
    margin-bottom: 50px;
    color: #1e293b;
    font-weight: 700;
}

.big-generate-btn {
    padding: 28px 80px;
    font-size: 26px;
    font-weight: 900;
    border-radius: 25px;
    border: none;
    background: linear-gradient(135deg, #95bf47, #5e8e3e);
    color: white;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(94, 142, 62, 0.2);
}

.big-generate-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s;
}

.big-generate-btn:hover::before {
    left: 100%;
}

.big-generate-btn:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 25px 50px rgba(94, 142, 62, 0.35);
    background: linear-gradient(135deg, #a5cf57, #6e9e4e);
}

.big-generate-btn:active {
    transform: translateY(-2px) scale(1);
    box-shadow: 0 15px 30px rgba(94, 142, 62, 0.3);
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .big-container {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }
    
    .premium-card {
        background: #1e293b;
        box-shadow: 0 30px 70px rgba(0,0,0,0.3);
    }
    
    .top-header h1 {
        background: linear-gradient(135deg, #f1f5f9 0%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .top-header p {
        color: #94a3b8;
    }
    
    .input-block label {
        color: #f1f5f9;
    }
    
    .input-line input {
        background: #0f172a;
        border-color: #334155;
        color: #f1f5f9;
    }
    
    .input-line input:hover {
        background: #1e293b;
        border-color: #475569;
    }
    
    .input-line input:focus {
        background: #1e293b;
        border-color: #5e8e3e;
    }
    
    .empty-state h2 {
        color: #f1f5f9;
    }
}

/* Smooth scroll */
html {
    scroll-behavior: smooth;
}

/* Loading state */
.big-generate-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.big-generate-btn:disabled:hover {
    transform: none;
    box-shadow: 0 10px 30px rgba(94, 142, 62, 0.2);
}
</style>

<div class="big-container">

    <div class="premium-card">

        <div class="top-header">
            <h1>Shopify Webhook Configuration</h1>
            <p>Configurez votre boutique avec une intégration sécurisée et professionnelle.</p>
        </div>

        @if(empty($store->webhook_secret))

            <div class="empty-state">
                <h2>Aucun Webhook configuré</h2>

                <form method="POST"
                      action="{{ route('stores.shopify.generate', $store->id) }}"
                      onsubmit="handleFormSubmit(event)">
                    @csrf

                    <button type="submit" class="big-generate-btn" id="generateBtn">
                        <span class="btn-content">
                            <span class="btn-text">Générer Webhook Maintenant</span>
                            <span class="btn-loader" style="display: none;">
                                <svg class="animate-spin" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </span>
                    </button>
                </form>
            </div>

        @else

            {{-- SECRET --}}
            <div class="input-block">
                <label>WEBHOOK SECRET</label>

                <div class="input-line">
                    <input type="text"
                           value="{{ $store->webhook_secret }}"
                           readonly>

                    <button type="button"
                            class="copy-btn"
                            data-text="{{ $store->webhook_secret }}"
                            onclick="copyToClipboard(this, '{{ $store->webhook_secret }}')">
                        <span class="btn-text">Copier</span>
                    </button>
                </div>
            </div>

            {{-- URL --}}
            <div class="input-block">
                <label>WEBHOOK URL</label>

                <div class="input-line">
                    <input type="text"
                           value="{{ url('/webhook/shopify/order/'.$store->webhook_token.'/creation') }}"
                           readonly>

                    <button type="button"
                            class="copy-btn"
                            data-text="{{ url('/webhook/shopify/order/'.$store->webhook_token.'/creation') }}"
                            onclick="copyToClipboard(this, '{{ url('/webhook/shopify/order/'.$store->webhook_token.'/creation') }}')">
                        <span class="btn-text">Copier</span>
                    </button>
                </div>
            </div>

        @endif

    </div>

</div>

<style>
.big-generate-btn .btn-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.big-generate-btn .btn-loader {
    display: inline-block;
}

.big-generate-btn.loading .btn-text {
    opacity: 0;
}

.big-generate-btn.loading .btn-loader {
    display: inline-block !important;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>

<script>
function copyToClipboard(button, text) {
    navigator.clipboard.writeText(text).then(() => {
        const btnText = button.querySelector('.btn-text');
        const originalText = btnText.textContent;
        
        button.classList.add('copied');
        btnText.textContent = 'Copié!';
        
        setTimeout(() => {
            button.classList.remove('copied');
            btnText.textContent = originalText;
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
        alert('Erreur lors de la copie');
    });
}

function handleFormSubmit(event) {
    const button = document.getElementById('generateBtn');
    if (button) {
        button.classList.add('loading');
        button.disabled = true;
    }
}

// Add smooth entrance animation for elements
document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('.input-block, .empty-state');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 300 + (index * 100));
    });
});
</script>
</x-layouts.app>
