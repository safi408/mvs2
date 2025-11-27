<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    //
    
    protected $fillable = [
        'vendor_id', 'category_id', 'subcategory_id', 'brand_id',
        'name', 'slug', 'description', 'price', 'stock', 'sku', 'status','childcategory_id'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'vendor_product_id');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'vendor_product_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'vendor_product_id');
    }
    public function category()
{
    return $this->belongsTo(\App\Models\Category::class, 'category_id');
}

public function subcategory()
{
    return $this->belongsTo(\App\Models\SubCategory::class, 'subcategory_id');
}

    public function childcategory()
    {
        return $this->belongsTo(\App\Models\ChildCategory::class);
    }

   public function brand()
{
    return $this->belongsTo(ProductBrand::class, 'brand_id');
}


}
