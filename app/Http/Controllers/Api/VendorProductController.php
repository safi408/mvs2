<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorProduct;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Vendor;
use App\Models\User;

class VendorProductController extends Controller
{
    //
    // public function index(){
       
    // $products = VendorProduct::with(['images', 'sizes', 'variants', 'category', 'subcategory'])
    //     ->whereNull('vendor_id')
    //     ->OrWhereNotNull('vendor_id')
    //      ->where('status', 'approved')
    //      ->withCount('variants')
    //     ->latest()
    //     ->get();
    //  return response()->json($products);   
    // }


public function categoryProducts($id)
{
    // Category with product count
    $category = Category::withCount('products')->find($id);

    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    // Get approved products of that category (same structure as index)
    $products = VendorProduct::with(['images','variants', 'category', 'subcategory', 'childcategory'])
        ->where('category_id', $id)
        ->where('status', 'approved')
        ->latest()
        ->get();

    // Clean descriptions
    foreach ($products as $product) {
        $product->description = strip_tags($product->description);
    }

    // Return final JSON
    return response()->json([
        'category' => $category->name,
        'count_product' => $category->products_count,
        'products' => $products,
    ]);
}





//     public function index() {
//     $products = VendorProduct::with(['images','variants.images', 'category', 'subcategory','childcategory','brand'])
//         ->whereNull('vendor_id')
//         ->orWhereNotNull('vendor_id')
//         ->where('status', 'approved')
//         ->withCount('variants')
//         ->latest()
//         ->get();

//     // Strip HTML tags from description for all products
//     foreach ($products as $product) {
//         $product->description = strip_tags($product->description);
//     }

//     return response()->json($products);
// }

public function index() {
    $products = VendorProduct::with([
            // 'sizes',
            'images',
            'variants.images',
            'category',
            'subcategory',
            'childcategory',
            'brand'
        ])
        ->where('status', 'approved')
        ->withCount('variants')
        ->latest()
        ->get();

    foreach ($products as $product) {
        $product->description = strip_tags($product->description);

        // Optional: strip tags for variant names/descriptions if needed
        foreach ($product->variants as $variant) {
            if(isset($variant->description)){
                $variant->description = strip_tags($variant->description);
            }
        }
    }

    return response()->json($products);
}







public function single($id)
{
    $product = VendorProduct::with(['images', 'variants','variants.images', 'category', 'subcategory','brand'])->find($id);
      

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // 🧹 Clean the description (remove HTML tags, styles, etc.)
    $product->description = strip_tags(html_entity_decode($product->description));

    return response()->json($product);
}








public function ProductImage($id){
    $ProductImage = ProductImage::find($id);
    return response()->json($ProductImage);
}







public function ProductVariant($id){

  

    // $product = VendorProduct::where('slug',$product_slug)->first();
    // if(!$product){
    //     return response()->json(['status' => false,'message' => 'product not found'], 404);
    // }
   $ProductVariant = ProductVariant::where('id',$id)
    // ->where('color_slug', $color_slug)
    ->with(['product.images', 'product.variants', 'product.category','product.subcategory'])
    ->first();
   return response()->json($ProductVariant);
}





public function ProductVariantSize($id)
{
  
    // ✅ Find the product by product_slug
    // $product = VendorProduct::where('slug', $product_slug)->first();

    // if (!$product) {
    //     return response()->json(['message' => 'Product not found'], 404);
    // }

    //✅ Find the variant by product ID and size_slug
    $variant = ProductVariant::where('id', $id)
        // ->where('size_slug', $size_slug)
        ->with(['product.images'])
        ->first();

    if (!$variant) {
        return response()->json(['message' => 'Variant not found'], 404);
    }

    return response()->json([
      'status' => true,
      'price' => $variant->price,
      'sizes' => $variant->size,
      'images' => $variant->product->images,
    ]);
}






}
