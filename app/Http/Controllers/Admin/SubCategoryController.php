<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
           public function __construct()
    {
        $this->middleware('permission:manage_subcategory');
    }
    //
    public function subcategory(){
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }
    public function index(){
         $subcategories = SubCategory::with('category')->latest()->get();
        return view('admin.subcategories.manage', compact('subcategories'));
    }
        public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:sub_categories',
        ]);

     

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('subcategory.manage')->with('success', 'Subcategory created!');
    }
        // Edit form
    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'   => 'required|string|max:255',
            'slug' => \Str::slug($request->name),
            'description' => 'nullable|string',
        ]);

        $subcategory->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('subcategory.manage')->with('success', 'SubCategory updated successfully!');
    }

    // Delete
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('subcategory.manage')->with('warning', 'SubCategory deleted successfully!');
    }
}
