<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $primaryKey = 'id_merchant';
    protected $table = 'merchants';
    
    protected $fillable = [
        'user_id',
        'company_name',
        'siret',
        'iban',
        'phone',
        'address',
        'city',
        'country',
        'postal_code',
        'currency',
        'balance',
        'registration_date',
        'sale_rate',
        'average_rating',
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function sites() {
        return $this->hasMany(Site::class,'id_merchant');
    }

    public function products() {
        return $this->hasMany(Product::class,'id_merchant');
    }
}

