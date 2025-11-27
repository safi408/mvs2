<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    //
        protected $fillable = ['vendor_product_id', 'size'];

    public function product()
    {
        return $this->belongsTo(VendorProduct::class, 'vendor_product_id');
    }
}
