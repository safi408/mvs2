<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerReview;

class CustomerReviewController extends Controller
{
    //
    public function customerReview(){
        $review = CustomerReview::all();
        return response()->json($review);
    }
}
