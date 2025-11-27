<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
        protected $fillable = [
        'user_id',
        'store_name',
        'store_slug',
        'store_logo',
        'store_description',
        'phone',
        'address',
        'city',
        'country',
        'status',
        'is_verified',
        'commission_rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
