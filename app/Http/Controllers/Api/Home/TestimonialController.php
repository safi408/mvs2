<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    //
    public function show()
{
    $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
    return response()->json($testimonials);
}
}
