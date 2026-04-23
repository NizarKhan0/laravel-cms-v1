<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased">
    @include('frontend-user.layouts.partials.header')
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>
</body>
</html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Dashboard</title>
</head>

<body class="bg-gray-100">

    <!-- Wrapper -->
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-900 text-white p-6 hidden md:block">
            <h2 class="text-2xl font-bold mb-8">My Dashboard</h2>

            <nav class="space-y-4">
                <a href="#" class="block hover:bg-indigo-700 p-3 rounded-lg">
                    Dashboard
                </a>

                <a href="#" class="block hover:bg-indigo-700 p-3 rounded-lg">
                    Profile
                </a>

                <a href="#" class="block hover:bg-indigo-700 p-3 rounded-lg">
                    Orders
                </a>

                <a href="#" class="block hover:bg-indigo-700 p-3 rounded-lg">
                    Settings
                </a>

                <a href="#" class="block hover:bg-red-600 p-3 rounded-lg">
                    Logout
                </a>
            </nav>
        </aside>


        <!-- Main Content -->
        <main class="flex-1 p-8">

            <!-- Welcome -->
            <div class="bg-white rounded-2xl shadow p-6 mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        Welcome Back, User 👋
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Here's your account overview today.
                    </p>
                </div>

                <button class="bg-indigo-600 text-white px-5 py-3 rounded-xl hover:bg-indigo-700">
                    Update Profile
                </button>
            </div>


            <!-- Stats -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="text-gray-500">Total Orders</h3>
                    <p class="text-4xl font-bold text-indigo-600 mt-3">24</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="text-gray-500">Pending Requests</h3>
                    <p class="text-4xl font-bold text-yellow-500 mt-3">5</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="text-gray-500">Completed</h3>
                    <p class="text-4xl font-bold text-green-500 mt-3">19</p>
                </div>

            </div>


            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow p-6 mb-8">
                <h2 class="text-xl font-bold mb-4">
                    Quick Actions
                </h2>

                <div class="grid md:grid-cols-4 gap-4">

                    <button class="bg-indigo-100 text-indigo-700 p-4 rounded-xl hover:bg-indigo-200">
                        New Request
                    </button>

                    <button class="bg-green-100 text-green-700 p-4 rounded-xl hover:bg-green-200">
                        View Reports
                    </button>

                    <button class="bg-yellow-100 text-yellow-700 p-4 rounded-xl hover:bg-yellow-200">
                        Notifications
                    </button>

                    <button class="bg-red-100 text-red-700 p-4 rounded-xl hover:bg-red-200">
                        Support
                    </button>

                </div>
            </div>


            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-xl font-bold mb-5">
                    Recent Activity
                </h2>

                <div class="space-y-4">

                    <div class="border-b pb-4">
                        <p class="font-medium">
                            Order #1001 submitted
                        </p>
                        <span class="text-sm text-gray-500">
                            2 hours ago
                        </span>
                    </div>

                    <div class="border-b pb-4">
                        <p class="font-medium">
                            Profile updated successfully
                        </p>
                        <span class="text-sm text-gray-500">
                            Yesterday
                        </span>
                    </div>

                    <div>
                        <p class="font-medium">
                            Request approved by admin
                        </p>
                        <span class="text-sm text-gray-500">
                            3 days ago
                        </span>
                    </div>

                </div>
            </div>

        </main>

    </div>

</body>

</html>
