<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        return view('dashboard');
    }
    public function profile(){
        return view('admin.profile');
    }
      // Profile update (name, email, phone, image)
public function update(Request $request)
{
    $admin = Auth::user();

    if ($admin->role_id != 10) {
        abort(403, 'Unauthorized Access');
    }

    $request->validate([
        'name'          => 'required|string|max:255',
        'email'         => 'required|email|unique:users,email,' . $admin->id,
        'phone'         => 'nullable|string|max:20',
        'profile_image' => 'nullable|image|max:2048',
    ]);

    // Image upload
    if ($request->hasFile('profile_image')) {
        // delete old image if exists
        if ($admin->image && file_exists(storage_path('app/public/'.$admin->image))) {
            unlink(storage_path('app/public/'.$admin->image));
        }

        $path = $request->file('profile_image')->store('profiles', 'public');
        $admin->image = $path;
    }

    $admin->name  = $request->name;
    $admin->email = $request->email;
    $admin->phone = $request->phone;
    $admin->save();

    return back()->with('success', 'Profile updated successfully.');
}
   public function change(){
     return view('admin.change');
   } 
         // Password update
    public function updatePassword(Request $request)
    {
        $admin = Auth::user();

        if ($admin->role_id != 10) {
            abort(403);
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Password updated successfully.');
    }
}
