<?php

namespace App\Http\Controllers\backendUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()
            ->where('guard_name', 'admin')
            ->with('permissions')
            ->orderBy('name')
            ->paginate(10);

        return view('backend-user.module.role.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $permissions = Permission::query()
            ->where('guard_name', 'admin')
            ->orderBy('name')
            ->get();

        // Provide available guards to the view for selecting guard_name
        $guards = array_keys(config('auth.guards'));

        return view('backend-user.module.role.create', [
            'permissions' => $permissions,
            'guards' => $guards,
        ]);
    }

    public function store(Request $request)
    {
        // Determine guard to validate against (default to admin)
        $guardName = $request->input('guard_name', 'admin');
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,NULL,id,guard_name,' . $guardName,
            'guard_name' => 'required|string|in:' . implode(',', array_keys(config('auth.guards'))),
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name,guard_name,' . $guardName,
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        $permissionModels = Permission::query()
            ->where('guard_name', $validated['guard_name'])
            ->whereIn('name', $validated['permissions'] ?? [])
            ->get();

        $role->syncPermissions($permissionModels);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        flash()->use('theme.ios')->success('Role created successfully!');

        return redirect()->route('roles.index');
    }

    public function edit(int $id)
    {
        $role = Role::query()
            ->where('guard_name', 'admin')
            ->findOrFail($id);

        $permissions = Permission::query()
            ->where('guard_name', 'admin')
            ->orderBy('name')
            ->get();

        // Guards available for editing
        $guards = array_keys(config('auth.guards'));

        return view('backend-user.module.role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'guards' => $guards,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $role = Role::query()
            ->where('guard_name', 'admin')
            ->findOrFail($id);

        // Allow changing guard_name; validate against new guard
        $guardName = $request->input('guard_name', $role->guard_name);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id . ',id,guard_name,' . $guardName,
            'guard_name' => 'required|string|in:' . implode(',', array_keys(config('auth.guards'))),
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name,guard_name,' . $guardName,
        ]);

        $role->update([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        $permissionModels = Permission::query()
            ->where('guard_name', $validated['guard_name'])
            ->whereIn('name', $validated['permissions'] ?? [])
            ->get();

        $role->syncPermissions($permissionModels);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        flash()->use('theme.ios')->success('Role updated successfully!');

        return redirect()->route('roles.index');
    }

    public function destroy(int $id)
    {
        $role = Role::query()
            ->where('guard_name', 'admin')
            ->findOrFail($id);

        if ($role->name === 'super-admin') {
            flash()->use('theme.ios')->error('Super-admin role cannot be deleted.');
            return redirect()->route('roles.index');
        }

        $role->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        flash()->use('theme.ios')->success('Role deleted successfully.');

        return redirect()->route('roles.index');
    }
}
