<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;



class CustomerController extends Controller
{
    





//old controller //
// public function register(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'name'     => 'required|string|max:255',
//         'email'    => 'required|string|email|max:255|unique:users',
//         'phone'    => 'nullable|string|max:20',
//         'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//         'password' => 'required|string|min:8|confirmed',
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'status'  => false,
//             'message' => 'Validation errors',
//             'errors'  => $validator->errors()
//         ], 422);
//     }

//     // Image handling
//     $imagePath = $request->hasFile('image')
//         ? $request->file('image')->store('profiles', 'public')
//         : 'profiles/default_user.png';

//     // Phone handling
//     $phone = $request->phone;
//     if (!$phone || trim($phone) === '') {
//         $phone = '03' . mt_rand(10000000, 99999999);
//     }

//     $user = User::create([
//         'name'     => $request->name,
//         'email'    => $request->email,
//         'phone'    => $phone,
//         'image'    => $imagePath,
//         'password' => Hash::make($request->password),
//         'role_id'  => $request->role_id ?? 7,
//     ]);

//     $token = $user->createToken('auth_token')->plainTextToken;

//     return response()->json([
//         'status'  => true,
//         'message' => 'Account created successfully',
//         'token'   => $token,
//         'user'    => $user,
//     ], 201);
// }



public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'     => 'required|string|min:3',
        'email'    => 'required|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => false,
            'message' => 'Validation errors',
            'errors'  => $validator->errors()
        ], 422);
    }

 
    $fullName = trim(preg_replace('/\s+/', ' ', $request->name));

    $nameParts = explode(' ', $fullName, 2);
    $firstName = ucfirst(strtolower($nameParts[0] ?? ''));
    $lastName  = ucfirst(strtolower($nameParts[1] ?? ''));



    //     // Image handling
    $imagePath = $request->hasFile('image')
        ? $request->file('image')->store('profiles', 'public')
        : 'profiles/default_user.png';

//     // Phone handling
    $phone = $request->phone;
    if (!$phone || trim($phone) === '') {
        $phone = '03' . mt_rand(10000000, 99999999);
    }






    $user = User::create([
        'name'       => $fullName,
        'first_name' => $firstName,
        'last_name'  => $lastName,
        'email'      => $request->email,
        'phone'    => $phone,
        'image'    => $imagePath,
        'country'   => $request->country ?? Null,
        'password'   => Hash::make($request->password),
        'role_id'    => $request->role_id ?? 7,
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status'  => true,
        'message' => 'Account created successfully',
        'token'   => $token,
        'user'    => $user,
    ], 201);
}







    
    // 🔹 Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials!'
            ], 401);
        }

        // delete old tokens
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message'=> 'Login successful',
            'token'  => $token,
            'user'   => $user
        ], 200);
    }


        // 🔹 Get Profile old
    // public function profile(Request $request)
    // {
    //     return response()->json([
    //         'status' => true,
    //         'user' => $request->user()
    //     ]);
    // }



    public function profile(Request $request)
{
    $user = $request->user();

    return response()->json([
        'status'  => true,
        'message' => 'User profile loaded',
        'user' => [
            'id'         => $user->id,
            'name'       => $user->name,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
            'phone'      => $user->phone,
            'country'    => $user->country,
            'image'      => $user->image ? asset('storage/'.$user->image) : null,
        ]
    ]);
}


    



    // 🔹 Update Profile old
    // public function update(Request $request)
    // {
    //     $user = $request->user();

    //     $validator = Validator::make($request->all(), [
    //         'name'  => 'sometimes|string|max:255',
    //          'email'    => 'required|email',
    //         'phone' => 'nullable|string|max:20',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);


    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     if ($request->hasFile('image')) {
    //         // delete old image
    //         if ($user->image && Storage::exists('public/'.$user->image)) {
    //             Storage::delete('public/'.$user->image);
    //         }

    //         $imagePath = $request->file('image')->store('profiles', 'public');
    //         $user->image = $imagePath;
    //     }

    //     if ($request->filled('name')) {
    //         $user->name = $request->name;
    //     }

    //         if ($request->filled('email')) {
    //         $user->email = $request->email;
    //     }

    //     if ($request->filled('phone')) {
    //         $user->phone = $request->phone;
    //     }

    //     $user->save();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Profile updated successfully',
    //         'user' => $user
    //     ]);
    // }




       // 🔹 Update Profile + Change Password (Combined)

public function update(Request $request)
{
    $user = auth()->user();

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $validator = Validator::make($request->all(), [
        'first_name' => 'nullable|string|max:255',
        'last_name'  => 'nullable|string|max:255',
        'email'      => 'required|email|unique:users,email,' . $user->id,
        'phone'      => 'nullable|string|max:20',
        'country'    => 'nullable|string|max:255',
        'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        // Password Change Fields
        'password'         => 'nullable',
        'new_password'     => 'nullable|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // 📌 Update Profile Image
    if ($request->hasFile('image')) {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        $user->image = $request->file('image')->store('profiles', 'public');
    }

    // 📌 Update Data
    $user->first_name = $request->firstName ?? $user->firstName;
    $user->last_name  = $request->lastName ?? $user->lastName;
    $user->email      = $request->email ?? $user->email;
    $user->phone      = $request->phone ?? $user->phone;
    $user->country    = $request->country ?? $user->country;

    // 📌 Change Password if provided
    if ($request->filled('password') && $request->filled('new_password')) {
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password is incorrect'
            ], 400);
        }
        $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return response()->json([
        'status'  => true,
        'message' => 'Profile updated successfully',
        'user'    => $user
    ]);
}




        // 🔹 Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }
    

}
