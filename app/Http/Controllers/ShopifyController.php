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

        return redirect()->route('stores.shopify.config', $store->id)
            ->with('success', 'Shopify connecté avec succès ! Vous pouvez maintenant configurer le webhook secret.');
    }

    /**
     * STEP 3: Register Orders Webhook
     */
    private function registerWebhook(Store $store)
    {
        try {
            $token = decrypt($store->shopify_token);

            // Use the new token-based webhook URL
            $webhookUrl = route('shopify.webhook.order.creation', ['store_token' => $store->store_token]);

            Http::withHeaders([
                'X-Shopify-Access-Token' => $token
            ])->post("https://{$store->shopify_domain}/admin/api/2023-10/webhooks.json", [
                "webhook" => [
                    "topic" => "orders/create",
                    "address" => $webhookUrl,
                    "format" => "json"
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Webhook registration failed: ' . $e->getMessage());
        }
    }

    /**
     * STEP 4: Handle incoming webhook (orders/create) - Main webhook endpoint
     * This is the main endpoint that Shopify will call when a new order is created
     */
    public function handleWebhookOrder(Request $request)
    {
        try {
            // Get HMAC header from Shopify
            $hmacHeader = $request->header('X-Shopify-Hmac-Sha256');
            
            if (!$hmacHeader) {
                Log::warning('Shopify webhook received without HMAC header');
                return response()->json(['error' => 'Missing HMAC header'], 401);
            }

            // Get raw request body
            $data = $request->getContent();

            // Find store by domain from Shopify headers
            $shopDomain = $request->header('X-Shopify-Shop-Domain');
            
            if (!$shopDomain) {
                Log::warning('Shopify webhook received without shop domain header');
                return response()->json(['error' => 'Missing shop domain'], 401);
            }

            $store = Store::where('shopify_domain', $shopDomain)->first();

            if (!$store) {
                Log::warning('Store not found for webhook. Domain: ' . $shopDomain);
                return response()->json(['error' => 'Store not found'], 404);
            }

            // Check if webhook_secret is configured in database
            if (empty($store->webhook_secret_encrypted)) {
                Log::warning('Webhook secret not configured for store: ' . $store->id);
                return response()->json(['error' => 'Webhook secret not configured'], 401);
            }

            // Decrypt webhook secret from database
            try {
                $webhookSecret = decrypt($store->webhook_secret_encrypted);
            } catch (\Exception $e) {
                Log::error('Failed to decrypt webhook secret for store: ' . $store->id, [
                    'message' => $e->getMessage()
                ]);
                return response()->json(['error' => 'Webhook secret configuration error'], 500);
            }

            // Verify webhook HMAC using the secret from database
            $calculatedHmac = base64_encode(
                hash_hmac('sha256', $data, $webhookSecret, true)
            );

            if (!hash_equals($hmacHeader, $calculatedHmac)) {
                Log::warning('Invalid webhook HMAC for store: ' . $store->id);
                return response()->json(['error' => 'Invalid signature'], 401);
            }

            // Parse the order data from Shopify
            $payload = json_decode($data, true);

            if (!$payload || !isset($payload['id'])) {
                Log::warning('Invalid webhook payload for store: ' . $store->id);
                return response()->json(['error' => 'Invalid payload'], 400);
            }

            // Extract order details
            $orderData = [
                'store_id' => $store->id,
                'reference' => 'SHP-' . $payload['id'],
                'total_amount' => $payload['total_price'] ?? 0,
                'status' => $this->mapShopifyStatus($payload['financial_status'] ?? 'pending'),
            ];

            // Check if order already exists (by Shopify order ID)
            $existingOrder = Order::where('store_id', $store->id)
                ->where('reference', 'SHP-' . $payload['id'])
                ->first();

            if ($existingOrder) {
                // Update existing order
                $existingOrder->update($orderData);
                Log::info('Order updated from Shopify: ' . $existingOrder->id);
            } else {
                // Create new order
                $order = Order::create($orderData);
                Log::info('Order created from Shopify: ' . $order->id);
            }

            // Return 200 OK to Shopify
            return response()->json(['success' => true, 'message' => 'Order processed successfully'], 200);

        } catch (\Exception $e) {
            Log::error('Error processing Shopify webhook: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    /**
     * Map Shopify financial status to our order status
     */
    private function mapShopifyStatus($shopifyStatus): string
    {
        return match($shopifyStatus) {
            'paid' => 'confirmed',
            'pending' => 'pending',
            'refunded' => 'refunded',
            'voided' => 'cancelled',
            default => 'pending'
        };
    }

    /**
     * Legacy webhook handler (for backward compatibility)
     */
    public function webhook(Request $request)
    {
        $hmacHeader = $request->header('X-Shopify-Hmac-Sha256');
        $data = $request->getContent();

        // Find store by domain
        $shopDomain = $request->header('X-Shopify-Shop-Domain');
        $store = Store::where('shopify_domain', $shopDomain)->first();

        if (!$store) {
            Log::warning('Store not found for webhook.');
            return response()->json(['error' => 'Store not found'], 404);
        }

        // Check if webhook_secret is configured in database
        if (empty($store->webhook_secret_encrypted)) {
            Log::warning('Webhook secret not configured for store: ' . $store->id);
            return response()->json(['error' => 'Webhook secret not configured'], 401);
        }

        // Decrypt webhook secret from database
        try {
            $webhookSecret = decrypt($store->webhook_secret_encrypted);
        } catch (\Exception $e) {
            Log::error('Failed to decrypt webhook secret: ' . $e->getMessage());
            return response()->json(['error' => 'Webhook secret configuration error'], 500);
        }

        // Verify webhook HMAC using the secret from database
        $calculatedHmac = base64_encode(
            hash_hmac('sha256', $data, $webhookSecret, true)
        );

        if (!hash_equals($hmacHeader, $calculatedHmac)) {
            Log::warning('Invalid webhook HMAC for store: ' . $store->id);
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $payload = json_decode($data, true);

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
