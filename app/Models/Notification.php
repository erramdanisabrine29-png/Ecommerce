<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'id_notification';

    protected $casts = [
        'recipients'=>'array',
        'is_read'=>'boolean'
    ];

    public function user() {
        return $this->belongsTo(User::class,'id_user');
    }
}
