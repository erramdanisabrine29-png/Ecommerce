<div class="shopify-card">
  <div class="card-header">
    <h2>Applications - {{ $store->name }}</h2>
    <a href="{{ route('stores.shopify.config', $store->id) }}" class="btn btn-shopify">
      <svg class="icon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
      </svg>
      Shopify Configuration
    </a>
  </div>
  <div class="card-body">
    <p class="webhook-info">
      <strong>Webhook Shopify</strong> — Un webhook Shopify est un moyen pour votre boutique de communiquer avec nos systèmes en temps réel, vers notre point de terminaison.
    </p>
  </div>
</div>

<style>
  .shopify-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 24px;
    max-width: 600px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
    border: 1px solid #eaeef2;
  }

  .card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 16px;
  }

  .card-header h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
  }

  .btn-shopify {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #008060; /* Vert Shopify */
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: background 0.2s, transform 0.1s;
    border: none;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0,128,96,0.2);
  }

  .btn-shopify:hover {
    background: #006e52;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0,128,96,0.3);
  }

  .btn-shopify:active {
    transform: translateY(0);
  }

  .icon {
    margin-right: 4px;
  }

  .webhook-info {
    background: #f4f8fb;
    padding: 16px 20px;
    border-radius: 12px;
    margin: 8px 0 0 0;
    color: #2c3e50;
    font-size: 0.95rem;
    line-height: 1.5;
    border-left: 4px solid #008060;
  }

  .webhook-info strong {
    color: #1e293b;
    font-weight: 600;
  }
</style>