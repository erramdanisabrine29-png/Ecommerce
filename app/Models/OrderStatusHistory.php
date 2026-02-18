<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    protected $table = 'order_status_histories';

    protected $fillable = [
        'id_order',
        'old_status',
        'new_status',
        'changed_by',
        'note',
    ];

    /**
     * Log a status change for an order.
     */
    public static function logStatusChange($orderId, $oldStatus, $newStatus, $userId, $note = null)
    {
        return self::create([
            'id_order' => $orderId,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => $userId,
            'note' => $note,
        ]);
    }

    /**
     * Relation to Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    /**
     * Relation to User who changed the status
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
