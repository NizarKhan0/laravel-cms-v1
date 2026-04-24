<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;

trait HasDynamicPermissions
{
    protected static function bootHasDynamicPermissions()
    {
        // When a model using this trait is created, auto-generate default permissions
        static::created(function (Model $model) {
            $perms = method_exists($model, 'getDynamicPermissions')
                ? $model->getDynamicPermissions()
                : ['view', 'create', 'update', 'delete'];

            $modelClass = class_basename($model);
            // e.g. BackendUser -> backend-user or Article -> article
            $slug = Str::kebab($modelClass);
            $guard = 'admin';

            foreach ($perms as $action) {
                // Use format: <slug>.<action>, e.g. backend-user.view
                $name = $slug . '.' . $action;
                if (!Permission::where('name', $name)->where('guard_name', $guard)->exists()) {
                    Permission::create(['name' => $name, 'guard_name' => $guard]);
                }
            }
        });
    }

    // Optional: models can override this to customize required permissions
    public function getDynamicPermissions(): array
    {
        return ['view', 'create', 'update', 'delete'];
    }
}
