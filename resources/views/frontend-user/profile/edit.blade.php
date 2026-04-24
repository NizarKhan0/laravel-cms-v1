@extends('frontend-user.layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-3xl border shadow-sm p-6 md:p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold">Edit Profile</h2>
                <p class="text-sm text-zinc-500 mt-1">Update your account information.</p>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1" for="username">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required
                        class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-1" for="first_name">First Name</label>
                        <input id="first_name" name="first_name" type="text"
                            value="{{ old('first_name', $user->first_name) }}" required
                            class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-1" for="last_name">Last Name</label>
                        <input id="last_name" name="last_name" type="text" value="{{ old('last_name', $user->last_name) }}"
                            class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1" for="password">New Password
                        (optional)</label>
                    <input id="password" name="password" type="password"
                        class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1" for="password_confirmation">Confirm New
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('user.dashboard') }}"
                        class="px-4 py-2.5 rounded-xl border border-zinc-300 text-zinc-700 hover:bg-zinc-50">
                        Back
                    </a>
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection