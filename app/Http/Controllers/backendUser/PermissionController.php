<?php

namespace App\Http\Controllers\backendUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        // optional filter by guard
        $guard = $request->get('guard_name');

        $permissions = Permission::query();

        // kalau pilih guard tertentu, filter
        if (!empty($guard)) {
            $permissions->where('guard_name', $guard);
        }

        $permissions = $permissions
            ->orderBy('name')
            ->paginate(10)
            ->appends($request->query());

        $guards = array_keys(config('auth.guards'));

        return view('backend-user.module.permission.index', [
            'permissions' => $permissions,
            'guards' => $guards,
            'currentGuard' => $guard,
        ]);
    }

    public function create()
    {
        $guards = array_keys(config('auth.guards'));

        return view('backend-user.module.permission.create', [
            'guards' => $guards,
        ]);
    }

    public function store(Request $request)
    {
        $guards = array_keys(config('auth.guards'));

        $guardName = $request->input('guard_name');

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,NULL,id,guard_name,' . $guardName,
            'guard_name' => 'required|string|in:' . implode(',', $guards),
        ]);

        Permission::create([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        flash()->use('theme.ios')->success('Permission created successfully!');

        return redirect()->route('permissions.index');
    }

    public function edit(int $id)
    {
        $permission = Permission::findOrFail($id);

        $guards = array_keys(config('auth.guards'));

        return view('backend-user.module.permission.edit', [
            'permission' => $permission,
            'guards' => $guards,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $permission = Permission::findOrFail($id);

        $guards = array_keys(config('auth.guards'));

        $guardName = $request->input('guard_name', $permission->guard_name);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' .
                $permission->id .
                ',id,guard_name,' .
                $guardName,

            'guard_name' => 'required|string|in:' . implode(',', $guards),
        ]);

        $permission->update([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        flash()->use('theme.ios')->success('Permission updated successfully!');

        return redirect()->route('permissions.index');
    }

    public function destroy(int $id)
    {
        $permission = Permission::findOrFail($id);

        $protected = [
            'backend-user.view',
            'backend-user.create',
            'backend-user.update',
            'backend-user.delete',

            'activity-log.view',

            'role.view',
            'role.create',
            'role.update',
            'role.delete',

            'permission.view',
            'permission.create',
            'permission.update',
            'permission.delete',
        ];

        if (in_array($permission->name, $protected, true)) {

            flash()
                ->use('theme.ios')
                ->error('Core permission cannot be deleted.');

            return redirect()->route('permissions.index');
        }

        $permission->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        flash()
            ->use('theme.ios')
            ->success('Permission deleted successfully.');

        return redirect()->route('permissions.index');
    }
}
