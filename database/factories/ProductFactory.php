<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' ' . $this->faker->word(),
            'description' => $this->faker->sentence(10),
            'price_ht' => $this->faker->randomFloat(2, 10, 500),
            'tax_rate' => $this->faker->randomElement([5.5, 10, 19.6, 20]),
            'stock' => $this->faker->numberBetween(0, 100),
            'security_threshold' => $this->faker->numberBetween(5, 20),
            'characteristics' => [
                'color' => $this->faker->colorName(),
                'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
                'material' => $this->faker->word(),
            ],
            'images' => [
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
            ],
            'sales_statistics' => [
                'total_sold' => $this->faker->numberBetween(0, 1000),
                'total_revenue' => $this->faker->randomFloat(2, 0, 50000),
                'total_views' => $this->faker->numberBetween(0, 10000),
                'sales_count' => $this->faker->numberBetween(0, 500),
            ],
            'store_id' => Store::factory(),
        ];
    }

    /**
     * Indicate that the product has low stock.
     */
    public function lowStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => $this->faker->numberBetween(0, 5),
            'security_threshold' => 10,
        ]);
    }

    /**
     * Indicate that the product is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }

    /**
     * Indicate that the product has high sales.
     */
    public function highSales(): static
    {
        return $this->state(fn (array $attributes) => [
            'sales_statistics' => [
                'total_sold' => $this->faker->numberBetween(500, 5000),
                'total_revenue' => $this->faker->randomFloat(2, 50000, 500000),
                'total_views' => $this->faker->numberBetween(5000, 100000),
                'sales_count' => $this->faker->numberBetween(100, 1000),
            ],
        ]);
    }

    /**
     * Assign to a specific store.
     */
    public function forStore(Store $store): static
    {
        return $this->state(fn (array $attributes) => [
            'store_id' => $store->id,
        ]);
    }
}
