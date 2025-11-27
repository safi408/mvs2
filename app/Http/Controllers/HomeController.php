<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\VendorProduct;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Order;
use App\Models\OrderItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    { 
        
          $product = VendorProduct::whereNull('vendor_id')->count();
          $customer = User::where('role_id', '=', '7')->count();
          $vendor = User::where('role_id', '=', '8')->count();
          $category = Category::count();
          $subcategory = SubCategory::count();
          $order = Order::count();
          return view('dashboard', compact('product','customer','vendor','category','subcategory','order'));
    }
}
