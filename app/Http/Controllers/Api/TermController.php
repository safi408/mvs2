<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermBanner;
use App\Models\Term;

class TermController extends Controller
{
    //

    public function termBanner(){
        $terms = TermBanner::first();
        return response()->json($terms);
    }

    public function Term(){
        $terms = Term::first();
        return response()->json($terms);
    }
}
