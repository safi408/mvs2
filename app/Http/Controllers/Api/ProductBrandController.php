<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductBrand;
use App\Models\VendorProduct;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Vendor;
use App\Models\User;

class ProductBrandController extends Controller
{
    //
    public function ProductBrand(){
        $brands = ProductBrand::latest()->get();
        if($brands){
           return response()->json($brands);
        }        
    }

    public function BrandsProducts($id)
{
    // Category with product count
    $brand = ProductBrand::withCount('products')->find($id);

    if (!$brand) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    // Get approved products of that category (same structure as index)
    $products = VendorProduct::with(['images','variants', 'category', 'subcategory', 'childcategory',])
        ->where('brand_id', $id)
        ->where('status', 'approved')
        ->latest()
        ->get();

    // Clean descriptions
    foreach ($products as $product) {
        $product->description = strip_tags($product->description);
    }

    // Return final JSON
    return response()->json([
              'brand' => $brand->name,               // ✅ correct variable
        'count_product' => $brand->products_count,
        'products' => $products,

    ]);
}
}
