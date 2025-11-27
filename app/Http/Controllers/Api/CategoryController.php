<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function category()
    {
        $categories = Category::with('subcategories')
        ->WithCount('subcategories')
        ->withCount('products')
        ->latest()
        ->get();
         return response()->json($categories);
    }

    public function childcategory(){
        $childcategories = ChildCategory::with(['category','subcategory'])->latest()->get();
        return response()->json($childcategories);
    }
    
             public function subcategory()
    {
        $subcategories = SubCategory::with('category')->latest()->get();
        // return view('products.subcategories.manage', compact('subcategories'));
        return response()->json($subcategories);
    }

  public function store(Request $request)
{
    // 🔹 Step 1: Validation Rules (with custom error messages)
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:categories,name',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ], [
        'name.required' => 'Category name is required.',
         'description.required' => 'Category description is required',
        'name.unique' => 'This category name already exists.',
        'image.image' => 'File must be an image.',
        'image.mimes' => 'Only JPG, JPEG, PNG, GIF formats are allowed.',
        'image.max' => 'Image size should not exceed 2MB.',
    ]);

    // 🔹 Step 2: If Validation Fails
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    // 🔹 Step 3: Image Upload
    $imageAddress = null;

    if ($request->hasFile('image')) {
        $imageName = 'category_' . time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('categories', $imageName, 'public');
        $imageAddress = 'categories/' . $imageName;
    }

    // 🔹 Step 4: Create Category
    $category = Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'image' => $imageAddress,
    ]);

    // 🔹 Step 5: Return JSON Response
    return response()->json([
        'status' => true,
        'message' => 'Category created successfully!',
        'category' => $category,
    ], 201);
}
}
