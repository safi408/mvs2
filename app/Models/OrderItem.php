<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
        protected $fillable = [
        'order_id',
        'vendor_product_id',
        'product_variant_id',
        'image',
        'name',
        'product_slug',
        'color',
        'size',
        'price',
        'quantity',
        'total',
    ];

    protected $casts = [
        'size' => 'array', // JSON → array
    ];

    // Relationships

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\VendorProduct::class, 'vendor_product_id');
    }

    public function variant()
    {
        return $this->belongsTo(\App\Models\ProductVariant::class, 'product_variant_id');
    }
}
