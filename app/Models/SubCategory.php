<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    //
          protected $fillable = ['category_id', 'name', 'slug', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //     public function subcategory()
    // {
    //     return $this->belongsTo(SubCategory::class);
    // }
    
    // One SubCategory has many Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
