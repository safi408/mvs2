<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'payment_method',
        'payment_status',
        'order_status',
        'stripe_payment_id',
        'stripe_client_secret',
        'stripe_payment_response',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'street',
        'postal_code',
        'note',
        'subtotal',
        'discount',
        'shipping',
        'total',
        'order_item_id', // ✅ JSON column
    ];
  
      protected $casts = [
        'order_item_id' => 'array', // JSON → array
    ];

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function payment()
{
    return $this->hasOne(Payment::class);
}

}

