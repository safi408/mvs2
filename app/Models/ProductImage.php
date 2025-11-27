<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductImage extends Model
{
    protected $fillable = [
        'vendor_product_id',
        'variant_id',
        'image_path',
        'is_default',
        'slug'
    ];

    public function product()
    {
        return $this->belongsTo(VendorProduct::class, 'vendor_product_id');
    }

        // Relationship: Image belongs to Variant
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }


    // ✅ Auto-generate slug before saving
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($image) {
            if (empty($image->slug)) {
                $fileName = basename($image->image_path); // extract image name
                $image->slug = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Str::random(6);
            }
        });
    }
}
