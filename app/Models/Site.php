<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = 'id_site';

    public function merchant() {
        return $this->belongsTo(Merchant::class,'id_merchant');
    }

    public function orders() {
        return $this->hasMany(Order::class,'id_site');
    }
}
