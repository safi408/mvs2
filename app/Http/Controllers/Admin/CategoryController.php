<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

         public function __construct()
    {
        $this->middleware('permission:manage_category');
    }
    //
    public function category(){
        return view('admin.categories.create');
    }
    public function index(){
          $categories = Category::with('subcategories')->latest()->get();
        return view('admin.categories.manage', compact('categories'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:categories',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // image validation
    ]);

    $imageAddress = null;

    if ($request->hasFile('image')) {
        
        $imageName = 'category_' . time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('categories', $imageName, 'public');
        $imageAddress = 'categories/' . $imageName;
    }

    Category::create([
        'name' => $request->name,
        'slug' => \Str::slug($request->name),
        'description' => $request->description,
        'image' => $imageAddress,
    ]);

    return redirect()->route('category.manage')->with('success', 'Category created successfully!');
}

        // Show form to edit category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

 public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $id,
    ]);

    $imageAddress = $category->image; // keep old image by default

    if ($request->hasFile('image')) {
        // ✅ Delete old image if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // ✅ Store new image
        $imageName = 'category_' . time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('categories', $imageName, 'public');
        $imageAddress = 'categories/' . $imageName;
    }

    // ✅ Update category
    $category->update([
        'name' => $request->name,
        'description' => $request->description,
        'slug' => Str::slug($request->name),
        'image' => $imageAddress, // ✅ update image field
    ]);

    return redirect()->route('category.manage')->with('success', 'Category updated successfully!');
}

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.manage')->with('warning', 'Category deleted successfully!');
    }
}
