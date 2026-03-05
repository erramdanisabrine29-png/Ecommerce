<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ShopifyOrder Model
 * 
 * Represents an order received from Shopify via webhook.
 * 
 * @property int $id
 * @property int $store_id
 * @property string $shopify_order_id
 * @property string|null $order_number
 * @property string|null $customer_email
 * @property string|null $customer_name
 * @property string|null $customer_phone
 * @property float $total_price
 * @property string $currency
 * @property string|null $financial_status
 * @property string|null $fulfillment_status
 * @property string $order_status
 * @property array|null $order_data
 * @property string|null $shipping_address
 * @property string|null $billing_address
 * @property string|null $shopify_created_at
 * @property string|null $shopify_updated_at
 * @property string|null $checkout_id
 * @property string|null $checkout_token
 * @property int $line_items_count
 * @property bool $processed
 * @property \Carbon\Carbon|null $processed_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ShopifyOrder extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'shopify_orders';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'store_id',
        'shopify_order_id',
        'order_number',
        'customer_email',
        'customer_name',
        'customer_phone',
        'total_price',
        'currency',
        'financial_status',
        'fulfillment_status',
        'order_status',
        'order_data',
        'shipping_address',
        'billing_address',
        'shopify_created_at',
        'shopify_updated_at',
        'checkout_id',
        'checkout_token',
        'line_items_count',
        'processed',
        'processed_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'total_price' => 'decimal:2',
        'order_data' => 'array',
        'processed' => 'boolean',
        'processed_at' => 'datetime',
        'shopify_created_at' => 'datetime',
        'shopify_updated_at' => 'datetime',
    ];

    /**
     * Status constants
     */
    public const STATUS_NEW = 'new';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_PROCESSED = 'processed';
    public const STATUS_FAILED = 'failed';
    public const STATUS_DUPLICATE = 'duplicate';

    /**
     * Financial status constants
     */
    public const FINANCIAL_PENDING = 'pending';
    public const FINANCIAL_PAID = 'paid';
    public const FINANCIAL_REFUNDED = 'refunded';
    public const FINANCIAL_VOIDED = 'voided';
    public const FINANCIAL_PARTIALLY_PAID = 'partially_paid';

    /**
     * Fulfillment status constants
     */
    public const FULFILLMENT_UNFULFILLED = 'unfulfilled';
    public const FULFILLMENT_PARTIAL = 'partial';
    public const FULFILLMENT_FULFILLED = 'fulfilled';

    /**
     * Get the store that owns this order.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Check if this order is a duplicate.
     */
    public function isDuplicate(): bool
    {
        return $this->order_status === self::STATUS_DUPLICATE;
    }

    /**
     * Check if this order has been processed successfully.
     */
    public function isProcessed(): bool
    {
        return $this->processed && $this->order_status === self::STATUS_PROCESSED;
    }

    /**
     * Mark this order as processed.
     */
    public function markAsProcessed(): void
    {
        $this->update([
            'processed' => true,
            'processed_at' => now(),
            'order_status' => self::STATUS_PROCESSED,
        ]);
    }

    /**
     * Mark this order as a duplicate.
     */
    public function markAsDuplicate(): void
    {
        $this->update([
            'order_status' => self::STATUS_DUPLICATE,
        ]);
    }

    /**
     * Mark this order as failed.
     */
    public function markAsFailed(string $reason = ''): void
    {
        $this->update([
            'order_status' => self::STATUS_FAILED,
        ]);

        // Log the failure reason in the order_data
        $data = $this->order_data ?? [];
        $data['failure_reason'] = $reason;
        $this->update(['order_data' => $data]);
    }

    /**
     * Get formatted total price with currency.
     */
    public function getFormattedTotalPriceAttribute(): string
    {
        return number_format($this->total_price, 2) . ' ' . $this->currency;
    }

    /**
     * Scope a query to only include unprocessed orders.
     */
    public function scopeUnprocessed($query)
    {
        return $query->where('processed', false);
    }

    /**
     * Scope a query to only include duplicate orders.
     */
    public function scopeDuplicates($query)
    {
        return $query->where('order_status', self::STATUS_DUPLICATE);
    }

    /**
     * Scope a query to filter by store.
     */
    public function scopeForStore($query, int $storeId)
    {
        return $query->where('store_id', $storeId);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeDateRange($query, ?string $startDate = null, ?string $endDate = null)
    {
        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }
        return $query;
    }

    /**
     * Find order by Shopify order ID and store.
     */
    public static function findByShopifyId(string $shopifyOrderId, int $storeId): ?self
    {
        return static::where('shopify_order_id', $shopifyOrderId)
            ->where('store_id', $storeId)
            ->first();
    }

    /**
     * Check if order exists for a store.
     */
    public static function existsForStore(string $shopifyOrderId, int $storeId): bool
    {
        return static::where('shopify_order_id', $shopifyOrderId)
            ->where('store_id', $storeId)
            ->exists();
    }

    /**
     * Create a new order from Shopify webhook payload.
     */
    public static function createFromPayload(array $payload, int $storeId): self
    {
        // Extract customer information
        $customerEmail = $payload['email'] ?? null;
        $customerName = null;
        $customerPhone = null;

        if (isset($payload['customer'])) {
            $customerName = trim(
                ($payload['customer']['first_name'] ?? '') . ' ' . 
                ($payload['customer']['last_name'] ?? '')
            );
            $customerPhone = $payload['customer']['phone'] ?? null;
        }

        // Extract addresses
        $shippingAddress = $payload['shipping_address'] ?? null;
        $billingAddress = $payload['billing_address'] ?? null;

        // Format addresses as JSON strings
        $shippingAddressJson = $shippingAddress ? json_encode($shippingAddress) : null;
        $billingAddressJson = $billingAddress ? json_encode($billingAddress) : null;

        // Count line items
        $lineItemsCount = count($payload['line_items'] ?? []);

        return static::create([
            'store_id' => $storeId,
            'shopify_order_id' => (string) $payload['id'],
            'order_number' => $payload['order_number'] ?? $payload['name'] ?? null,
            'customer_email' => $customerEmail,
            'customer_name' => $customerName ?: null,
            'customer_phone' => $customerPhone,
            'total_price' => (float) ($payload['total_price'] ?? 0),
            'currency' => $payload['currency'] ?? 'USD',
            'financial_status' => $payload['financial_status'] ?? self::FINANCIAL_PENDING,
            'fulfillment_status' => $payload['fulfillment_status'] ?? self::FULFILLMENT_UNFULFILLED,
            'order_status' => self::STATUS_NEW,
            'order_data' => $payload,
            'shipping_address' => $shippingAddressJson,
            'billing_address' => $billingAddressJson,
            'shopify_created_at' => $payload['created_at'] ?? null,
            'shopify_updated_at' => $payload['updated_at'] ?? null,
            'checkout_id' => $payload['checkout_id'] ?? null,
            'checkout_token' => $payload['checkout_token'] ?? null,
            'line_items_count' => $lineItemsCount,
            'processed' => false,
        ]);
    }

    /**
     * Update order from Shopify webhook payload.
     */
    public function updateFromPayload(array $payload): self
    {
        $this->update([
            'order_number' => $payload['order_number'] ?? $payload['name'] ?? $this->order_number,
            'customer_email' => $payload['email'] ?? $this->customer_email,
            'total_price' => (float) ($payload['total_price'] ?? $this->total_price),
            'currency' => $payload['currency'] ?? $this->currency,
            'financial_status' => $payload['financial_status'] ?? $this->financial_status,
            'fulfillment_status' => $payload['fulfillment_status'] ?? $this->fulfillment_status,
            'order_data' => $payload,
            'shopify_updated_at' => $payload['updated_at'] ?? $this->shopify_updated_at,
        ]);

        return $this;
    }
}

