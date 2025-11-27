<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;

class RolePermissionController extends Controller
{
      /**
     * Show the assign permissions form for a role
     */
    public function grant($id)
    {
        // Load role with its permissions
        $role = Role::with('permissions')->findOrFail($id);

        // Load all permissions
        $permissions = Permission::all();

        // Return the Blade view
        return view('admin.role_permissions.index', compact('role', 'permissions'));
    }

    /**
     * Update permissions assigned to a role
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'array', // Optional, can be empty
        ]);

        $role = Role::findOrFail($id);

        // Sync permissions (attach new and detach old)
        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->back()->with('success', 'Permissions assign successfully!');
    }
}
