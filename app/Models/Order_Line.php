<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $primaryKey = 'id_line';

    public function order() {
        return $this->belongsTo(Order::class,'id_order');
    }

    public function product() {
        return $this->belongsTo(Product::class,'id_product');
    }
}

