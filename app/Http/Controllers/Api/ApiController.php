<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\ChildCategory;

class ApiController extends Controller
{
    //
         public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    
    public function getChildcategories($subcategory_id)
    {
        $childcategories = ChildCategory::where('subcategory_id', $subcategory_id)->get();
        return response()->json($childcategories);
    }


}
