<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class UserDashboardController extends Controller
{
    //
    public function dashboard(){
        return view('users.dashboard');
    }
    public function profile(){
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }
               // Profile Update
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update text fields
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Image upload
        if ($request->hasFile('image')) {
            // Purani image delete karo (agar hai)
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
   
    public function order()
{
    $orders = Order::with('items')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('users.orders.index', compact('orders'));
}


    public function show($id)
    {
        // Fetch order with items and history
        $order = Order::with(['items'])->findOrFail($id);

        return view('users.orders.show', compact('order'));
    }


}
