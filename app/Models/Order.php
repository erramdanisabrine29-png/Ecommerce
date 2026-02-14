<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_site',
        'id_customer',
        'reference',
        'channel',
        'created_at_order',
        'paid_at',
        'delivery_date',
        'cancellation_date',
        'order_status',
        'total_amount',
        'shipping_amount',
        'discount',
        'shipping_address',
        'billing_address',
        'customer_notes',
        'internal_notes',
    ];

    /**
     * Recalculate totals from order lines and delivery cost.
     */
    public function recalcTotals(): void
    {
        $linesTotal = $this->lines()->sum('total_price');
        $shipping = $this->shipping_amount ?? 0;
        $discount = $this->discount ?? 0;
        $this->total_amount = round($linesTotal + $shipping - $discount, 2);
        $this->save();
    }

    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class, 'id_order');
    }

    public function lines() {
        return $this->hasMany(OrderLine::class,'id_order');
    }

    public function payments() {
        return $this->hasMany(Payment::class,'id_order');
    }

    /**
     * Return the number of merchant-visible orders for the given user id.
     * By default this counts only `pending` orders (badge semantics).
     * If the user is not a merchant, returns 0.
     *
     * @param  int|null  $userId
     * @param  array|null $statuses  list of order_status values to count (defaults to ['pending'])
     */
    public static function countForMerchant(?int $userId, ?array $statuses = null): int
    {
        if (! $userId) {
            return 0;
        }

        $merchant = \App\Models\Merchant::where('user_id', $userId)->first();
        if (! $merchant) {
            return 0;
        }

        $siteIds = \App\Models\Site::where('id_merchant', $merchant->id_merchant)->pluck('id_site');
        if ($siteIds->isEmpty()) {
            return 0;
        }

        $statuses = $statuses ?? ['pending'];

        return (int) self::whereIn('id_site', $siteIds)
            ->whereIn('order_status', $statuses)
            ->count();
    }
}

