<aside :class="sidebar ? 'translate-x-0' : '-translate-x-full'" class="fixed lg:sticky lg:top-0 z-40
w-72
min-h-screen
self-stretch
bg-white
border-r border-zinc-200
transform transition-all duration-300
lg:translate-x-0">

    <div class="p-6 border-b">

        <h2 class="text-2xl font-bold">
            User Panel
        </h2>

        <p class="text-sm text-zinc-500 mt-1">
            Welcome back, Nizar
        </p>

    </div>

    <nav class="p-4 space-y-2">

        <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-black text-white shadow-sm">

            <i class="fa-solid fa-table-cells-large text-lg"></i>

            Dashboard

        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-zinc-100 transition">

            <i class="fa-regular fa-file-lines text-lg"></i>

            Module

        </a>

    </nav>

</aside>