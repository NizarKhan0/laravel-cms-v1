<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Email Verification</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white shadow-xl rounded-xl border border-gray-200 p-8 text-center">

        <h2 class="text-2xl font-bold mb-4">Verify Email</h2>

        <p class="text-gray-600 text-sm mb-6">
            Please verify your email address by clicking the link we just sent to you.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-green-600 bg-green-50 border border-green-200 p-3 rounded-lg">
                A new verification link has been sent to your email.
            </div>
        @endif

        <form method="POST" action="{{ route('admin.verification.send') }}">
            @csrf

            <button class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2 rounded-lg">
                Resend Verification Email
            </button>

        </form>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
            @csrf
            <button class="text-sm text-gray-500 hover:underline">
                Logout
            </button>
        </form>

    </div>

</body>

</html>