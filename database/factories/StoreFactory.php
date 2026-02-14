<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'url' => $this->faker->url(),
            'api_key' => 'sk_' . Str::random(32),
            'ssl_certificate_status' => $this->faker->randomElement(['active', 'inactive', 'expired', 'pending']),
            'tax_rate' => $this->faker->randomFloat(2, 5, 25), // Between 5% and 25%
            'minimum_stock' => $this->faker->numberBetween(5, 50),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the store has an active SSL certificate.
     */
    public function withActiveSSL(): static
    {
        return $this->state(fn (array $attributes) => [
            'ssl_certificate_status' => 'active',
        ]);
    }

    /**
     * Indicate that the store has an expired SSL certificate.
     */
    public function withExpiredSSL(): static
    {
        return $this->state(fn (array $attributes) => [
            'ssl_certificate_status' => 'expired',
        ]);
    }

    /**
     * Set a specific user for the store.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
