<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

            protected function redirectTo()
    {
        $user = auth()->user();

        if ($user->role_id == 10) {   // Admin
            return '/dashboard';
        }

        if ($user->role_id == 7) {   // Customer
            return '/customers/dashboard';
        }

        
        if ($user->role_id == 8) {   // Customer
            return '/vendors/dashboard';
        }

      
        return '/dashboard'; // Default
    }
}
