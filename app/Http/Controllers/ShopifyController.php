<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Store;
use App\Models\Order;

class ShopifyController extends Controller
{
    /**
     * STEP 1: Redirect merchant to Shopify OAuth
     */
    public function connect(Store $store, Request $request)
    {
        $shop = $request->query('shop');

        if (!$shop) {
            return back()->with('error', 'Shop parameter is missing.');
        }

        $query = http_build_query([
            'client_id' => config('services.shopify.key'),
            'scope' => 'read_orders,read_products',
            'redirect_uri' => route('shopify.callback'),
            'state' => $store->id,
        ]);

        return redirect("https://{$shop}/admin/oauth/authorize?{$query}");
    }

    /**
     * STEP 2: Handle OAuth callback and store access token
     */
    public function callback(Request $request)
    {
        $request->validate([
            'shop' => 'required|string',
            'code' => 'required|string',
            'state' => 'required'
        ]);

        // Verify HMAC
        if (!$this->verifyHmac($request)) {
            abort(403, 'Invalid HMAC signature.');
        }

        $shop = $request->shop;
        $code = $request->code;
        $storeId = $request->state;

        $response = Http::post("https://{$shop}/admin/oauth/access_token", [
            'client_id' => config('services.shopify.key'),
            'client_secret' => config('services.shopify.secret'),
            'code' => $code,
        ]);

        if (!$response->successful()) {
            return back()->with('error', 'Failed to retrieve access token.');
        }

        $data = $response->json();

        $store = Store::findOrFail($storeId);

        $store->update([
            'shopify_domain' => $shop,
            'shopify_token' => encrypt($data['access_token']),
            'shopify_connected_at' => now(),
        ]);

        // Register webhook after successful connection
        $this->registerWebhook($store);

        return redirect()->route('stores.index')git
            ->with('success', 'Shopify connected successfully.');
    }

    /**
     * STEP 3: Register Orders Webhook
     */
    private function registerWebhook(Store $store)
    {
        try {
            $token = decrypt($store->shopify_token);

            Http::withHeaders([
                'X-Shopify-Access-Token' => $token
            ])->post("https://{$store->shopify_domain}/admin/api/2023-10/webhooks.json", [
                "webhook" => [
                    "topic" => "orders/create",
                    "address" => route('shopify.webhook'),
                    "format" => "json"
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Webhook registration failed: ' . $e->getMessage());
        }
    }

    /**
     * STEP 4: Handle incoming webhook (orders/create)
     */
    public function webhook(Request $request)
    {
        $hmacHeader = $request->header('X-Shopify-Hmac-Sha256');
        $data = $request->getContent();

        // Verify webhook HMAC
        $calculatedHmac = base64_encode(
            hash_hmac('sha256', $data, config('services.shopify.secret'), true)
        );

        if (!hash_equals($hmacHeader, $calculatedHmac)) {
            Log::warning('Invalid webhook HMAC.');
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $payload = json_decode($data, true);

        // Find store by domain
        $shopDomain = $request->header('X-Shopify-Shop-Domain');
        $store = Store::where('shopify_domain', $shopDomain)->first();

        if (!$store) {
            Log::warning('Store not found for webhook.');
            return response()->json(['error' => 'Store not found'], 404);
        }

        Order::create([
            'store_id' => $store->id,
            'reference' => $payload['id'],
            'total_amount' => $payload['total_price'],
            'status' => $payload['financial_status'] ?? 'pending',
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Verify OAuth HMAC
     */
    private function verifyHmac(Request $request)
    {
        $hmac = $request->query('hmac');
        $query = $request->query();

        unset($query['hmac']);

        ksort($query);

        $calculated = hash_hmac(
            'sha256',
            urldecode(http_build_query($query)),
            config('services.shopify.secret')
        );

        return hash_equals($hmac, $calculated);
    }
}
