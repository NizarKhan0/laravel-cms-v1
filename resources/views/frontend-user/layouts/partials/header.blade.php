<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="text-lg font-semibold">{{ config('app.name', 'Laravel') }}</div>
        <nav>
            <a href="{{ route('frontend.dashboard') }}" class="text-sm text-gray-700 mr-4">Dashboard</a>
            <a href="{{ route('frontend.login') }}" class="text-sm text-gray-700">Login</a>
        </nav>
    </div>
</header>
