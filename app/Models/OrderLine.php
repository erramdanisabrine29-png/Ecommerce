<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $primaryKey = 'id_line';
    protected $fillable = [
        'id_order',
        'id_product',
        'quantity',
        'unit_price',
        'total_price',
        'discount',
        'line_status',
        'order_product_reference',
        'order_product_name',
        'order_product_specs',
    ];

    public function order() {
        return $this->belongsTo(Order::class,'id_order');
    }

    public function product() {
        return $this->belongsTo(Product::class,'id_product');
    }
}
