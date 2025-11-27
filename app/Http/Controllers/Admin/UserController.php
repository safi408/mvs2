<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    //
    public function create(){
        $roles = Role::latest()->get();
        return view('admin.users.create', compact('roles'));
    }
           // Store User
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'nullable|string|max:20',
            'role_id'  => 'required|exists:roles,id',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Upload Image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
        }

        // Save User
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role_id'  => $request->role_id,
            'image'    => $imagePath,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.manage')->with('success', 'User created successfully!');
    }

    public function index()
{
    $users = User::with('role')
    // ->where('role_id', '!=', 10) 
    ->latest()
    ->get();


    return view('admin.users.manage', compact('users'));
}

  public function destroy($id){
     $user = User::find($id);
     $user->delete();
     return redirect()->route('user.manage')->with('warning', 'User deleted successfully!');
  }
}
