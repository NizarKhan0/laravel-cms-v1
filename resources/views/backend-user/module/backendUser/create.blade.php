@extends('backend-user.layouts.app')

@section('title', 'Create Backend User')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<!-- Breadcrumb Start -->
<div x-data="{ pageName: `Create Backend Users` }" class="mb-6">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

        <nav>
            <ol class="flex items-center gap-1.5">
                <li>
                    <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                        href="{{ route('admin.dashboard') }}">
                        Home
                        <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none">
                            <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                                stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
                <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="space-y-6">

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

        <div class="px-5 py-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Fill in the information below to create a new backend user account.
            </p>
        </div>

        <form action="{{ route('backend-user.store') }}" method="POST">
            @csrf

            <div class="space-y-6 border-t border-gray-100 p-6 dark:border-gray-800">

                <!-- USERNAME -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1.5">
                        Username *
                    </label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        placeholder="johndoe"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 @error('username') border-red-500 @enderror">

                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1.5">
                        Email Address *
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="example@domain.com"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 @error('email') border-red-500 @enderror">

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1.5">
                        Password *
                    </label>

                    <div x-data="{ show: false }" class="relative">
                        <input :type="show ? 'text' : 'password'" name="password"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-10 text-sm dark:border-gray-700 dark:bg-gray-900 @error('password') border-red-500 @enderror">

                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-2.5 text-gray-500">
                            👁
                        </button>
                    </div>

                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- FIRST NAME -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1.5">
                        First Name
                    </label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900">
                </div>

                <!-- LAST NAME -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1.5">
                        Last Name
                    </label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900">
                </div>

                <!-- ROLES -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1.5">
                        Roles
                    </label>
                    <select name="roles[]" multiple
                        class="js-role-select w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 @error('roles') border-red-500 @enderror @error('roles.*') border-red-500 @enderror">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(in_array($role->name, old('roles', []), true))>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                        Hold Ctrl (Windows) / Command (Mac) to choose multiple roles.
                    </p>
                    @error('roles')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @error('roles.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 🔥 NEW FIELD: EMAIL VERIFICATION TOGGLE -->
                <div class="flex items-start gap-3 pt-2">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="send_verification_email" class="mr-2">
                            Send email verification
                        </label>

                        <p class="text-xs text-gray-500 dark:text-gray-500">
                            User will receive an email to verify their account.
                        </p>
                    </div>

                </div>

            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end gap-3 border-t border-gray-100 px-6 py-4 dark:border-gray-800">

                <a href="{{ route('backend-user.index') }}"
                    class="rounded-lg border px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-lg bg-brand-500 px-4 py-2 text-sm text-white hover:bg-brand-600">
                    Create User
                </button>

            </div>

        </form>

    </div>
</div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const $roleSelect = $('.js-role-select');

            if ($roleSelect.length) {
                $roleSelect.select2({
                    width: '100%',
                    placeholder: 'Select roles',
                    closeOnSelect: false
                });
            }
        });
    </script>
@endpush