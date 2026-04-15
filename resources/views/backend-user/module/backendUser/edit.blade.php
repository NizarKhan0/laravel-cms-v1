@extends('backend-user.layouts.app')

@section('title', 'Edit Backend User')

@section('content')
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `Edit Backend User` }" class="mb-6">
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
                        <div class="px-5 py-4 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Edit User: {{ $backendUsers->email }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Update the information below to modify this backend user account.
                            </p>
                        </div>

                        <form action="{{ route('backend-user.update', $backendUsers->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                                <!-- Email Field -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Email Address <span class="text-error-500">*</span>
                                    </label>
                                    <input type="email" name="email" value="{{ old('email', $backendUsers->email) }}"
                                        placeholder="example@domain.com"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('email') border-error-300 @enderror">
                                    @error('email')
                                        <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Field (Optional on Edit) -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Password
                                        <span class="text-gray-400 text-xs font-normal">(Leave blank to keep current
                                            password)</span>
                                    </label>
                                    <div x-data="{ showPassword: false }" class="relative">
                                        <input :type="showPassword ? 'text' : 'password'" name="password"
                                            placeholder="Enter new password (optional)"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('password') border-error-300 @enderror">
                                        <span @click="showPassword = !showPassword"
                                            class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                            <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20"
                                                height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z">
                                                </path>
                                            </svg>
                                            <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20"
                                                height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-theme-xs text-gray-500 dark:text-gray-400 mt-1.5">
                                        Password must be at least 8 characters long. Leave blank to keep current password.
                                    </p>
                                    @error('password')
                                        <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- First Name Field -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        First Name
                                    </label>
                                    <input type="text" name="first_name"
                                        value="{{ old('first_name', $backendUsers->first_name) }}"
                                        placeholder="Enter first name"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('first_name') border-error-300 @enderror">
                                    @error('first_name')
                                        <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Last Name Field -->
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Last Name
                                    </label>
                                    <input type="text" name="last_name"
                                        value="{{ old('last_name', $backendUsers->last_name) }}"
                                        placeholder="Enter last name"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('last_name') border-error-300 @enderror">
                                    @error('last_name')
                                        <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Full Name Display -->
                                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800/50">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <span class="font-medium">Full Name Preview:</span>
                                        <span id="fullNamePreview">
                                            {{ old('first_name', $backendUsers->first_name) }}
                                            {{ old('last_name', $backendUsers->last_name) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div
                                class="flex items-center justify-end gap-3 border-t border-gray-100 px-5 py-4 sm:px-6 dark:border-gray-800">
                                <a href="{{ route('backend-user.index') }}"
                                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js for password toggle and full name preview -->
    <script>
        document.addEventListener('alpine:init', () => {
            // This is already handled by x-data in the password field
        });

        // Full name preview functionality
        const firstNameInput = document.querySelector('input[name="first_name"]');
        const lastNameInput = document.querySelector('input[name="last_name"]');
        const fullNamePreview = document.getElementById('fullNamePreview');

        function updateFullNamePreview() {
            const firstName = firstNameInput ? firstNameInput.value : '';
            const lastName = lastNameInput ? lastNameInput.value : '';
            fullNamePreview.textContent = (firstName + ' ' + lastName).trim() || '-';
        }

        if (firstNameInput && lastNameInput && fullNamePreview) {
            firstNameInput.addEventListener('input', updateFullNamePreview);
            lastNameInput.addEventListener('input', updateFullNamePreview);
        }
    </script>
@endsection