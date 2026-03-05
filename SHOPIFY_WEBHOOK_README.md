# Shopify Webhook System Implementation Guide

## Overview

This implementation provides a complete Shopify Webhook system for Laravel 10+ that automatically connects stores and receives orders from Shopify.

## Features

✅ **Store Token Generation** - Automatically generates unique tokens for webhook URLs  
✅ **HMAC Verification** - Secure webhook signature verification  
✅ **Order Storage** - Stores Shopify orders in dedicated table  
✅ **Duplicate Prevention** - Prevents duplicate order processing  
✅ **Blade Form** - Ready-to-use admin interface  

---

## Installation

### 1. Run Migrations

```bash
php artisan migrate
```

This will create:
- New columns in `stores` table: `shopify_domain`, `shopify_token`, `shopify_connected_at`, `store_token`
- New table `shopify_orders` for storing orders

### 2. Configuration

Add your Shopify credentials in `.env`:

```env
SHOPIFY_KEY=your_shopify_api_key
SHOPIFY_SECRET=your_shopify_api_secret
```

---

## Database Structure

### Stores Table

| Field | Type | Description |
|-------|------|-------------|
| `store_token` | string(32) | Unique token for webhook URL (auto-generated) |
| `shopify_domain` | string | Shopify store domain |
| `shopify_token` | text | Encrypted Shopify access token |
| `shopify_connected_at` | timestamp | Connection timestamp |
| `webhook_secret_encrypted` | text | Encrypted webhook secret |

### Shopify Orders Table

| Field | Type | Description |
|-------|------|-------------|
| `id` | bigint | Primary key |
| `store_id` | bigint | Foreign key to stores |
| `shopify_order_id` | string | Shopify's order ID (unique) |
| `order_number` | string | Human-readable order number |
| `customer_email` | string | Customer email |
| `total_price` | decimal | Order total |
| `currency` | string | Currency code |
| `order_data` | json | Full Shopify payload |
| `order_status` | string | Processing status |
| `processed` | boolean | Processing flag |
| `created_at` | timestamp | Creation time |

---

## Webhook URL Format

```
https://yourdomain.com/webhook/shopify/order/{store_token}/creation
```

Example:
```
https://mydomain.com/webhook/shopify/order/abc123def456789xyz.../creation
```

---

## API Endpoints

### Webhook Endpoint (POST)
```
POST /webhook/shopify/order/{store_token}/creation
```

### Test Endpoint (GET)
```
GET /webhook/shopify/test/{store_token}
```

### List Orders (GET)
```
GET /webhook/shopify/orders/{store_token}
```

---

## Usage Guide

### 1. Create a Store

When creating a store via the admin panel, `store_token` is automatically generated.

### 2. Configure Webhook

1. Go to Store Settings → Shopify
2. The Webhook URL is automatically generated and shown
3. Copy the URL and add it in Shopify Admin → Settings → Notifications → Webhooks
4. Enter the Webhook Secret provided by Shopify
5. Click "Save"

### 3. Receive Orders

When Shopify creates an order:
1. Webhook is sent to your endpoint
2. HMAC is verified
3. Order is stored in `shopify_orders` table
4. Duplicate orders are detected and updated

---

## Security

### HMAC Verification

The system verifies the `X-Shopify-Hmac-Sha256` header:

```php
$calculatedHmac = base64_encode(
    hash_hmac('sha256', $data, $webhookSecret, true)
);

if (!hash_equals($hmacHeader, $calculatedHmac)) {
    return response()->json(['error' => 'Invalid signature'], 401);
}
```

### Best Practices Implemented

- ✅ HMAC verification using `hash_equals()` (timing-safe)
- ✅ Encrypted storage of secrets
- ✅ No plain-text secret storage
- ✅ Duplicate order prevention
- ✅ Request logging
- ✅ Error handling

---

## Example Shopify Order Payload

```json
{
  "id": 123456789,
  "order_number": 1001,
  "email": "customer@example.com",
  "total_price": "99.99",
  "currency": "USD",
  "financial_status": "paid",
  "fulfillment_status": "unfulfilled",
  "customer": {
    "first_name": "John",
    "last_name": "Doe",
    "email": "customer@example.com",
    "phone": "+1234567890"
  },
  "line_items": [
    {
      "id": 1,
      "title": "Product Name",
      "quantity": 2,
      "price": "49.99"
    }
  ],
  "shipping_address": {
    "first_name": "John",
    "last_name": "Doe",
    "address1": "123 Main St",
    "city": "New York",
    "country": "US"
  }
}
```

---

## Files Created/Modified

### New Files
- `app/Models/ShopifyOrder.php` - Order model
- `app/Http/Controllers/ShopifyWebhookController.php` - Webhook controller
- `database/migrations/2026_02_25_000000_add_shopify_connection_fields_to_stores_table.php`
- `database/migrations/2026_02_25_100000_create_shopify_orders_table.php`

### Modified Files
- `app/Models/Store.php` - Added helper methods
- `app/Http/Controllers/StoreController.php` - Updated webhook handling
- `app/Http/Controllers/ShopifyController.php` - Updated webhook registration
- `resources/views/stores/shopify.blade.php` - Updated to show token-based URL
- `routes/web.php` - Added new routes

---

## Troubleshooting

### Webhook not working?

1. Check if `store_token` is generated
2. Verify webhook secret is set in database
3. Check Laravel logs in `storage/logs/`
4. Ensure HTTPS is enabled

### HMAC verification failed?

1. Verify webhook secret matches Shopify dashboard
2. Check if secret is properly encrypted
3. Check raw request body encoding

### Duplicate orders?

The system automatically detects duplicates using `shopify_order_id` + `store_id` and updates existing records instead of creating duplicates.

---

## Testing

You can test the webhook using curl:

```bash
# Generate test HMAC
DATA='{"id":123,"total_price":"99.99"}'
SECRET='your_webhook_secret'
HMAC=$(echo -n "$DATA" | openssl dgst -sha256 -hmac "$SECRET" | cut -d' ' -f2)
HMAC_BASE64=$(echo -n "$DATA" | openssl dgst -sha256 -hmac "$SECRET" -binary | base64)

# Send test request
curl -X POST https://yourdomain.com/webhook/shopify/order/YOUR_STORE_TOKEN/creation \
  -H "Content-Type: application/json" \
  -H "X-Shopify-Hmac-Sha256: $HMAC_BASE64" \
  -H "X-Shopify-Shop-Domain: your-store.myshopify.com" \
  -d "$DATA"
```

---

## Support

For issues or questions, check:
- Laravel logs: `storage/logs/laravel.log`
- Shopify webhook logs in Shopify Admin

