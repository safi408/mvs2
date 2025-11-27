<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreFeature;

class StoreFeatureController extends Controller
{
    //
        public function show(){

        $features = StoreFeature::all();  
        return response()->json($features);
    }
}
