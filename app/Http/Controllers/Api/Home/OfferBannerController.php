<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferBanner;

class OfferBannerController extends Controller
{
    //
    public function OfferBanner(){
       $OfferBanner = OfferBanner::first();
       return response()->json($OfferBanner);
    }
}
