<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ✅ Use Bootstrap 5 pagination style
        Paginator::useBootstrapFive();

        // ✅ Custom Blade directive for role check
        Blade::if('role', function ($role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });

        // ✅ Custom Blade directive for permission check (for @can)
        Blade::if('can', function ($permission) {
            return auth()->check() && auth()->user()->hasPermission($permission);
        });

        // ✅ Define all permissions dynamically for Gate (optional)
        try {
            Permission::all()->each(function ($perm) {
                Gate::define($perm->name, fn($user) => $user->hasPermission($perm->name));
            });
        } catch (\Exception $e) {
            // Ignore error if migration not yet run
        }
    }
}
