<?php

namespace Database\Seeders;

use App\Models\backendUser\BackendUser;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminRolePermissionSeeder extends Seeder
{
    /**
     * Seed admin roles and permissions.
     */
    public function run(): void
    {
        $permissionRegistrar = app(PermissionRegistrar::class);
        $permissionRegistrar->forgetCachedPermissions();

        $permissions = [
            'backend-user.view',
            'backend-user.create',
            'backend-user.update',
            'backend-user.delete',
            'activity-log.view',
        ];

        foreach ($permissions as $permissionName) {
            Permission::findOrCreate($permissionName, 'admin');
        }

        $permissionRegistrar->forgetCachedPermissions();

        $superAdmin = Role::findOrCreate('super-admin', 'admin');
        $editor = Role::findOrCreate('editor', 'admin');
        $viewer = Role::findOrCreate('viewer', 'admin');

        $adminPermissions = Permission::query()
            ->where('guard_name', 'admin')
            ->whereIn('name', $permissions)
            ->get();

        $superAdmin->syncPermissions($adminPermissions);
        $editor->syncPermissions(
            $adminPermissions->whereIn('name', [
                'backend-user.view',
                'backend-user.create',
                'backend-user.update',
                'activity-log.view',
            ])->values()
        );
        $viewer->syncPermissions(
            $adminPermissions->whereIn('name', [
                'backend-user.view',
                'activity-log.view',
            ])->values()
        );

        $defaultAdmin = BackendUser::where('email', 'superadmin@example.com')->first();
        if ($defaultAdmin) {
            $defaultAdmin->syncRoles(['super-admin']);
        }
    }
}
