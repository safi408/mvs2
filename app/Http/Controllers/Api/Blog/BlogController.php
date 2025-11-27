<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\AddBlog;

class BlogController extends Controller
{
    //
    public function banner(){
        $banner = Blog::first();
        return response()->json($banner);
    }

       public function show(){
        $blogs = AddBlog::latest()->get();
        foreach($blogs as $blog){
          $blog->description = strip_tags($blog->description);
        }
        return response()->json($blogs);
    }

    public function view($id){
         $blog = AddBlog::find($id);
         $blog->description = strip_tags($blog->description);
         return response()->json([
            'status' => true,
            'blogs' => $blog,
         ]);
    }

}
