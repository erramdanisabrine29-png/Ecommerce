<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = 'id_site';
    protected $fillable = [
        'id_merchant', 'site_name', 'site_url', 'description', 'site_type',
        'vat_rate', 'minimum_stock'
    ];

    // sensible defaults for tests / quick model creation (only DB columns)
    protected $attributes = [
        'site_name' => 'Test Site',
        'site_url' => 'http://example.test',
    ];

    public function merchant() {
        return $this->belongsTo(Merchant::class,'id_merchant');
    }

    public function orders() {
        return $this->hasMany(Order::class,'id_site');
    }
}
