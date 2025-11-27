<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'image'    => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $imagePath = null;

        // Handle profile image upload
        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('profiles', 'public');
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'image'    => $imagePath,
            'password' => Hash::make($data['password']),
            'role_id'  => 7, // Default role as Customer
        ]);
    }
        /**
     * After registration, log out the user and redirect to login page
     * with a success message.
     */
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();

        return redirect('/login')->with('status', 'Account created successfully! Please login.');
    }
}
