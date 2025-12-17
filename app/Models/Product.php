<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id_product';

    protected $casts = ['specifications'=>'array','images'=>'array'];

    public function merchant() {
        return $this->belongsTo(Merchant::class,'id_merchant');
    }
}

