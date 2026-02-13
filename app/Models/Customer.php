<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id_customer';
    protected $fillable = [
        'user_id',
        'first_name_customer',
        'last_name_customer',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'postal_code',
    ];

    public function user() {
        return $this->belongsTo(User::class,'id_user');
    }

    public function orders() {
        return $this->hasMany(Order::class,'id_customer');
    }
}

