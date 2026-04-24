<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class DynamicPermissionHelper
{
    public static function slugForModel(string $modelClass): string
    {
        // Use kebab-case singular slug, e.g. BackendUser -> backend-user, Article -> article
        return Str::kebab(class_basename($modelClass));
    }

    public static function permissionName(string $action, string $modelClass): string
    {
        $slug = self::slugForModel($modelClass);
        // Follow the convention: <slug>.<action> (e.g. backend-user.view)
        return $slug . '.' . $action;
    }
}
