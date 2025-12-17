<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id_order';

    public function lines() {
        return $this->hasMany(OrderLine::class,'id_order');
    }

    public function payments() {
        return $this->hasMany(Payment::class,'id_order');
    }
}

