<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Str;
use App\Models\VendorProduct;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ProductBrand;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    //
    public function create(){
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $childcategories = ChildCategory::latest()->get();
        $brands = ProductBrand::latest()->get();
        return view('admin.products.create',compact('categories','subcategories','childcategories','brands'));
    }


    public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:sub_categories,id',
        'product_name' => 'required|string|max:255',
        'slug' => 'required|unique:vendor_products,slug',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    // ✅ Create Product for Admin (vendor_id = null)
    $product = VendorProduct::create([
        'vendor_id' => null, // admin product
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'childcategory_id' => $request->childcategory_id,
        'brand_id' => $request->brand_id,
        'name' => $request->product_name,
        'slug' => Str::slug($request->slug),
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'is_active' => true,
        'status' => 'approved',
    ]);

    // ✅ Save global product sizes (if any)
    if ($request->has('size')) {
        foreach ($request->sizes as $size) {
            ProductSize::create([
                'vendor_product_id' => $product->id,
                'size' => $size
            ]);
        }
    }

    // ✅ Save Colors + Variants + Images
    if ($request->has('colors')) {
        foreach ($request->colors as $index => $colorData) {
            $variant = ProductVariant::create([
                'vendor_product_id' => $product->id,
                'color_name' => $colorData['code'] ?? null,
                'color' => $colorData['color_name'] ?? null,
                'size' => $colorData['size'] ?? [], // JSON array
                'price' => $colorData['price'] ?? null,
                'stock' => $colorData['stock'] ?? 0,
            ]);

            // ✅ Save variant images
            if ($request->hasFile("images.$index")) {
                foreach ($request->file("images.$index") as $image) {
                    $path = $image->store('product_images', 'public');
                    ProductImage::create([
                        'vendor_product_id' => $product->id,
                        'variant_id' => $variant->id,
                        'image_path' => $path
                    ]);
                }
            }
        }
    }

    return redirect()->route('admin.show.product')->with('success', 'Admin product added successfully!');
}



public function show()
{
    // ✅ Sirf Admin ke products (vendor_id = null)
    $products = VendorProduct::with(['images', 'sizes', 'variants', 'variants.images', 'category', 'subcategory', 'childcategory'])
        ->whereNull('vendor_id')
        ->latest()
        ->get();

    return view('admin.products.manage', compact('products'));
}

       // Delete Product
    public function destroy($id)
    {
        $product = VendorProduct::findOrFail($id);

        // Delete images from storage
        if ($product->images) {
            foreach ($product->images as $colorImages) {
                foreach ($colorImages as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
        }

        // Delete the product record
        $product->delete();

        return redirect()->route('admin.show.product')->with('warning', 'Product deleted successfully!');
    }


    public function edit($id)
{
    $product = VendorProduct::with([
        'images',         // main product images
        'sizes',          // optional (if you store global sizes)
        'variants',       // product variants
        'variants.images',  // ✅ add this line for color + images section
    ])->findOrFail($id);

    $categories = \App\Models\Category::all();
    $subcategories = \App\Models\SubCategory::all();
    $childcategories = \App\Models\ChildCategory::all();
    $brands = \App\Models\ProductBrand::all();

    return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'childcategories', 'brands'));
}


// public function edit($id)
// {
//     $product = VendorProduct::with('variants')->findOrFail($id);
//     $categories = Category::all();
//     $subcategories = SubCategory::all();
//     $childcategories = ChildCategory::all();
//     $brands = ProductBrand::all();
    
//     $variants = $product->variants; // <--- Pass this to view

//     return view('admin.products.edit', compact(
//         'product', 
//         'categories', 
//         'subcategories', 
//         'childcategories', 
//         'brands', 
//         'variants' // make sure this is included
//     ));
// }






// public function update(Request $request, $id)
// {
  
//         // 🔹 Step 1: Get product with variants and images
//     $product = VendorProduct::with('variants.images')->findOrFail($id);

//     // 🔹 Step 2: Validate main product fields
//     $request->validate([
//         'category_id' => 'required|exists:categories,id',
//         'subcategory_id' => 'nullable|exists:sub_categories,id',
//         'childcategory_id' => 'nullable|exists:child_categories,id',
//         'product_name' => 'required|string|max:255',
//         'slug' => 'required|string|max:255|unique:vendor_products,slug,' . $product->id,
//         'price' => 'required|numeric|min:0',
//         'stock' => 'required|integer|min:0',
//     ]);

//     // 🔹 Step 3: Update main product
//     $product->update([
//         'category_id' => $request->category_id,
//         'subcategory_id' => $request->subcategory_id,
//         'childcategory_id' => $request->childcategory_id,
//         'brand_id' => $request->brand_id,
//         'name' => $request->product_name,
//         'slug' => Str::slug($request->slug),
//         'description' => $request->description,
//         'price' => $request->price,
//         'stock' => $request->stock,
//         'status' => 'approved',
//     ]);

//     // 🔹 Step 4: Handle variants
//     $existingVariantIds = [];

//     if ($request->has('colors')) {
//         foreach ($request->colors as $index => $colorData) {

//             // ✅ Sizes Clean Fix
//             $sizes = $colorData['sizes'] ?? '';

//             if (is_string($sizes)) {
//                 // Remove unwanted symbols (like ']', '[', etc.)
//                 $sizes = trim($sizes);
//                 $sizes = str_replace(['[', ']', '"', "'"], '', $sizes);
//                 $sizes = array_filter(explode(',', $sizes), fn($s) => !empty(trim($s)));
//             } elseif (is_array($sizes)) {
//                 $sizes = array_filter($sizes);
//             } else {
//                 $sizes = [];
//             }

//             // ✅ Always store clean JSON array
//             $variant = ProductVariant::updateOrCreate(
//                 [
//                     'vendor_product_id' => $product->id,
//                     'color_name' => $colorData['color_name'] ?? null,
//                 ],
//                 [
//                     'color' => $colorData['code'] ?? null,
//                     'sizes' => json_encode($sizes, JSON_UNESCAPED_UNICODE),
//                     'price' => $colorData['price'] ?? 0,
//                     'stock' => $colorData['stock'] ?? 0,
//                 ]
//             );

//             $existingVariantIds[] = $variant->id;

//             // 🔹 Step 5: Handle uploaded images for this variant
//             if ($request->hasFile("images.$index")) {
//                 // Delete old images first
//                 foreach ($variant->images as $img) {
//                     if (Storage::disk('public')->exists($img->image_path)) {
//                         Storage::disk('public')->delete($img->image_path);
//                     }
//                     $img->delete();
//                 }

//                 // Save new images
//                 foreach ($request->file("images.$index") as $image) {
//                     $path = $image->store('uploads/products', 'public');
//                     ProductImage::create([
//                         'vendor_product_id' => $product->id,
//                         'variant_id' => $variant->id,
//                         'image_path' => $path,
//                     ]);
//                 }
//             }
//         }
//     }

//     // 🔹 Step 6: Optionally delete variants not present anymore
//     $product->variants()->whereNotIn('id', $existingVariantIds)->delete();

//     return redirect()->route('admin.show.product')->with('success', '✅ Product updated successfully!');
// }


public function update(Request $request, $id)
{
    // 🔹 Step 1: Get product with variants and images
    $product = VendorProduct::with('variants.images')->findOrFail($id);

    // 🔹 Step 2: Validate main product fields
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:sub_categories,id',
        'childcategory_id' => 'nullable|exists:child_categories,id',
        'product_name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:vendor_products,slug,' . $product->id,
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    // 🔹 Step 3: Update main product
    $product->update([
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'childcategory_id' => $request->childcategory_id,
        'brand_id' => $request->brand_id,
        'name' => $request->product_name,
        'slug' => Str::slug($request->slug),
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'status' => 'approved',
    ]);

    // 🔹 Step 4: Handle variants
    $existingVariantIds = [];

    if ($request->has('colors')) {
        foreach ($request->colors as $index => $colorData) {

            // ✅ Step 4.1 — Clean and normalize sizes input
            $sizes = $colorData['size'] ?? [];

            if (is_string($sizes)) {
                // Remove unwanted symbols and clean up string
                $sizes = trim($sizes);
                $sizes = str_replace(['[', ']', '"', "'"], '', $sizes);
                $sizes = array_map('trim', explode(',', $sizes));
            } elseif (is_array($sizes)) {
                $sizes = array_filter(array_map('trim', $sizes));
            } else {
                $sizes = [];
            }

            // Ensure only non-empty valid sizes are saved
            $sizes = array_values(array_filter($sizes, fn($s) => !empty($s)));

            // ✅ Step 4.2 — Update or create variant
            $variant = ProductVariant::updateOrCreate(
                [
                    'vendor_product_id' => $product->id,
                    'color' => $colorData['color_name'] ?? null,
                ],
                [
                    'color_name' => $colorData['code'] ?? null,
                    'size' => json_encode($sizes, JSON_UNESCAPED_UNICODE),
                    'price' => $colorData['price'] ?? 0,
                    'stock' => $colorData['stock'] ?? 0,
                ]
            );

            $existingVariantIds[] = $variant->id;

            // 🔹 Step 5: Handle uploaded images for this variant
            if ($request->hasFile("images.$index")) {

                // Delete old images
                foreach ($variant->images as $img) {
                    if (Storage::disk('public')->exists($img->image_path)) {
                        Storage::disk('public')->delete($img->image_path);
                    }
                    $img->delete();
                }

                // Save new images
                foreach ($request->file("images.$index") as $image) {
                    $path = $image->store('products_images', 'public');
                    ProductImage::create([
                        'vendor_product_id' => $product->id,
                        'variant_id' => $variant->id,
                        'image_path' => $path,
                    ]);
                }
            }
        }
    }

    // 🔹 Step 6: Delete variants that were removed from form
    if (!empty($existingVariantIds)) {
        $product->variants()->whereNotIn('id', $existingVariantIds)->delete();
    }

    return redirect()->route('admin.show.product')
        ->with('success', '✅ Product updated successfully!');
}




// public function update(Request $request, $id)
// {
//     // 🔹 Step 1: Get product with variants and images
//     $product = VendorProduct::with('variants.images')->findOrFail($id);

//     // 🔹 Step 2: Validate main product fields
//     $request->validate([
//         'category_id' => 'required|exists:categories,id',
//         'subcategory_id' => 'nullable|exists:sub_categories,id',
//         'childcategory_id' => 'nullable|exists:child_categories,id',
//         'product_name' => 'required|string|max:255',
//         'slug' => 'required|string|max:255|unique:vendor_products,slug,' . $product->id,
//         'price' => 'required|numeric|min:0',
//         'stock' => 'required|integer|min:0',
//     ]);

//     // 🔹 Step 3: Update main product
//     $product->update([
//         'category_id' => $request->category_id,
//         'subcategory_id' => $request->subcategory_id,
//         'childcategory_id' => $request->childcategory_id,
//         'brand_id' => $request->brand_id,
//         'name' => $request->product_name,
//         'slug' => Str::slug($request->slug),
//         'description' => $request->description,
//         'price' => $request->price,
//         'stock' => $request->stock,
//         'status' => 'approved',
//     ]);

//     // 🔹 Step 4: Handle variants
//     $existingVariantIds = [];

//     if ($request->has('colors')) {
//         foreach ($request->colors as $index => $colorData) {

//             // Get sizes as array
//             $sizes = $colorData['sizes'] ?? [];
//             if (is_string($sizes)) {
//                 $sizes = array_filter(explode(',', $sizes));
//             }

//             // Use variant id if exists (from frontend)
//             $variantId = $colorData['id'] ?? null;

//             // Update or create variant
//             $variant = ProductVariant::updateOrCreate(
//                 ['id' => $variantId],
//                 [
//                     'vendor_product_id' => $product->id,
//                     'color_name' => $colorData['color_name'] ?? null,
//                     'color' => $colorData['code'] ?? null,
//                     'sizes' => json_encode($sizes),
//                     'price' => $colorData['price'] ?? 0,
//                     'stock' => $colorData['stock'] ?? 0,
//                 ]
//             );

//             $existingVariantIds[] = $variant->id;

//             // 🔹 Step 5: Handle uploaded images for this variant
//             if ($request->hasFile("images.$index")) {
//                 // Delete old images
//                 foreach ($variant->images as $img) {
//                     if (Storage::disk('public')->exists($img->image_path)) {
//                         Storage::disk('public')->delete($img->image_path);
//                     }
//                     $img->delete();
//                 }

//                 // Save new images
//                 foreach ($request->file("images.$index") as $image) {
//                     $path = $image->store('uploads/products', 'public');
//                     ProductImage::create([
//                         'vendor_product_id' => $product->id,
//                         'variant_id' => $variant->id,
//                         'image_path' => $path,
//                     ]);
//                 }
//             }
//         }
//     }

//     // 🔹 Step 6: Delete removed variants
//     $product->variants()->whereNotIn('id', $existingVariantIds)->delete();

//     return redirect()->route('admin.show.product')->with('success', '✅ Product updated successfully!');
// }











}









