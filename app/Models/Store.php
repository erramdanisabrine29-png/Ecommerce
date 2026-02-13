<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Store extends Model
{
    protected $fillable = [
        'name',
        'url',
        'api_key',
        'ssl_certificate_status',
        'tax_rate',
        'minimum_stock',
        'user_id'
    ];

    protected $casts = [
        'tax_rate' => 'decimal:2',
        'minimum_stock' => 'integer',
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
}
