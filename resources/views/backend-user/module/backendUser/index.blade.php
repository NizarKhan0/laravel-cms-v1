@extends('backend-user.layouts.app')

@section('title', 'List Backend Users')

@section('content')
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `List Backend Users` }" class="mb-6">
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
                        All Backend Users
                    </h3>
                    <a href="{{ route('backend-user.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9 2C9.41421 2 9.75 2.33579 9.75 2.75V8.25H15.25C15.6642 8.25 16 8.58579 16 9C16 9.41421 15.6642 9.75 15.25 9.75H9.75V15.25C9.75 15.6642 9.41421 16 9 16C8.58579 16 8.25 15.6642 8.25 15.25V9.75H2.75C2.33579 9.75 2 9.41421 2 9C2 8.58579 2.33579 8.25 2.75 8.25H8.25V2.75C8.25 2.33579 8.58579 2 9 2Z"
                                fill=""></path>
                        </svg>
                        Create New User
                    </a>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div
                        class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-500/20 dark:bg-green-500/10">
                        <div class="flex items-center gap-2">
                            <svg class="fill-green-500" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM13.7071 8.70711C14.0976 8.31658 14.0976 7.68342 13.7071 7.29289C13.3166 6.90237 12.6834 6.90237 12.2929 7.29289L9 10.5858L7.70711 9.29289C7.31658 8.90237 6.68342 8.90237 6.29289 9.29289C5.90237 9.68342 5.90237 10.3166 6.29289 10.7071L8.29289 12.7071C8.68342 13.0976 9.31658 13.0976 9.70711 12.7071L13.7071 8.70711Z"
                                    fill=""></path>
                            </svg>
                            <p class="text-sm text-green-700 dark:text-green-400">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

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
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    No
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    Email
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    Full Name
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    Created At
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-right">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    Actions
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        @forelse($backendUsers as $user)
                                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                                <td class="px-5 py-4">
                                                    <span class="block text-sm font-medium text-gray-800 dark:text-white/90">
                                                        {{ $loop->iteration }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span class="block text-sm text-gray-600 dark:text-gray-400">
                                                        {{ $user->email }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                        {{ $user->first_name ? $user->first_name . ' ' . ($user->last_name ?? '') : ($user->last_name ?? '-') }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span class="block text-sm text-gray-500 dark:text-gray-500">
                                                        {{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : '-' }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <div class="flex items-center justify-end gap-2">
                                                        <!-- View Button -->
                                                        <a href="{{ route('backend-user.show', $user->id) }}"
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
                                                        <a href="{{ route('backend-user.edit', $user->id) }}"
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
                                                        <form action="{{ route('backend-user.destroy', $user->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center justify-center rounded-lg bg-error-50 p-2 text-error-500 hover:bg-error-100 dark:bg-error-500/10 dark:text-error-400 dark:hover:bg-error-500/20"
                                                                onclick="return confirm('Are you sure you want to delete this user?')"
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
                                                <td colspan="5" class="px-5 py-12 text-center">
                                                    <div class="mx-auto max-w-md">
                                                        {{-- <div class="mb-4 flex justify-center">
                                                            <div class="rounded-full bg-gray-100 p-3 dark:bg-gray-800">
                                                                <svg class="h-8 w-8 text-gray-400 dark:text-gray-600"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="1.5"
                                                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                                </svg>
                                                            </div>
                                                        </div> --}}
                                                        <h4 class="mb-1 text-base font-medium text-gray-700 dark:text-gray-300">
                                                            No users found
                                                        </h4>
                                                        <p class="text-sm text-gray-500 dark:text-gray-500">
                                                            Click the "Create New User" button to add your first backend user.
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
                        @if($backendUsers->hasPages())
                            <div class="mt-6 border-t border-gray-100 pt-5 dark:border-gray-800">
                                {{ $backendUsers->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection