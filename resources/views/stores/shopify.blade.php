<x-layouts.app>
<style>
.big-container {
    padding: 80px 20px;
    background: #f4f7fb;
    min-height: 100vh;
}

.premium-card {
    max-width: 1300px;
    margin: auto;
    background: white;
    padding: 80px;
    border-radius: 30px;
    box-shadow: 0 30px 70px rgba(0,0,0,0.08);
}

.top-header h1 {
    font-size: 50px;
    font-weight: 800;
    margin-bottom: 15px;
}

.top-header p {
    font-size: 24px;
    color: #6c757d;
    margin-bottom: 70px;
}

.input-block {
    margin-bottom: 70px;
}

.input-block label {
    display: block;
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 25px;
    letter-spacing: 1px;
}

.input-line {
    display: flex;
    gap: 25px;
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
}

.input-line input:focus {
    outline: none;
    border-color: #5e8e3e;
    background: white;
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
    transition: 0.3s;
}

.input-line button:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.empty-state {
    text-align: center;
}

.empty-state h2 {
    font-size: 32px;
    margin-bottom: 50px;
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
    transition: 0.3s;
}

.big-generate-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
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
                      action="{{ route('stores.shopify.generate', $store->id) }}">
                    @csrf

                    <button type="submit" class="big-generate-btn">
                        Générer Webhook Maintenant
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
                            onclick="navigator.clipboard.writeText('{{ $store->webhook_secret }}')">
                        Copier
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
                            onclick="navigator.clipboard.writeText('{{ url('/webhook/shopify/order/'.$store->webhook_token.'/creation') }}')">
                        Copier
                    </button>
                </div>
            </div>

        @endif

    </div>

</div>
</x-layouts.app>
