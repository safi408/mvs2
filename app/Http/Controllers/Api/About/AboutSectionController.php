<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutSection;

class AboutSectionController extends Controller
{
    //
    public function AboutSection(){
        $about = AboutSection::first();
        return response()->json($about);
    }
}
