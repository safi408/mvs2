<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorProduct;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\ProductBrand;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Vendor;

class VendorProductController extends Controller
{


           public function __construct()
    {
        $this->middleware('permission:vendors_product');
    }


    public function create()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $childcategories = ChildCategory::latest()->get();
        $brands = ProductBrand::latest()->get();

        return view('vendors.products.create', compact('categories', 'subcategories','childcategories','brands'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'category_id' => 'required',
    //         'subcategory_id' => 'required',
    //         'product_name' => 'required',
    //         'slug' => 'required|unique:vendor_products,slug',
    //         'price' => 'required|numeric',
    //         'stock' => 'required|integer',
    //     ]);

    //     // ✅ Make sure the vendor record exists
    //     $vendor = auth()->user()->vendor;
    //     if (!$vendor) {
    //         return back()->with('warning', 'Vendor profile not found. Please complete your vendor registration.');
    //     }

    //     // ✅ Create Product for Admin (vendor_id = null)
    //     $product = VendorProduct::create([
    //         'vendor_id' => $vendor->id, // admin product
    //         'category_id' => $request->category_id,
    //         'subcategory_id' => $request->subcategory_id,
    //         'name' => $request->product_name,
    //         'slug' => Str::slug($request->slug),
    //         'description' => $request->description,
    //         'price' => $request->price,
    //         'stock' => $request->stock,
    //         'is_active' => true,
    //         'status' => 'approved',
    //     ]);

    //     // ✅ Save Sizes
    //     if ($request->has('sizes')) {
    //         foreach ($request->sizes as $size) {
    //             ProductSize::create([
    //                 'vendor_product_id' => $product->id,
    //                 'size' => $size
    //             ]);
    //         }
    //     }

    //     // ✅ Save Colors + Images
    //     if ($request->has('colors')) {
    //         foreach ($request->colors as $index => $colorData) {
    //             $variant = ProductVariant::create([
    //                 'vendor_product_id' => $product->id,
    //                 'color' => $colorData['code'] ?? null,
    //                 'color_name' => $colorData['color_name'] ?? null,
    //                 'size' => $colorData['size'] ?? null,
    //                 'price' => $colorData['price'] ?? null,
    //                 'stock' => $colorData['stock'] ?? 0,
    //             ]);

    //             if ($request->hasFile("images.$index")) {
    //                 foreach ($request->file("images.$index") as $image) {
    //                     $path = $image->store('product_images', 'public');
    //                     ProductImage::create([
    //                         'vendor_product_id' => $product->id,
    //                         'image_path' => $path
    //                     ]);
    //                 }
    //             }
    //         }
    //     }

    //     return redirect()->route('vendor.products.index')->with('success', 'Product submitted for admin approval!');
    // }

    //      public function store(Request $request)
    // {
    //     $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'subcategory_id' => 'nullable|exists:sub_categories,id',
    //         'product_name' => 'required|string|max:255',
    //         'slug' => 'required|unique:vendor_products,slug',
    //         'price' => 'required|numeric|min:0',
    //         'stock' => 'required|integer|min:0',
    //     ]);

    //       // ✅ Make sure the vendor record exists
    //     $vendor = auth()->user()->vendor;
    //     if (!$vendor) {
    //         return back()->with('warning', 'Vendor profile not found. Please complete your vendor registration.');
    //     }

    //     // ✅ Create Product for Admin (vendor_id = null)
    //     $product = VendorProduct::create([
    //         'vendor_id' => $vendor->id, // admin product
    //         'category_id' => $request->category_id,
    //         'subcategory_id' => $request->subcategory_id,
    //         'name' => $request->product_name,
    //         'slug' => Str::slug($request->slug),
    //         'description' => $request->description,
    //         'price' => $request->price,
    //         'stock' => $request->stock,
    //         'is_active' => true,
    //         'status' => 'approved',
    //     ]);

    //     // ✅ Save Sizes
    //     if ($request->has('sizes')) {
    //         foreach ($request->sizes as $size) {
    //             ProductSize::create([
    //                 'vendor_product_id' => $product->id,
    //                 'size' => $size
    //             ]);
    //         }
    //     }

    //     // ✅ Save Colors + Images
    //     if ($request->has('colors')) {
    //         foreach ($request->colors as $index => $colorData) {
    //             $variant = ProductVariant::create([
    //                 'vendor_product_id' => $product->id,
    //                 'color' => $colorData['code'] ?? null,
    //                 'color_name' => $colorData['color_name'] ?? null,
    //                 'size' => $colorData['size'] ?? null,
    //                 'price' => $colorData['price'] ?? null,
    //                 'stock' => $colorData['stock'] ?? 0,
    //             ]);

    //             if ($request->hasFile("images.$index")) {
    //                 foreach ($request->file("images.$index") as $image) {
    //                     $path = $image->store('product_images', 'public');
    //                     ProductImage::create([
    //                         'vendor_product_id' => $product->id,
    //                         'image_path' => $path
    //                     ]);
    //                 }
    //             }
    //         }
    //     }

    //     return redirect()->route('vendor.products.index')->with('success', 'Admin product added successfully!');
    // }

        public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required',
            'slug' => 'required|unique:vendor_products,slug',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // ✅ Make sure the vendor record exists
        $vendor = auth()->user()->vendor;
        if (!$vendor) {
            return back()->with('warning', 'Vendor profile not found. Please complete your vendor registration.');
        }

        // ✅ Create Main Product
        $product = VendorProduct::create([
            'vendor_id' => $vendor->id,
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
            'status' => 'pending',
        ]);

        // ✅ Save Sizes
        if ($request->has('sizes')) {
            foreach ($request->sizes as $size) {
                ProductSize::create([
                    'vendor_product_id' => $product->id,
                    'size' => $size ?? null
                ]);
            }
        }

        // // ✅ Save Colors + Variants + Images
        // if ($request->has('colors')) {
        //     foreach ($request->colors as $index => $colorData) {

        //         // ✅ Normalize color + size data safely
        //         $colorName = $colorData['color_name'] ?? $colorData['name'] ?? null;
        //         $colorCode = $colorData['code'] ?? $colorData['color'] ?? null;
        //         $sizeValue = $colorData['size'] ?? null;

        //         // ✅ Generate slugs safely
        //         $colorSlug = Str::slug($colorName ?? $colorCode ?? 'color');
        //         $sizeSlug = ($sizeValue ? Str::slug($sizeValue) : 'size') . '-' . $product->slug;

        //         // ✅ Create variant
        //         $variant = ProductVariant::create([
        //             'vendor_product_id' => $product->id,
        //             'color' => $colorCode,
        //             'color_name' => $colorName,
        //             'color_slug' => $colorSlug,
        //             'size' => $sizeValue,
        //             'size_slug' => $sizeSlug,
        //             'price' => $colorData['price'] ?? $product->price,
        //             'stock' => $colorData['stock'] ?? 0,
        //         ]);


            // ✅ Save Colors + Variants + Images
    if ($request->has('colors')) {
        foreach ($request->colors as $index => $colorData) {
            $variant = ProductVariant::create([
                'vendor_product_id' => $product->id,
                'color_name' => $colorData['code'] ?? null,
                'color' => $colorData['name'] ?? null,
                'sizes' => $colorData['sizes'] ?? [], // JSON array
                'price' => $colorData['price'] ?? null,
                'stock' => $colorData['stock'] ?? 0,
            ]);

                // ✅ Upload variant images (optional)
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

        return redirect()->route('vendor.products.index')
            ->with('success', 'Product submitted for admin approval!');
    }


    public function destroy($id)
{
    $product = VendorProduct::with(['images', 'sizes', 'variants'])->findOrFail($id);

    // ✅ Check: vendor can only delete their own product
    if ($product->vendor_id !== auth()->user()->vendor->id) {
        return back()->with('error', 'Unauthorized action.');
    }

    // ✅ Delete images from storage and DB
    foreach ($product->images as $image) {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();
    }

    // ✅ Delete sizes and variants
    $product->sizes()->delete();
    $product->variants()->delete();

    // ✅ Finally delete the product
    $product->delete();

    return redirect()->route('vendor.products.index')->with('warning', 'Product deleted successfully!');
}



// public function index()
// {
//     $vendor = Vendor::where('user_id', Auth::id())->first();

//     if (!$vendor) {
//         return redirect()->route('vendor.dashboard')
//             ->with('warning', 'No store found for your account.');
//     }

//     // ✅ Check if vendor is blocked
//     if ($vendor->status === 'blocked') {
//         // Extra Safety: Ensure all products become pending automatically
//         VendorProduct::where('vendor_id', $vendor->id)
//             ->update(['status' => 'pending']);

//         return redirect()->route('vendor.dashboard')
//             ->with('warning', 'Your store is blocked by the admin. Please contact support.');
//     }

//     // ✅ Vendor active => show products
//     $vendorId = $vendor->id;

//     $products = VendorProduct::with(['images', 'sizes', 'variants', 'category', 'subcategory'])
//         ->where('vendor_id', $vendorId)
//         ->latest()
//         ->get();

//     return view('vendors.products.manage', compact('products'));
// }




    public function index()
{


        $vendor = Vendor::where('user_id', Auth::id())->first();

    if (!$vendor) {
        return redirect()->route('vendor.dashboard')
            ->with('warning', 'No store found for your account.');
    }


    if ($vendor->status === 'blocked') {
        return redirect()->route('vendor.dashboard')
            ->with('warning', 'Your store is blocked by the admin. Please contact support.');
    }


    $vendorId = auth()->user()->vendor->id;

    $products = VendorProduct::with(['images', 'sizes', 'variants', 'category', 'subcategory'])
        ->where('vendor_id', $vendorId)
        ->latest()
        ->get();

    return view('vendors.products.manage', compact('products'));
}

}
