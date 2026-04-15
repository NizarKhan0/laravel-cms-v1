@extends('backend-user.layouts.app')

@section('title', 'View Backend User')

@section('content')
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `View Backend User` }" class="mb-6">
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
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="{{ route('backend-user.index') }}">
                            List Backend Users
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
                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="px-5 py-4 sm:px-6 sm:py-5 border-b border-gray-100 dark:border-gray-800">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                        User Details
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Complete information about the backend user account.
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('backend-user.edit', $backendUsers->id) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-warning-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-warning-600">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M13.5 2.5L15.5 4.5L5 15H3V13L13.5 2.5ZM14.5 1.5L12.5 3.5L14.5 5.5L16.5 3.5L14.5 1.5Z"
                                                fill=""></path>
                                        </svg>
                                        Edit User
                                    </a>
                                    <a href="{{ route('backend-user.index') }}"
                                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9 2C4.5 2 1 5.5 1 9C1 12.5 4.5 16 9 16C13.5 16 17 12.5 17 9C17 5.5 13.5 2 9 2ZM9 14C6.5 14 4.5 12 4.5 9C4.5 6 6.5 4 9 4C11.5 4 13.5 6 13.5 9C13.5 12 11.5 14 9 14Z"
                                                fill=""></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9 6C7.5 6 6.5 7 6.5 8.5C6.5 10 7.5 11 9 11C10.5 11 11.5 10 11.5 8.5C11.5 7 10.5 6 9 6Z"
                                                fill=""></path>
                                        </svg>
                                        Back to List
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6 p-5 sm:p-6">
                            <!-- User Information Grid -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <!-- User ID -->
                                <div
                                    class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label
                                        class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        User ID
                                    </label>
                                    <p class="text-base font-semibold text-gray-800 dark:text-white/90">
                                        #{{ $backendUsers->id }}
                                    </p>
                                </div>

                                <!-- Email Address -->
                                <div
                                    class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label
                                        class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Email Address
                                    </label>
                                    <p class="text-base font-medium text-gray-800 dark:text-white/90">
                                        {{ $backendUsers->email }}
                                    </p>
                                </div>

                                <!-- Full Name -->
                                <div
                                    class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label
                                        class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Full Name
                                    </label>
                                    <p class="text-base font-medium text-gray-800 dark:text-white/90">
                                        {{ $backendUsers->first_name ? $backendUsers->first_name . ' ' . ($backendUsers->last_name ?? '') : ($backendUsers->last_name ?? '-') }}
                                    </p>
                                </div>

                                <!-- First Name -->
                                <div
                                    class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label
                                        class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        First Name
                                    </label>
                                    <p class="text-base text-gray-700 dark:text-gray-300">
                                        {{ $backendUsers->first_name ?: '-' }}
                                    </p>
                                </div>

                                <!-- Last Name -->
                                <div
                                    class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label
                                        class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Last Name
                                    </label>
                                    <p class="text-base text-gray-700 dark:text-gray-300">
                                        {{ $backendUsers->last_name ?: '-' }}
                                    </p>
                                </div>

                                <!-- Created At -->
                                <div
                                    class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label
                                        class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Created At
                                    </label>
                                    <p class="text-base text-gray-700 dark:text-gray-300">
                                        {{ $backendUsers->created_at ? $backendUsers->created_at->format('F j, Y, g:i A') : '-' }}
                                    </p>
                                    @if($backendUsers->created_at)
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                                            {{ $backendUsers->created_at->diffForHumans() }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Updated At -->
                                <div
                                    class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label
                                        class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Last Updated
                                    </label>
                                    <p class="text-base text-gray-700 dark:text-gray-300">
                                        {{ $backendUsers->updated_at ? $backendUsers->updated_at->format('F j, Y, g:i A') : '-' }}
                                    </p>
                                    @if($backendUsers->updated_at && $backendUsers->updated_at != $backendUsers->created_at)
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                                            {{ $backendUsers->updated_at->diffForHumans() }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Account Status Card -->
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-800/20">
                                <h4 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Account Information
                                </h4>
                                <div class="flex flex-wrap gap-4">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 dark:bg-green-500/20">
                                            <svg class="fill-green-600 dark:fill-green-400" width="16" height="16"
                                                viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9 2C4.5 2 1 5.5 1 9C1 12.5 4.5 16 9 16C13.5 16 17 12.5 17 9C17 5.5 13.5 2 9 2ZM9 14C6.5 14 4.5 12 4.5 9C4.5 6 6.5 4 9 4C11.5 4 13.5 6 13.5 9C13.5 12 11.5 14 9 14Z"
                                                    fill=""></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9 6C7.5 6 6.5 7 6.5 8.5C6.5 10 7.5 11 9 11C10.5 11 11.5 10 11.5 8.5C11.5 7 10.5 6 9 6Z"
                                                    fill=""></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Account Type</p>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">Backend User</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-500/20">
                                            <svg class="fill-blue-600 dark:fill-blue-400" width="16" height="16"
                                                viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9 2C5 2 2 5 2 9C2 13 5 16 9 16C13 16 16 13 16 9C16 5 13 2 9 2ZM9 4C7.5 4 6.5 5 6.5 6.5C6.5 8 7.5 9 9 9C10.5 9 11.5 8 11.5 6.5C11.5 5 10.5 4 9 4ZM9 14C7 14 5.5 12.5 4.5 10.5C4.5 8.5 6.5 7 9 7C11.5 7 13.5 8.5 13.5 10.5C12.5 12.5 11 14 9 14Z"
                                                    fill=""></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Status</p>
                                            <p class="text-sm font-medium text-green-600 dark:text-green-400">Active</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div
                            class="flex items-center justify-end gap-3 border-t border-gray-100 px-5 py-4 sm:px-6 dark:border-gray-800">
                            <form action="{{ route('backend-user.destroy', $backendUsers->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-lg border border-error-300 bg-white px-4 py-2.5 text-sm font-medium text-error-600 shadow-theme-xs hover:bg-error-50 dark:border-error-500/30 dark:bg-error-500/10 dark:text-error-400 dark:hover:bg-error-500/20"
                                    onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6 2.5H12L13 3.5H16V5H2V3.5H5L6 2.5ZM3.5 6H14.5L14 15.5H4L3.5 6ZM6.5 8.5H8V13.5H6.5V8.5ZM10 8.5H11.5V13.5H10V8.5Z"
                                            fill=""></path>
                                    </svg>
                                    Delete User
                                </button>
                            </form>
                            <a href="{{ route('backend-user.edit', $backendUsers->id) }}"
                                class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M13.5 2.5L15.5 4.5L5 15H3V13L13.5 2.5ZM14.5 1.5L12.5 3.5L14.5 5.5L16.5 3.5L14.5 1.5Z"
                                        fill=""></path>
                                </svg>
                                Edit User
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection