<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forgot Password - {{ config('app.name') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white shadow-xl rounded-xl border border-gray-200 p-8">

        <h2 class="text-2xl font-bold text-center mb-2">Forgot Password</h2>
        <p class="text-sm text-gray-600 text-center mb-6">
            Enter your email to receive a password reset link
        </p>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm bg-green-50 border border-green-200 p-3 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf

            <label class="text-sm font-medium text-gray-700">Email</label>

            <input type="email" name="email" required
                class="w-full mt-1 mb-4 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">

            <button
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2 rounded-lg hover:scale-[1.02] transition">
                Send Reset Link
            </button>

        </form>

        <div class="text-center mt-4">
            <a href="{{ route('admin.login') }}" class="text-indigo-600 text-sm hover:underline">
                Back to Login
            </a>
        </div>

    </div>

</body>

</html>
