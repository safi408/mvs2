<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductVariant extends Model
{
    protected $fillable = [
        'vendor_product_id',
        'color',
        'color_name',
        'color_slug',
        'size',  
        'price',
        'stock'
    ];

    /**
     * Automatically cast JSON column 'sizes' to array
     */
    protected $casts = [
        'size' => 'array',  // ✅ Laravel will handle JSON <-> array conversion
    ];

    /**
     * Boot method for auto slug generation
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($variant) {
            // ✅ Generate color slug automatically
            if ($variant->color_name || $variant->color) {
                $variant->color_slug = Str::slug($variant->color_name ?? $variant->color);
            }

            // ✅ If sizes array exists, create a combined slug string for reference
            if (!empty($variant->sizes) && is_array($variant->sizes)) {
                $variant->size_slug = Str::slug(implode('-', $variant->sizes));
            }
        });
    }

    /**
     * Relationship with product
     */
    public function product()
    {
        return $this->belongsTo(VendorProduct::class, 'vendor_product_id');
    }

    /**
     * Relationship with variant images
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'variant_id');
    }
}
