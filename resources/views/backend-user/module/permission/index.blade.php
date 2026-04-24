@extends('backend-user.layouts.app')

@section('title', 'Permissions')

@section('content')

    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
            Permissions
        </h2>

        @can('permission.create')
            <a href="{{ route('permissions.create') }}"
                class="rounded-lg bg-brand-500 px-4 py-2 text-sm text-white hover:bg-brand-600">
                Create Permission
            </a>
        @endcan
    </div>


    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

        <div class="p-5 border-b border-gray-100 dark:border-gray-800">

            <form method="GET">
                <select name="guard_name" onchange="this.form.submit()" class="rounded border px-3 py-2">
                    <option value="">
                        All Guards
                    </option>

                    @foreach($guards as $guard)
                        <option value="{{ $guard }}" {{ $currentGuard == $guard ? 'selected' : '' }}>
                            {{ $guard }}
                        </option>
                    @endforeach

                </select>
            </form>

        </div>


        <div class="overflow-x-auto p-5">

            <table class="w-full min-w-[650px]">

                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-3 py-3 text-left text-xs uppercase text-gray-500">
                            Name
                        </th>

                        <th class="px-3 py-3 text-left text-xs uppercase text-gray-500">
                            Guard
                        </th>

                        <th class="px-3 py-3 text-right text-xs uppercase text-gray-500">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($permissions as $permission)

                        <tr class="border-b border-gray-100 dark:border-gray-800">

                            <td class="px-3 py-3 text-sm text-gray-700 dark:text-gray-300">
                                {{ $permission->name }}
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-600 dark:text-gray-400">
                                {{ $permission->guard_name }}
                            </td>

                            <td class="px-3 py-3">

                                <div class="flex justify-end gap-2">

                                    @can('permission.update')
                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                            class="rounded border px-3 py-1 text-xs text-gray-700 dark:text-gray-300">
                                            Edit
                                        </a>
                                    @endcan


                                    @can('permission.delete')
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this permission?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded border border-red-300 px-3 py-1 text-xs text-red-600">
                                                Delete
                                            </button>

                                        </form>
                                    @endcan

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="px-3 py-8 text-center text-sm text-gray-500">
                                No permissions found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($permissions->hasPages())
            <div class="border-t border-gray-100 p-5 dark:border-gray-800">
                {{ $permissions->links() }}
            </div>
        @endif

    </div>

@endsection