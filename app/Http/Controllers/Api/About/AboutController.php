<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutBrand;
use App\Models\AboutBanner;

class AboutController extends Controller
{
    //
        public function AboutBanner(){
        $about = AboutBanner::first();
        return response()->json($about);
    }
    public function AboutBrand(){
      $brands = AboutBrand::latest()->get();
      return response()->json($brands);
    }
}
