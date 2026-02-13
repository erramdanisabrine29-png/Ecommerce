<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Site;
use App\Models\User;

class OrderPolicy
{
    /**
     * Merchant can view orders for their own sites. Admins can view all.
     * Clients (regular users) can view orders that belong to their customer record.
     */
    public function view(User $user, Order $order): bool
    {
        if ($user->hasRole('Administrator')) {
            return true;
        }

        // Merchant: only for orders that belong to one of their sites
        if ($user->hasRole('Merchant')) {
            return optional($order->site->merchant)->user_id === $user->id;
        }

        // Client / regular user: only allow viewing if they own the customer record
        return optional($order->customer)->user_id === $user->id;
    }

    /**
     * Determine whether the user can create orders for a given site.
     * Merchants may only create orders for their own sites; admins can create for any site.
     */
    public function create(User $user, Site $site): bool
    {
        if ($user->hasRole('Administrator')) {
            return true;
        }

        if ($user->hasRole('Merchant')) {
            return optional($site->merchant)->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the order.
     * Orders with final statuses cannot be updated.
     */
    public function update(User $user, Order $order): bool
    {
        // Disallow updates for final statuses
        if (in_array($order->order_status, ['delivered', 'cancelled', 'returned'], true)) {
            return false;
        }

        if ($user->hasRole('Administrator')) {
            return true;
        }

        if ($user->hasRole('Merchant')) {
            return optional($order->site->merchant)->user_id === $user->id;
        }

        // Clients are not allowed to update orders (only view their own)
        return false;
    }

    /**
     * Determine whether the user can delete the order.
     */
    public function delete(User $user, Order $order): bool
    {
        if ($user->hasRole('Administrator')) {
            return true;
        }

        if ($user->hasRole('Merchant')) {
            return optional($order->site->merchant)->user_id === $user->id;
        }

        return false;
    }
}
