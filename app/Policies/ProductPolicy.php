<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Determine if the user can view any products.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Merchant') || $user->hasRole('Administrator');
    }

    /**
     * Determine if the user can view a product.
     */
    public function view(User $user, Product $product): bool
    {
        return $user->id === ($product->merchant->user_id ?? null);
    }

    /**
     * Determine if the user can create a product.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Merchant') || $user->hasRole('Administrator');
    }

    /**
     * Determine if the user can update a product.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->id === ($product->merchant->user_id ?? null);
    }

    /**
     * Determine if the user can delete a product.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->id === ($product->merchant->user_id ?? null);
    }

    /**
     * Determine if the user can manage product stock.
     */
    public function manageStock(User $user, Product $product): bool
    {
        return $user->id === ($product->merchant->user_id ?? null);
    }
}
