@extends('backend-user.layouts.app')

@section('title', 'View Frontend User')

@section('content')
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `View Frontend User` }" class="mb-6">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">
                            Home
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('frontend-user.index') }}">
                            List Frontend Users
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
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
                                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">User Details</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Complete information about the frontend user account.</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('frontend-user.edit', $frontendUsers->id) }}"
                                        class="inline-flex items-center gap-2 rounded-lg border border-warning-300 bg-white px-4 py-2.5 text-sm font-medium text-warning-600 shadow-theme-xs hover:bg-warning-50 dark:border-warning-500/30 dark:bg-warning-500/10 dark:text-warning-400 dark:hover:bg-warning-500/20">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 2.5L15.5 4.5L5 15H3V13L13.5 2.5ZM14.5 1.5L12.5 3.5L14.5 5.5L16.5 3.5L14.5 1.5Z" fill=""></path>
                                        </svg>
                                        Edit User
                                    </a>
                                    <form action="{{ route('frontend-user.destroy', $frontendUsers->id) }}" method="POST" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-2 rounded-lg border border-error-300 bg-white px-4 py-2.5 text-sm font-medium text-error-600 shadow-theme-xs hover:bg-error-50 dark:border-error-500/30 dark:bg-error-500/10 dark:text-error-400 dark:hover:bg-error-500/20">
                                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2.5H12L13 3.5H16V5H2V3.5H5L6 2.5ZM3.5 6H14.5L14 15.5H4L3.5 6ZM6.5 8.5H8V13.5H6.5V8.5ZM10 8.5H11.5V13.5H10V8.5Z" fill=""></path>
                                            </svg>
                                            Delete User
                                        </button>
                                    </form>
                                    <a href="{{ route('frontend-user.index') }}"
                                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                                        Back to List
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6 p-5 sm:p-6">
                            <!-- User Information Grid -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <!-- Email Address -->
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Email Address</label>
                                    <p class="text-base font-medium text-gray-800 dark:text-white/90">{{ $frontendUsers->email }}</p>
                                </div>
                                <!-- Username -->
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Username</label>
                                    <p class="text-base font-medium text-gray-800 dark:text-white/90">{{ $frontendUsers->username }}</p>
                                </div>
                                <!-- Full Name -->
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Full Name</label>
                                    <p class="text-base font-medium text-gray-800 dark:text-white/90">
                                        {{ $frontendUsers->first_name ? $frontendUsers->first_name . ' ' . ($frontendUsers->last_name ?? '') : ($frontendUsers->last_name ?? '-') }}
                                    </p>
                                </div>
                                <!-- First Name -->
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">First Name</label>
                                    <p class="text-base text-gray-700 dark:text-gray-300">{{ $frontendUsers->first_name ?: '-' }}</p>
                                </div>
                                <!-- Last Name -->
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Last Name</label>
                                    <p class="text-base text-gray-700 dark:text-gray-300">{{ $frontendUsers->last_name ?: '-' }}</p>
                                </div>
                                <!-- Created At -->
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Created At</label>
                                    <p class="text-base text-gray-700 dark:text-gray-300">
                                        {{ $frontendUsers->created_at ? $frontendUsers->created_at->format('F j, Y, g:i A') : '-' }}
                                    </p>
                                    @if($frontendUsers->created_at)
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $frontendUsers->created_at->diffForHumans() }}</p>
                                    @endif
                                </div>
                                <!-- Updated At -->
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/30">
                                    <label class="mb-2 block text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Last Updated</label>
                                    <p class="text-base text-gray-700 dark:text-gray-300">
                                        {{ $frontendUsers->updated_at ? $frontendUsers->updated_at->format('F j, Y, g:i A') : '-' }}
                                    </p>
                                    @if($frontendUsers->updated_at && $frontendUsers->updated_at != $frontendUsers->created_at)
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $frontendUsers->updated_at->diffForHumans() }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Account Status Card -->
                            <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-800/20">
                                <h4 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Account Information</h4>
                                <div class="flex flex-wrap gap-4">
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 dark:bg-green-500/20">
                                            <svg class="fill-green-600 dark:fill-green-400" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2C4.5 2 1 5.5 1 9C1 12.5 4.5 16 9 16C13.5 16 17 12.5 17 9C17 5.5 13.5 2 9 2Z" fill=""></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Account Type</p>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">Frontend User</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-500/20">
                                            <svg class="fill-blue-600 dark:fill-blue-400" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2C5 2 2 5 2 9C2 13 5 16 9 16C13 16 16 13 16 9C16 5 13 2 9 2Z" fill=""></path>
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
