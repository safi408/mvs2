<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DefaultController extends Controller
{
    //
    public function profile(){
    $user = Auth::user();
    return view('admin.default.profile', compact('user'));
    }

   public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'password' => 'nullable|min:6',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;

 

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('profiles', 'public');
        $user->image = $path;
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully!');
}


}
