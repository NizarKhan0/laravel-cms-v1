@extends('backend-user.layouts.app')

@section('title', 'Edit Role')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Edit Role</h2>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6 p-6">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Role Name</label>
                    <input type="text" name="name" value="{{ old('name', $role->name) }}"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    @php
                        $selectedPermissions = old('permissions', $role->permissions->pluck('name')->toArray());
                    @endphp
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Permissions</label>
                    <select name="permissions[]" multiple class="js-permission-select w-full">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}" @selected(in_array($permission->name, $selectedPermissions, true))>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    @php
                        $guardNames = $guards ?? array_keys(config('auth.guards'));
                    @endphp
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Guard</label>
                    <select name="guard_name" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900">
                        @foreach ($guardNames as $guard)
                            <option value="{{ $guard }}" @selected(old('guard_name', $role->guard_name) == $guard)>{{ $guard }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 px-6 py-4 dark:border-gray-800">
                <a href="{{ route('roles.index') }}"
                    class="rounded-lg border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Cancel</a>
                <button type="submit" class="rounded-lg bg-brand-500 px-4 py-2 text-sm text-white hover:bg-brand-600">
                    Update Role
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.js-permission-select').select2({
                width: '100%',
                placeholder: 'Select permissions',
                closeOnSelect: false
            });
        });
    </script>
@endpush
