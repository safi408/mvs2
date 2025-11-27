<?php

namespace App\Http\Controllers\Api\Faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqBanner;
use App\Models\Faq;

class FaqController extends Controller
{
    //
    public function faqbanner(){
         $faq = FaqBanner::first();
         return response()->json($faq);
    }


    public function faq()
{
    $faqs = Faq::select('id', 'category', 'question', 'answer')->get();

    $grouped = $faqs->groupBy('category')->map(function ($items, $category) {
        return [
            'category' => $category,
            'faqs' => $items->values()
        ];
    })->values();

    return response()->json($grouped);
}

 
}
