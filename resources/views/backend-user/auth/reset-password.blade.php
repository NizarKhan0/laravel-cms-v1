<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">

        <!-- ERROR BOX -->
        @if ($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                <div class="font-semibold mb-1">Something went wrong:</div>
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- SUCCESS (optional) -->
        @if (session('status'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- CARD -->
        <div class="bg-white shadow-xl rounded-xl border border-gray-200 p-8">

            <h2 class="text-2xl font-bold text-center mb-6">Reset Password</h2>

            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <!-- EMAIL -->
                <label class="text-sm font-medium">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $email) }}"
                       required
                       class="w-full border px-3 py-2 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                <!-- PASSWORD -->
                <label class="text-sm font-medium">New Password</label>
                <input type="password"
                       name="password"
                       required
                       class="w-full border px-3 py-2 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                <!-- CONFIRM PASSWORD -->
                <label class="text-sm font-medium">Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       required
                       class="w-full border px-3 py-2 rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                <button class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2 rounded-lg hover:opacity-90 transition">
                    Reset Password
                </button>

            </form>
        </div>

    </div>

</body>

</html>