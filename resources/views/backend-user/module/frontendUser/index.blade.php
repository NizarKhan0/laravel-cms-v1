@extends('backend-user.layouts.app')

@section('title', 'List Frontend Users')

@section('content')
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `List Frontend Users` }" class="mb-6">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="{{ route('admin.dashboard') }}">
                            Home
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5">
                <!-- Top Bar with Title and Create Button -->
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        All Frontend Users
                    </h3>
                    <a href="{{ route('frontend-user.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM2.615 16.428a1.224 1.224 0 0 1-.569-1.175 6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 0 1 8 18a9.953 9.953 0 0 1-5.385-1.572ZM16.25 5.75a.75.75 0 0 0-1.5 0v2h-2a.75.75 0 0 0 0 1.5h2v2a.75.75 0 0 0 1.5 0v-2h2a.75.75 0 0 0 0-1.5h-2v-2Z" />
                        </svg>
                        Create New User
                    </a>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.02]">
                    <div class="p-5">
                        <!-- ====== Table Start ====== -->
                        <div class="max-w-full overflow-x-auto">
                            <div class="min-w-[800px]">
                                <table class="w-full">
                                    <!-- Table Header -->
                                    <thead>
                                        <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">No</span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Username</span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Email</span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Full
                                                    Name</span>
                                            </th>
                                            {{-- <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Created
                                                    At</span>
                                            </th> --}}
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Last
                                                    Login At</span>
                                            </th>
                                            <th class="px-5 py-3 text-right">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        @forelse($frontendUsers as $user)
                                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                                <td class="px-5 py-4">
                                                    <span
                                                        class="block text-sm font-medium text-gray-800 dark:text-white/90">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span
                                                        class="block text-sm text-gray-600 dark:text-gray-400">{{ $user->username }}</span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span
                                                        class="block text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                        {{ $user->first_name ? $user->first_name . ' ' . ($user->last_name ?? '') : $user->last_name ?? '-' }}
                                                    </span>
                                                </td>
                                                {{-- <td class="px-5 py-4">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ $user->created_at ? $user->created_at->format('H:i') : '-' }}
                                                        </span>
                                                        <span class="text-xs text-gray-500 dark:text-gray-500">
                                                            {{ $user->created_at ? $user->created_at->format('d F Y') : '-' }}
                                                        </span>
                                                    </div>
                                                </td> --}}
                                                <td class="px-5 py-4">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ $user->last_login_at ? $user->last_login_at->format('H:i') : '-' }}
                                                        </span>
                                                        <span class="text-xs text-gray-500 dark:text-gray-500">
                                                            {{ $user->last_login_at ? $user->last_login_at->format('d F Y') : '-' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <div class="flex items-center justify-end gap-2">
                                                        <!-- View Button -->
                                                        <a href="{{ route('frontend-user.show', $user->id) }}"
                                                            class="inline-flex items-center justify-center rounded-lg bg-brand-50 p-2 text-brand-500 hover:bg-brand-100 dark:bg-brand-500/10 dark:text-brand-400 dark:hover:bg-brand-500/20"
                                                            title="View User">
                                                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9 4.5C5.5 4.5 2.5 6.5 1 9C2.5 11.5 5.5 13.5 9 13.5C12.5 13.5 15.5 11.5 17 9C15.5 6.5 12.5 4.5 9 4.5ZM9 12C7.5 12 6.5 11 6.5 9.5C6.5 8 7.5 7 9 7C10.5 7 11.5 8 11.5 9.5C11.5 11 10.5 12 9 12Z"
                                                                    fill=""></path>
                                                            </svg>
                                                        </a>
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('frontend-user.edit', $user->id) }}"
                                                            class="inline-flex items-center justify-center rounded-lg bg-warning-50 p-2 text-warning-500 hover:bg-warning-100 dark:bg-warning-500/10 dark:text-warning-400 dark:hover:bg-warning-500/20"
                                                            title="Edit User">
                                                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M13.5 2.5L15.5 4.5L5 15H3V13L13.5 2.5ZM14.5 1.5L12.5 3.5L14.5 5.5L16.5 3.5L14.5 1.5Z"
                                                                    fill=""></path>
                                                            </svg>
                                                        </a>
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('frontend-user.destroy', $user->id) }}"
                                                            method="POST" class="inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center justify-center rounded-lg bg-error-50 p-2 text-error-500 hover:bg-error-100 dark:bg-error-500/10 dark:text-error-400 dark:hover:bg-error-500/20"
                                                                title="Delete User">
                                                                <svg class="fill-current" width="18" height="18"
                                                                    viewBox="0 0 18 18" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M6 2.5H12L13 3.5H16V5H2V3.5H5L6 2.5ZM3.5 6H14.5L14 15.5H4L3.5 6ZM6.5 8.5H8V13.5H6.5V8.5ZM10 8.5H11.5V13.5H10V8.5Z"
                                                                        fill=""></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="px-5 py-12 text-center">
                                                    <div class="mx-auto max-w-md">
                                                        <h4 class="mb-1 text-base font-medium text-gray-700 dark:text-gray-300">
                                                            No users found</h4>
                                                        <p class="text-sm text-gray-500 dark:text-gray-500">
                                                            Click the "Create New User" button to add your first frontend
                                                            user.
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- ====== Table End ====== -->

                        <!-- Pagination -->
                        @if ($frontendUsers->hasPages())
                            <div class="mt-6 border-t border-gray-100 pt-5 dark:border-gray-800">
                                {{ $frontendUsers->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SweetAlert2 JS for Delete Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, delete it!',
                        width: '380px',
                        padding: '1.25em',
                        customClass: {
                            title: 'text-lg font-semibold',
                            htmlContainer: 'text-sm',
                            actions: 'text-sm'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection