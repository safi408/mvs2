<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Convert 'admin|user' into array ['admin', 'user]
            $roles = explode('|', $roles);

            foreach ($roles as $role) {
        if (
            ($role === 'admin' && $user->role_id == 10) ||
            ($role === 'customer' && $user->role_id == 7) ||
             ($role === 'vendor' && $user->role_id == 8) ) {
            return $next($request);
            }

            }
        }
          abort(403);
    }
}
