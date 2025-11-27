<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;

class ChildCategoryController extends Controller
{
    //
    public function create(){
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('admin.childcategory.create',compact('categories','subcategories'));
    }
     public function store(Request $request){
        $request->validate([
             'name' => 'required',
             'category_id' =>'required',
             'subcategory_id' => 'required'
        ]);

        $child = new ChildCategory();
        $child->name = $request->name;
        $child->category_id = $request->category_id;
        $child->subcategory_id = $request->subcategory_id;

        $child->save();

        return redirect()->route('childcategory.manage')->with('success', 'childCategory saved successfully!');
        
     }
    public function show(){
        $childcategories = ChildCategory::latest()->get();
        return view('admin.childcategory.manage',compact('childcategories'));
    }
    public function destroy($id){
        $child = ChildCategory::find($id);
        $child->delete();
        return redirect()->route('childcategory.manage')->with('warning','childCategory deleted successfully!');
    }
    public function edit($id){
        $childcategory = ChildCategory::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.childcategory.edit',compact('childcategory','categories','subcategories'));
    }
    public function update(Request $request, $id){

        $request->validate([

              'name' => 'required',
             'category_id' =>'required',
             'subcategory_id' => 'required'
             
        ]);

        $child = ChildCategory::find($id);
        $child->name = $request->name;
        $child->category_id  = $request->category_id;
        $child->subcategory_id = $request->subcategory_id;
        $child->save();
       return redirect()->route('childcategory.manage')->with('succes','childCategory updated successfully!');

    }
}
