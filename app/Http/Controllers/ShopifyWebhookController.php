<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\ShopifyOrder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

/**
 * Shopify Webhook Controller
 * 
 * Handles incoming webhooks from Shopify for order events.
 * Uses HMAC verification for security.
 */
class ShopifyWebhookController extends Controller
{
    /**
     * HMAC header name used by Shopify.
     */
    const HMAC_HEADER = 'X-Shopify-Hmac-Sha256';

    /**
     * Shop domain header from Shopify.
     */
    const SHOP_DOMAIN_HEADER = 'X-Shopify-Shop-Domain';

    /**
     * Topic header from Shopify.
     */
    const TOPIC_HEADER = 'X-Shopify-Topic';

    /**
     * Handle order creation webhook from Shopify.
     * 
     * Route: POST /webhook/shopify/order/{store_token}/creation
     * 
     * @param Request $request
     * @param string $store_token
     * @return JsonResponse
     */
    public function handleOrderCreation(Request $request, string $store_token): JsonResponse
    {
        // Step 1: Find the store by store_token
        $store = Store::findByStoreToken($store_token);

        if (!$store) {
            Log::warning('Shopify webhook received for unknown store token', [
                'store_token' => $store_token,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'error' => 'Store not found',
            ], 404);
        }

        // Step 2: Verify HMAC signature
        $hmacHeader = $request->header(self::HMAC_HEADER);

        if (!$hmacHeader) {
            Log::warning('Shopify webhook received without HMAC header', [
                'store_id' => $store->id,
                'store_name' => $store->name,
            ]);

            return response()->json([
                'error' => 'Missing HMAC signature',
            ], 401);
        }

        // Get raw request body
        $data = $request->getContent();

        // Get webhook secret
        $webhookSecret = $store->getWebhookSecret();

        if (!$webhookSecret) {
            Log::warning('Webhook secret not configured for store', [
                'store_id' => $store->id,
                'store_name' => $store->name,
            ]);

            return response()->json([
                'error' => 'Webhook secret not configured',
            ], 401);
        }

        // Verify HMAC
        if (!$this->verifyHmac($data, $hmacHeader, $webhookSecret)) {
            Log::warning('Invalid webhook HMAC signature', [
                'store_id' => $store->id,
                'store_name' => $store->name,
                'received_hmac' => $hmacHeader,
            ]);

            return response()->json([
                'error' => 'Invalid signature',
            ], 401);
        }

        // Step 3: Parse the order data
        $payload = json_decode($data, true);

        if (!$payload || !isset($payload['id'])) {
            Log::warning('Invalid webhook payload', [
                'store_id' => $store->id,
            ]);

            return response()->json([
                'error' => 'Invalid payload',
            ], 400);
        }

        // Get topic for logging
        $topic = $request->header(self::TOPIC_HEADER);

        Log::info('Shopify webhook received', [
            'store_id' => $store->id,
            'store_name' => $store->name,
            'topic' => $topic,
            'order_id' => $payload['id'],
            'order_number' => $payload['order_number'] ?? $payload['name'] ?? null,
        ]);

        // Step 4: Process the order
        try {
            $shopifyOrderId = (string) $payload['id'];

            // Check for duplicate order
            $existingOrder = ShopifyOrder::findByShopifyId($shopifyOrderId, $store->id);

            if ($existingOrder) {
                // Update existing order
                $existingOrder->updateFromPayload($payload);
                
                Log::info('Shopify order updated (duplicate webhook)', [
                    'shopify_order_id' => $shopifyOrderId,
                    'store_id' => $store->id,
                    'local_order_id' => $existingOrder->id,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Order already exists, updated',
                    'order_id' => $existingOrder->id,
                ], 200);
            }

            // Create new order
            $order = ShopifyOrder::createFromPayload($payload, $store->id);

            Log::info('Shopify order created successfully', [
                'shopify_order_id' => $shopifyOrderId,
                'store_id' => $store->id,
                'local_order_id' => $order->id,
                'customer_email' => $order->customer_email,
                'total_price' => $order->total_price,
                'currency' => $order->currency,
            ]);

            // Optionally: Trigger additional processing here
            // $this->processOrder($order);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $order->id,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error processing Shopify webhook', [
                'store_id' => $store->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => 'Internal server error',
            ], 500);
        }
    }

    /**
     * Verify Shopify HMAC signature.
     * 
     * @param string $data Raw request body
     * @param string $hmacHeader HMAC from header
     * @param string $webhookSecret Webhook secret
     * @return bool
     */
    private function verifyHmac(string $data, string $hmacHeader, string $webhookSecret): bool
    {
        $calculatedHmac = base64_encode(
            hash_hmac('sha256', $data, $webhookSecret, true)
        );

        // Use hash_equals to prevent timing attacks
        return hash_equals($hmacHeader, $calculatedHmac);
    }

    /**
     * Test endpoint to verify webhook configuration.
     * 
     * @param Request $request
     * @param string $store_token
     * @return JsonResponse
     */
    public function testWebhook(Request $request, string $store_token): JsonResponse
    {
        $store = Store::findByStoreToken($store_token);

        if (!$store) {
            return response()->json([
                'error' => 'Store not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'store' => [
                'id' => $store->id,
                'name' => $store->name,
                'shopify_connected' => $store->isShopifyConnected(),
                'webhook_configured' => !empty($store->webhook_secret_encrypted),
                'webhook_url' => $store->getWebhookUrl(),
            ],
        ]);
    }

    /**
     * List orders for a store (for debugging/testing).
     * 
     * @param Request $request
     * @param string $store_token
     * @return JsonResponse
     */
    public function listOrders(Request $request, string $store_token): JsonResponse
    {
        $store = Store::findByStoreToken($store_token);

        if (!$store) {
            return response()->json([
                'error' => 'Store not found',
            ], 404);
        }

        $orders = $store->shopifyOrders()
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();

        return response()->json([
            'success' => true,
            'store' => [
                'id' => $store->id,
                'name' => $store->name,
            ],
            'orders' => $orders,
            'total' => $orders->count(),
        ]);
    }
}

