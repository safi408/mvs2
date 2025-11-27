<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage; 
use App\Models\Vendor;
use App\Models\VendorProduct;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ProductImage;

class VendorDashboardController extends Controller
{


   

  
    //

//     public function dashboard()
// {
//     $vendor = Vendor::where('user_id', Auth::id())->first();

//     // 🧩 Check if vendor exists
//     if (!$vendor) {
//         return redirect()->route('vendor.profile')
//            ->with('warning', 'Your vendor store has not been created yet. Please wait for the admin to create your store.');

//     }

//     $product = VendorProduct::where('vendor_id', $vendor->id)->count();

//     return view('vendors.dashboard', compact('product'));
// }




// public function myStore()
// {
//     $vendor = Vendor::where('user_id', Auth::id())->first();

//     if (!$vendor) {
//         return redirect()->route('vendor.dashboard')
//             ->with('warning', 'No store found for your account.');
//     }

//     // ✅ Check if vendor is blocked
//     if ($vendor->status === 'blocked') {
//         return redirect()->route('vendor.dashboard')
//             ->with('warning', 'Your store is blocked by the admin. Please contact support.');
//     }

//     return view('vendors.my_store', compact('vendor'));
// }

// public function profile(){
//     $user = Auth::user();
//     $vendor = Vendor::where('user_id',$user->id)->first();
//     return view('vendors.profile', compact('vendor'));
// }

// public function update(Request $request){
//     $user = Auth::user();
//             // Validation
//         $request->validate([
//             'name'  => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email,' . $user->id,
//             'phone' => 'nullable|string|max:20',
//             'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//         ]);

//         // Update text fields
//         $user->name  = $request->name;
//         $user->email = $request->email;
//         $user->phone = $request->phone;

//         // Image upload
//         if ($request->hasFile('image')) {
//             // Purani image delete karo (agar hai)
//             if ($user->image && Storage::exists('public/' . $user->image)) {
//                 Storage::delete('public/' . $user->image);
//             }

//             $path = $request->file('image')->store('profile_images', 'public');
//             $user->image = $path;
//         }

//         $user->save();

//         return redirect()->back()->with('success', 'Profile updated successfully!');
// }



    // 🏠 Vendor Dashboard
    public function dashboard()
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();

        // 🧩 If vendor store not created
        if (!$vendor) {
            return redirect()->route('vendor.createStore')
                ->with('warning', 'Please create your store before accessing the dashboard.');
        }

        // 🚫 If store blocked by admin
        if ($vendor->status === 'blocked') {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Your store has been blocked by the admin. Please contact support.');
        }

        $product = VendorProduct::where('vendor_id', $vendor->id)->count();

        return view('vendors.dashboard', compact('product'));
    }

    // 🏪 Vendor My Store
    public function myStore()
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();

        // 🚫 If vendor is blocked
        if ($vendor && $vendor->status === 'blocked') {
            return redirect()->route('vendor.dashboard')
                ->with('warning', 'Your store is blocked by the admin. Please contact support.');
        }

        // 🚀 If store exists, show details
        if ($vendor) {
            return view('vendors.my_store', compact('vendor'));
        }

        // 🚀 Else show create store form
        return view('vendors.create_store');
    }

    // 🆕 Create Store (Vendor self-registers store)
    public function createStore(Request $request)
    {
              // ✅ Validation rules
        $validated = $request->validate([
            'store_name'        => 'required|string|max:255',
            'store_slug'        => 'required|string|max:255|unique:vendors,store_slug',
            'store_logo'        => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'phone'             => 'required|string|max:20',
            'city'              => 'required|string|max:100',
            'country'           => 'required|string|max:100',
            'commission_rate'   => 'required|numeric|min:0|max:100',
            'status'            => 'nullable|in:pending,active,blocked',
            'address'           => 'required|string|max:255',
            'store_description' => 'required|string|max:2000',
            'is_verified'       => 'required|boolean',
        ]);

        // 🧩 Check if vendor already has store
        $existing = Vendor::where('user_id', Auth::id())->first();
        if ($existing) {
            return redirect()->route('vendor.dashboard')->with('info', 'Your store already exists.');
        }

        // 🔑 Assign user ID automatically
        $validated['user_id'] = Auth::id();

        // 🏷️ Auto-generate slug if empty
        if (empty($validated['store_slug'])) {
            $validated['store_slug'] = Str::slug($validated['store_name']) . '-' . uniqid();
        }

        // 🖼️ Handle logo upload
        if ($request->hasFile('store_logo')) {
            $validated['store_logo'] = $request->file('store_logo')->store('vendors/logos', 'public');
        }

        // ✅ Set defaults
        $validated['is_verified'] = $request->has('is_verified') ? true : false;
        $validated['status'] = $validated['status'] ?? 'pending';

        // 💾 Create store
        Vendor::create($validated);

        // 🔁 Redirect after success
        return redirect()->route('vendor.dashboard')->with('success', 'Your store has been created successfully!');
    }

    // 👤 Vendor Profile
    public function profile()
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();
        return view('vendors.profile', compact('vendor'));
    }

    // 🔄 Update Vendor Profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('image')) {
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }



}
