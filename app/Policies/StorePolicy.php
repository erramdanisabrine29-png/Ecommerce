<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StorePolicy
{
    /**
     * Determine whether the user can view any stores.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Merchant') || $user->hasRole('Administrator');
    }

    /**
     * Determine whether the user can view a specific store.
     */
    public function view(User $user, Store $store): bool
    {
        return $user->id === $store->user_id;
    }

    /**
     * Determine if the user owns the store.
     */
    public function own(User $user, Store $store): bool
    {
        return $user->id === $store->user_id;
    }

    /**
     * Determine whether the user can create stores.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Merchant') || $user->hasRole('Administrator');
    }

    /**
     * Determine whether the user can update the store.
     */
    public function update(User $user, Store $store): bool
    {
        return $user->id === $store->user_id;
    }

    /**
     * Determine whether the user can delete the store.
     */
    public function delete(User $user, Store $store): bool
    {
        return $user->id === $store->user_id;
    }

    /**
     * Determine whether the user can restore the store.
     */
    public function restore(User $user, Store $store): bool
    {
        return $user->id === $store->user_id;
    }

    /**
     * Determine whether the user can permanently delete the store.
     */
    public function forceDelete(User $user, Store $store): bool
    {
        return $user->id === $store->user_id;
    }
}
