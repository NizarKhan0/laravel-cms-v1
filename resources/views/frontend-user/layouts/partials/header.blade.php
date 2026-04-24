<header class="sticky top-0 bg-white/90 backdrop-blur border-b z-20">

    <div class="flex justify-between items-center px-4 md:px-8 py-4">

        <div class="flex items-center gap-4">

            <!-- Mobile Menu -->
            <button @click="sidebar=true" class="lg:hidden p-2 rounded-xl border">

                <i class="fa-solid fa-bars text-lg"></i>

            </button>

        </div>

        <!-- Profile -->
        <div class="relative">

            <button @click="profile=!profile"
                class="flex items-center gap-3 border rounded-2xl px-4 py-2 shadow-sm hover:bg-zinc-50">

                <div class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center font-semibold">
                    N
                </div>

                <span class="hidden md:block">
                    Nizar
                </span>

            </button>

            <!-- Dropdown -->
            <div x-show="profile" @click.away="profile=false" x-transition
                class="absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-xl border p-2">

                <a href="{{ route('user.profile.edit') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl hover:bg-zinc-100">

                    <i class="fa-regular fa-user"></i>

                    Profile

                </a>

                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 rounded-xl text-red-500 hover:bg-red-50">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</header>