<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_product';
    protected $table = 'products';

    protected $fillable = [
        'id_merchant',
        'reference',
        'variant_reference',
        'ean',
        'product_name',
        'description',
        'specifications',
        'price_excl_tax',
        'price_incl_tax',
        'unit',
        'tax',
        'available_stock',
        'safety_stock',
        'images',
        'documents',
        'sales_count',
        'views_count',
        'average_rating',
        'updated_at_product',
    ];

    protected $casts = [
        'price_excl_tax' => 'decimal:2',
        'price_incl_tax' => 'decimal:2',
        'tax' => 'decimal:2',
        'available_stock' => 'integer',
        'safety_stock' => 'integer',
        'sales_count' => 'integer',
        'views_count' => 'integer',
        'average_rating' => 'decimal:2',
        'specifications' => 'array',
        'images' => 'array',
        'documents' => 'array',
    ];

    /**
     * Get the merchant that owns this product.
     */
    public function merchant()
    {
        return $this->belongsTo(\App\Models\Merchant::class, 'id_merchant', 'id_merchant');
    }

    /**
     * Decrement available stock by quantity.
     */
    public function decrementStock(int $quantity): bool
    {
        if ($this->available_stock < $quantity) {
            return false;
        }

        $this->decrement('available_stock', $quantity);
        $this->increment('sales_count', $quantity);

        return true;
    }

    /**
     * Check if there is enough stock for the requested quantity.
     */
    public function isInStock(int $quantity): bool
    {
        return $this->available_stock >= $quantity;
    }

    /**
     * Validation rules for API / controller use.
     * If a product id is passed to $ignoreId the unique check for `reference` will ignore it.
     */
    public static function rules(?int $ignoreId = null): array
    {
        $uniqueRef = 'unique:products,reference';
        if ($ignoreId) {
            $uniqueRef .= ',' . $ignoreId . ',id_product';
        }

        return [
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'reference' => ['required', 'string', $uniqueRef],
            'price_excl_tax' => 'required|numeric|min:0',
            'price_incl_tax' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0|max:100',
            'unit' => 'required|string|max:50',
            'available_stock' => 'required|integer|min:0',
            'safety_stock' => 'nullable|integer|min:0',
            'specifications' => 'nullable|array',
            'images' => 'nullable|array',
        ];
    }

    /**
     * Increment stock by quantity.
     */
    public function incrementStock(int $quantity): void
    {
        $this->increment('available_stock', $quantity);
    }

    /**
     * Restore stock (for cancellations).
     */
    public function restoreStock(int $quantity): void
    {
        $this->incrementStock($quantity);
        $this->decrement('sales_count', $quantity);
    }

    /**
     * Check if stock is below safety threshold.
     */
    public function isLowStock(): bool
    {
        return $this->available_stock <= $this->safety_stock;
    }

    /**
     * Record a view/impression.
     */
    public function recordView(): void
    {
        $this->increment('views_count');
    }

    /**
     * Update sales statistics.
     */
    public function updateSalesStats(int $sold = null, int $views = null, float $rating = null): void
    {
        if ($sold !== null) {
            $this->sales_count = $sold;
        }
        if ($views !== null) {
            $this->views_count = $views;
        }
        if ($rating !== null) {
            $this->average_rating = $rating;
        }
        $this->save();
    }

    /**
     * Get conversion rate (sales / views).
     */
    public function getConversionRate(): float
    {
        if ($this->views_count === 0) {
            return 0;
        }

        return round(($this->sales_count / $this->views_count) * 100, 2);
    }

    /**
     * Return price including tax.
     */
    public function getPriceWithTax(): float
    {
        return (float) $this->price_incl_tax;
    }

    /**
     * Return tax amount (incl - excl).
     */
    public function getTaxAmount(): float
    {
        return round($this->price_incl_tax - $this->price_excl_tax, 2);
    }

    /**
     * Best-effort average sale price (falls back to current price)
     */
    public function getAverageSalePrice(): float
    {
        return $this->price_incl_tax ?? (float) $this->price_excl_tax;
    }
}

