<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontend User Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8 border border-gray-200">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold">
                Frontend User Registration
            </h2>
            <p class="text-sm text-gray-600">
                Create your account to access dashboard
            </p>
        </div>

        <form method="POST" action="{{ route('user.register.submit') }}">
            @csrf

            {{-- Username --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Username
                </label>

                <input type="text" name="username" value="{{ old('username') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2.5 focus:ring-2 focus:ring-indigo-500">

                @error('username')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>


            {{-- First Name --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    First Name
                </label>

                <input type="text" name="first_name" value="{{ old('first_name') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2.5 focus:ring-2 focus:ring-indigo-500">

                @error('first_name')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>


            {{-- Last Name --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Last Name
                </label>

                <input type="text" name="last_name" value="{{ old('last_name') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2.5 focus:ring-2 focus:ring-indigo-500">

                @error('last_name')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>


            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>

                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2.5 focus:ring-2 focus:ring-indigo-500">

                @error('email')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>


            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>

                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded px-3 py-2.5 focus:ring-2 focus:ring-indigo-500">

                @error('password')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>


            {{-- Confirm Password --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Confirm Password
                </label>

                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 rounded px-3 py-2.5 focus:ring-2 focus:ring-indigo-500">
            </div>


            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2.5 rounded-lg hover:opacity-90 transition">
                Register
            </button>

        </form>

        <div class="mt-4 text-sm text-center text-gray-600">
            Already have an account?
            <a href="{{ route('user.login') }}" class="text-indigo-600 hover:underline">
                Login
            </a>
        </div>

    </div>

</body>

</html>