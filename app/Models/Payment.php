<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
        // ✅ Fillable fields for mass assignment
    protected $fillable = [
        'order_id',
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_response',
        'amount',
        'card_number', 
        'card_name',   
        'card_date',
        'cvv'   
    ];

    // ✅ Casts
    protected $casts = [
        'payment_response' => 'array', // JSON -> array
        'card_date' => 'date',         // YYYY-MM-DD format
    ];

    // 🔹 Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
