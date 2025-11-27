<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    //
        protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'description',
    ];

    // 🔹 Relation: belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 🔹 Relation: belongs to SubCategory
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // 🔹 Optional: A Child Category can have many Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
