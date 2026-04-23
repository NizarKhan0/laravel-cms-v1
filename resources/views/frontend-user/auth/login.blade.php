<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Frontend User Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS CDN (quick styling) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8 border border-gray-200">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold">Frontend User Login</h2>
            <p class="text-sm text-gray-600">Sign in to access your dashboard</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 p-3 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.login.submit') }}">
            @csrf

            <div class="mb-4">
                <label for="login" class="block text-sm font-medium text-gray-700 mb-1">Email or Username</label>
                <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                    autocomplete="username"
                    class="block w-full border border-gray-300 rounded px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('login')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="block w-full border border-gray-300 rounded px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('password')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                {{-- @if (Route::has('frontend.password.request'))
                <a href="{{ route('frontend.password.request') }}"
                    class="text-sm text-indigo-600 hover:underline">Forgot password?</a>
                @endif --}}

                <a href="#" class="text-sm text-indigo-600 hover:underline">Forgot password?</a>

            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2 rounded-lg">Sign
                In</button>
        </form>

        <div class="mt-4 text-sm text-center text-gray-600">
            Don't have an account?
            <a href="{{ route('user.register') }}" class="text-indigo-600 hover:underline">Register</a>
        </div>
    </div>
</body>

</html>