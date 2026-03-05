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

.btn-delete {
    background: linear-gradient(135deg, #ef4444, #dc2626) !important;
}

.btn-delete:hover {
    background: linear-gradient(135deg, #f87171, #ef4444) !important;
}

.alert {
    padding: 20px 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    font-size: 18px;
    font-weight: 600;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border: 2px solid #10b981;
}

.alert-error {
    background: #fee2e2;
    color: #991b1b;
    border: 2px solid #ef4444;
}

.alert-info {
    background: #dbeafe;
    color: #1e40af;
    border: 2px solid #3b82f6;
}
</style>

<div class="big-container">

    <div class="premium-card">

        <div class="top-header">
            <h1>Shopify Webhook Configuration</h1>
            <p>Configurez votre boutique avec une intégration sécurisée et professionnelle.</p>
        </div>

        {{-- Display success/error messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- SHOPIFY CONNECTION STATUS --}}
        <div class="input-block">
            <label>CONNEXION SHOPIFY</label>
            
            @if($store->shopify_connected_at)
                <div class="alert alert-success">
                    ✓ Boutique Shopify connectée le {{ $store->shopify_connected_at->format('d/m/Y à H:i') }}
                </div>
                <form method="POST" action="{{ route('stores.shopify.disconnect', $store->id) }}" 
                      onsubmit="return confirm('Voulez-vous vraiment déconnecter la boutique Shopify ?');" 
                      style="margin-top: 15px;">
                    @csrf
                    <button type="submit" class="btn-delete" style="height: 60px; padding: 0 30px; font-size: 18px; border-radius: 15px;">
                        <span class="btn-text">Déconnecter Shopify</span>
                    </button>
                </form>
            @else
                <div class="alert alert-info">
                    ⚠ Boutique Shopify non connectée
                </div>
                <p style="font-size: 16px; color: #6b7280; margin-bottom: 20px;">
                    Cliquez sur le bouton ci-dessous pour autoriser l'accès à votre boutique Shopify.
                </p>
                <form method="POST" action="{{ route('stores.shopify.connect', $store->id) }}">
                    @csrf
                    <button type="submit" class="big-generate-btn" style="padding: 20px 60px; font-size: 20px;">
                        <span class="btn-text">Connecter Shopify</span>
                    </button>
                </form>
            @endif
        </div>

        {{-- If webhook_token not generated, show generate button --}}
        @if(empty($store->webhook_token))

            <div class="empty-state">
                <h2>Générer l'URL du Webhook</h2>
                <p style="font-size: 18px; color: #6b7280; margin-bottom: 40px;">
                    Cliquez sur le bouton ci-dessous pour générer l'URL du webhook.<br>
                    Le secret devra être saisi manuellement après.
                </p>

                <form method="POST"
                      action="{{ route('stores.shopify.generate', $store->id) }}"
                      onsubmit="handleFormSubmit(event)">
                    @csrf

                    <button type="submit" class="big-generate-btn" id="generateBtn">
                        <span class="btn-content">
                            <span class="btn-text">Générer l'URL du Webhook</span>
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

            {{-- WEBHOOK SECRET INPUT --}}
            <div class="input-block">
                <label>WEBHOOK SECRET</label>
                <p style="font-size: 16px; color: #6b7280; margin-bottom: 20px;">
                    Collez le secret généré depuis votre dashboard Shopify (Admin > Settings > Notifications > Webhooks)
                </p>

                <form method="POST" 
                      action="{{ route('stores.shopify.updateSecret', $store->id) }}"
                      id="webhookSecretForm">
                    @csrf
                    @method('PUT')

                    <div class="input-line">
                        <input type="password"
                               name="webhook_secret"
                               placeholder="Collez votre webhook secret ici..."
                               value="{{ $store->webhook_secret ?? '' }}"
                               autocomplete="off">

                        <button type="submit" class="save-btn">
                            <span class="btn-text">Enregistrer</span>
                        </button>

                        @if(!empty($store->webhook_secret))
                            <button type="button" 
                                    class="btn-delete"
                                    onclick="deleteWebhookSecret({{ $store->id }})">
                                <span class="btn-text">Supprimer</span>
                            </button>
                        @endif
                    </div>
                </form>

                @error('webhook_secret')
                    <div style="color: #ef4444; font-size: 16px; margin-top: 15px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- WEBHOOK URL --}}
            <div class="input-block">
                <label>WEBHOOK URL</label>
                <p style="font-size: 16px; color: #6b7280; margin-bottom: 20px;">
                    Copiez cette URL et collez-la dans votre dashboard Shopify (Settings > Notifications > Webhooks)
                </p>

                <div class="input-line">
                    <input type="text"
                           value="{{ $store->getWebhookUrl() }}"
                           readonly>

                    <button type="button"
                            class="copy-btn"
                            data-text="{{ $store->getWebhookUrl() }}"
                            onclick="copyToClipboard(this, '{{ $store->getWebhookUrl() }}')">
                        <span class="btn-text">Copier</span>
                    </button>
                </div>
            </div>

            {{-- STATUS --}}
            <div class="input-block">
                <label>STATUT</label>
                <div class="alert {{ !empty($store->webhook_secret) ? 'alert-success' : 'alert-info' }}">
                    @if(!empty($store->webhook_secret))
                        ✓ Webhook secret configuré et actif
                    @else
                        ⚠ Webhook secret non configuré - Les webhooks seront rejetés
                    @endif
                </div>
            </div>

        @endif

    </div>

</div>

{{-- Delete Confirmation Form (hidden) --}}
<form id="deleteSecretForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

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

function deleteWebhookSecret(storeId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer le webhook secret ? Les webhooks seront rejetés jusqu\'à ce qu\'un nouveau secret soit configuré.')) {
        const form = document.getElementById('deleteSecretForm');
        form.action = `/stores/${storeId}/applications/shopify/secret`;
        form.submit();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('.input-block, .empty-state, .alert');
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
