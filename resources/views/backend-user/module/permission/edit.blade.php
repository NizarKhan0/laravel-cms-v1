@extends('backend-user.layouts.app')

@section('title', 'Edit Permission')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Edit Permission</h2>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6 p-6">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Permission Name</label>
                    <input type="text" name="name" value="{{ old('name', $permission->name) }}"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Guard</label>
                    <select name="guard_name" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900">
                        @foreach ($guards ?? [ $permission->guard_name ] as $guard)
                            <option value="{{ $guard }}" @selected(old('guard_name', $permission->guard_name) == $guard)>{{ $guard }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 px-6 py-4 dark:border-gray-800">
                <a href="{{ route('permissions.index') }}"
                    class="rounded-lg border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Cancel</a>
                <button type="submit"
                    class="rounded-lg bg-brand-500 px-4 py-2 text-sm text-white hover:bg-brand-600">Update Permission</button>
            </div>
        </form>
    </div>
@endsection
