<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class StoreController extends Controller
{
    /**
     * Display a listing of the authenticated user's stores (or all for Administrator).
     */
    public function applications(Store $store)
{
    return view('stores.applications', compact('store'));
}

public function shopifyConfig(Store $store)
{
    return view('stores.shopify', compact('store'));
}

/**
 * Check if store is connected to Shopify
 */
public function isShopifyConnected(Store $store): bool
{
    return !empty($store->shopify_token) && !empty($store->shopify_domain);
}

/**
 * Initiate Shopify OAuth connection
 * Redirects merchant to Shopify authorization page
 */
public function connectShopify(Store $store)
{
    $this->authorize('update', $store);

    // Validate that we have a shop domain
    $shopDomain = $store->url;
    
    if (!$shopDomain) {
        return redirect()->route('stores.shopify.config', $store->id)
            ->with('error', 'URL de la boutique requise pour la connexion Shopify.');
    }

    // Clean the shop domain (remove https:// if present)
    $shopDomain = preg_replace('#^https?://#', '', $shopDomain);
    $shopDomain = rtrim($shopDomain, '/');

    // Build OAuth authorization URL
    $scopes = 'read_orders,read_products,write_webhooks';
    $redirectUri = route('shopify.callback');
    $state = $store->id;

    $authorizationUrl = "https://{$shopDomain}/admin/oauth/authorize?" . http_build_query([
        'client_id' => config('services.shopify.key'),
        'scope' => $scopes,
        'redirect_uri' => $redirectUri,
        'state' => $state,
    ]);

    Log::info('Initiating Shopify OAuth for store: ' . $store->id, [
        'shop' => $shopDomain,
        'redirect_uri' => $redirectUri
    ]);

    return redirect($authorizationUrl);
}

/**
 * Disconnect Shopify (remove tokens)
 */
public function disconnectShopify(Store $store)
{
    $this->authorize('update', $store);

    $store->update([
        'shopify_token' => null,
        'shopify_domain' => null,
        'shopify_connected_at' => null,
        'webhook_secret' => null,
        'webhook_secret_encrypted' => null,
    ]);

    Log::info('Shopify disconnected for store: ' . $store->id);

    return redirect()->route('stores.shopify.config', $store->id)
        ->with('success', 'Boutique Shopify déconnectée.');
}

public function generateWebhook(Store $store)
{
    // Generate only webhook_token (for URL), NOT webhook_secret
    // User must manually input webhook_secret from their Shopify dashboard
    if (!$store->webhook_token) {
        $store->webhook_token = Str::random(32);
        $store->save();
    }

    return redirect()->route('stores.shopify.config', $store->id);
}

/**
 * Update webhook secret manually (Admin only)
 * User should paste the secret from their Shopify dashboard
 * This will also verify the Shopify connection and register the webhook
 */
public function updateWebhookSecret(Request $request, Store $store)
{
    $this->authorize('update', $store);

    $validated = $request->validate([
        'webhook_secret' => 'required|string|min:20|max:255',
    ]);

    try {
        // Step 1: Verify Shopify connection using the stored access token
        if (!$store->shopify_token || !$store->shopify_domain) {
            return redirect()->route('stores.shopify.config', $store->id)
                ->with('error', 'Boutique Shopify non connectée. Veuillez d\'abord connecter votre boutique.');
        }

        $accessToken = decrypt($store->shopify_token);

        // Test API connection by fetching shop info
        $shopResponse = Http::withHeaders([
            'X-Shopify-Access-Token' => $accessToken
        ])->get("https://{$store->shopify_domain}/admin/api/2024-01/shop.json");

        if (!$shopResponse->successful()) {
            Log::error('Shopify connection verification failed for store: ' . $store->id);
            return redirect()->route('stores.shopify.config', $store->id)
                ->with('error', 'Connexion à Shopify invalide. Veuillez reconnecter votre boutique.');
        }

        // Step 2: Register webhook on Shopify
        $webhookUrl = route('shopify.webhook.order');
        
        $webhookResponse = Http::withHeaders([
            'X-Shopify-Access-Token' => $accessToken,
            'Content-Type' => 'application/json'
        ])->post("https://{$store->shopify_domain}/admin/api/2024-01/webhooks.json", [
            'webhook' => [
                'topic' => 'orders/create',
                'address' => $webhookUrl,
                'format' => 'json'
            ]
        ]);

        if (!$webhookResponse->successful()) {
            $errorBody = $webhookResponse->body();
            Log::error('Failed to register Shopify webhook for store: ' . $store->id, [
                'error' => $errorBody
            ]);
            
            // Check if webhook already exists
            $webhookExistsResponse = Http::withHeaders([
                'X-Shopify-Access-Token' => $accessToken
            ])->get("https://{$store->shopify_domain}/admin/api/2024-01/webhooks.json");

            if ($webhookExistsResponse->successful()) {
                $webhooks = $webhookExistsResponse->json('webhooks');
                $existingWebhook = collect($webhooks)->firstWhere('topic', 'orders/create');
                
                if ($existingWebhook) {
                    // Webhook already exists, that's fine
                    Log::info('Webhook already exists for store: ' . $store->id);
                } else {
                    return redirect()->route('stores.shopify.config', $store->id)
                        ->with('error', 'Impossible d\'enregistrer le webhook sur Shopify: ' . $errorBody);
                }
            }
        }

        // Step 3: Encrypt and store the webhook secret
        $encryptedSecret = encrypt($validated['webhook_secret']);

        $store->update([
            'webhook_secret' => $validated['webhook_secret'],
            'webhook_secret_encrypted' => $encryptedSecret,
            'shopify_connected_at' => now(), // Mark as connected
        ]);

        Log::info('Webhook secret configured successfully for store: ' . $store->id);

        return redirect()->route('stores.shopify.config', $store->id)
            ->with('success', 'Webhook secret configuré avec succès. Boutique Shopify connectée et webhook enregistré.');

    } catch (\Exception $e) {
        Log::error('Error configuring webhook secret for store: ' . $store->id, [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->route('stores.shopify.config', $store->id)
            ->with('error', 'Erreur lors de la configuration: ' . $e->getMessage());
    }
}

/**
 * Delete webhook secret (Admin only)
 */
public function deleteWebhookSecret(Store $store)
{
    $this->authorize('update', $store);

    $store->update([
        'webhook_secret' => null,
        'webhook_secret_encrypted' => null,
    ]);

    return redirect()->route('stores.shopify.config', $store->id)
        ->with('success', 'Webhook secret supprimé.');
}

    public function index()
    {
        $this->authorize('viewAny', Store::class);
        $query = Auth::user()->hasRole('Administrator')
            ? Store::query()
            : Store::where('user_id', Auth::id());
        $stores = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new store.
     */
    public function create()
    {
        $this->authorize('create', Store::class);
        return view('stores.create');
    }

    /**
     * Store a newly created store in database.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Store::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|unique:stores,url',
            'ssl_certificate_status' => 'nullable|in:active,inactive,expired,pending',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'minimum_stock' => 'required|integer|min:1',
            'api_key' => 'nullable|string|unique:stores,api_key',
        ]);

        // Generate API key if not provided
        if (empty($validated['api_key'])) {
            $validated['api_key'] = Store::generateUniqueApiKey();
        }

        // Set default ssl_certificate_status if not provided
        if (empty($validated['ssl_certificate_status'])) {
            $validated['ssl_certificate_status'] = 'pending';
        }

        $validated['user_id'] = Auth::id();
        $store = Store::create($validated);

        return redirect()->route('stores.show', $store)
            ->with('success', 'Magasin créé avec succès.');
    }

    /**
     * Display the specified store.
     */
    public function show(Store $store)
    {
        $this->authorize('view', $store);
        return view('stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified store.
     */
    public function edit(Store $store)
    {
        $this->authorize('update', $store);
        return view('stores.edit', compact('store'));
    }

    /**
     * Update the specified store.
     */
    public function update(Request $request, Store $store)
    {
        $this->authorize('update', $store);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|unique:stores,url,' . $store->id,
            'ssl_certificate_status' => 'nullable|in:active,inactive,expired,pending',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'minimum_stock' => 'required|integer|min:1',
        ]);

        // Set default ssl_certificate_status if not provided
        if (empty($validated['ssl_certificate_status'])) {
            $validated['ssl_certificate_status'] = 'pending';
        }

        $store->update($validated);

        return redirect()->route('stores.show', $store)
            ->with('success', 'Magasin mis à jour avec succès.');
    }

    /**
     * Delete the specified store.
     */
    public function destroy(Store $store)
    {
        $this->authorize('delete', $store);
        $name = $store->name;
        $store->delete();

        return redirect()->route('stores.index')
            ->with('success', "Magasin '{$name}' supprimé avec succès.");
    }

    /**
     * Regenerate API key for the specified store.
     */
    public function regenerateApiKey(Store $store)
    {
        $this->authorize('update', $store);

        $store->update([
            'api_key' => Store::generateUniqueApiKey(),
        ]);

        return redirect()->route('stores.show', $store)
            ->with('success', 'Clé API régénérée avec succès.');
    }

    /**
     * Get store details as JSON (for AJAX).
     */
    public function getJson(Store $store)
    {
        $this->authorize('view', $store);

        return response()->json([
            'id' => $store->id,
            'name' => $store->name,
            'url' => $store->url,
            'api_key' => $store->api_key,
            'ssl_certificate_status' => $store->ssl_certificate_status,
            'tax_rate' => $store->tax_rate,
            'minimum_stock' => $store->minimum_stock,
        ]);
    }
}
