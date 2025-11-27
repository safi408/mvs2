<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopCollection;

class ShopController extends Controller
{
    //

        public function ShopCollection()
    {

        $collection = ShopCollection::first();

        return response()->json($collection);
    }
}
