<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $primaryKey = 'id_merchant';

    public function user() {
        return $this->belongsTo(User::class,'id_user');
    }

    public function sites() {
        return $this->hasMany(Site::class,'id_merchant');
    }

    public function products() {
        return $this->hasMany(Product::class,'id_merchant');
    }
}

