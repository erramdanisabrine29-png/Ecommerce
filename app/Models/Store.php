<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'api_key',
        'ssl_certificate_status',
        'tax_rate',
        'minimum_stock',
        'user_id',
        'webhook_secret',
        'webhook_secret_encrypted',
        'webhook_token',
        'shopify_domain',
        'shopify_token',
        'shopify_connected_at',
        'store_token',
    ];

    protected $casts = [
        'tax_rate' => 'decimal:2',
        'minimum_stock' => 'integer',
        'shopify_connected_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate API key on creation if not provided
        static::creating(function ($model) {
            if (empty($model->api_key)) {
                $model->api_key = self::generateUniqueApiKey();
            }
            
            // Auto-generate store_token for webhook URL
            if (empty($model->store_token)) {
                $model->store_token = self::generateUniqueStoreToken();
            }
        });
    }

    /**
     * Generate a unique API key.
     */
    public static function generateUniqueApiKey(): string
    {
        do {
            $key = 'sk_' . Str::random(32);
        } while (self::where('api_key', $key)->exists());

        return $key;
    }

    /**
     * Generate a unique store token for webhook URL.
     */
    public static function generateUniqueStoreToken(): string
    {
        do {
            $token = Str::random(32);
        } while (self::where('store_token', $token)->exists());

        return $token;
    }

    /**
     * Get the user that owns this store.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all products for this store.
     */
    public function products()
    {
        // Products are stored against a Merchant (id_merchant).
        // A Store belongs to a User (user_id) and the Merchant is linked to the same user_id.
        // Use hasManyThrough so calling $store->products() returns products for the store owner's merchant.
        return $this->hasManyThrough(
            \App\Models\Product::class,
            \App\Models\Merchant::class,
            'user_id',      // Foreign key on merchants table linking to users (merchant.user_id)
            'id_merchant',  // Foreign key on products table linking to merchants (product.id_merchant)
            'user_id',      // Local key on stores table (store.user_id)
            'id_merchant'   // Local key on merchants table (merchant.id_merchant)
        );
    }

    /**
     * Get all orders for this store.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all Shopify orders for this store.
     */
    public function shopifyOrders()
    {
        return $this->hasMany(ShopifyOrder::class);
    }

    /**
     * Check if SSL certificate is active.
     */
    public function hasActiveSSL(): bool
    {
        return $this->ssl_certificate_status === 'active';
    }

    /**
     * Check if store inventory is low.
     */
    public function hasLowInventory(): bool
    {
        // products use `available_stock` column in the current schema
        return $this->products()->sum('available_stock') <= $this->minimum_stock;
    }

    /**
     * Get tax amount for a given price.
     */
    public function calculateTax(float $price): float
    {
        return round($price * ($this->tax_rate / 100), 2);
    }

    /**
     * Get price with tax included.
     */
    public function getPriceWithTax(float $price): float
    {
        return round($price + $this->calculateTax($price), 2);
    }

    // ============================================================
    // Shopify Integration Methods
    // ============================================================

    /**
     * Check if store is connected to Shopify.
     */
    public function isShopifyConnected(): bool
    {
        return !empty($this->shopify_domain) && !empty($this->shopify_token);
    }

    /**
     * Get the decrypted Shopify access token.
     */
    public function getShopifyToken(): ?string
    {
        if (empty($this->shopify_token)) {
            return null;
        }

        try {
            return Crypt::decryptString($this->shopify_token);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get the decrypted webhook secret.
     */
    public function getWebhookSecret(): ?string
    {
        if (empty($this->webhook_secret_encrypted)) {
            return null;
        }

        try {
            return Crypt::decryptString($this->webhook_secret_encrypted);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get the webhook URL for this store.
     */
    public function getWebhookUrl(): ?string
    {
        if (empty($this->store_token)) {
            return null;
        }

        return route('shopify.webhook.order.creation', ['store_token' => $this->store_token]);
    }

    /**
     * Regenerate the store token.
     */
    public function regenerateStoreToken(): string
    {
        $this->update([
            'store_token' => self::generateUniqueStoreToken(),
        ]);

        return $this->store_token;
    }

    /**
     * Find store by store token.
     */
    public static function findByStoreToken(string $token): ?self
    {
        return self::where('store_token', $token)->first();
    }

    /**
     * Connect store to Shopify.
     */
    public function connectToShopify(string $domain, string $token): void
    {
        $this->update([
            'shopify_domain' => $domain,
            'shopify_token' => Crypt::encryptString($token),
            'shopify_connected_at' => now(),
        ]);
    }

    /**
     * Disconnect store from Shopify.
     */
    public function disconnectFromShopify(): void
    {
        $this->update([
            'shopify_domain' => null,
            'shopify_token' => null,
            'shopify_connected_at' => null,
            'webhook_secret' => null,
            'webhook_secret_encrypted' => null,
        ]);
    }

    /**
     * Set webhook secret (encrypts and stores).
     */
    public function setWebhookSecret(string $secret): void
    {
        $this->update([
            'webhook_secret' => null, // Don't store plain text
            'webhook_secret_encrypted' => Crypt::encryptString($secret),
        ]);
    }
}
