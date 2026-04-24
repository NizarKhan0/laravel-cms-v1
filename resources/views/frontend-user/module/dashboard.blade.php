@extends('frontend-user.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-3xl p-6 shadow-sm border">
            <div class="flex justify-between items-center">
                <p class="text-zinc-500 text-sm">
                    Total Reports
                </p>

                <div class="p-2 rounded-xl bg-zinc-100">
                    <i data-lucide="folder"></i>
                </div>
            </div>

            <h2 class="text-3xl font-bold mt-3">
                125
            </h2>

            <p class="text-green-600 text-sm mt-2">
                +12% this month
            </p>
        </div>



        <div class="bg-white rounded-3xl p-6 shadow-sm border">
            <div class="flex justify-between items-center">
                <p class="text-zinc-500 text-sm">
                    Pending Tasks
                </p>

                <div class="p-2 rounded-xl bg-zinc-100">
                    <i data-lucide="clock"></i>
                </div>
            </div>

            <h2 class="text-3xl font-bold mt-3">
                18
            </h2>

            <p class="text-yellow-500 text-sm mt-2">
                Need attention
            </p>

        </div>



        <div class="bg-white rounded-3xl p-6 shadow-sm border">
            <div class="flex justify-between items-center">
                <p class="text-zinc-500 text-sm">
                    Completed
                </p>

                <div class="p-2 rounded-xl bg-zinc-100">
                    <i data-lucide="check-circle"></i>
                </div>
            </div>

            <h2 class="text-3xl font-bold mt-3">
                97
            </h2>

            <p class="text-green-600 text-sm mt-2">
                On track
            </p>

        </div>



        <div class="bg-white rounded-3xl p-6 shadow-sm border">
            <div class="flex justify-between items-center">
                <p class="text-zinc-500 text-sm">
                    Notifications
                </p>

                <div class="p-2 rounded-xl bg-zinc-100">
                    <i data-lucide="bell-ring"></i>
                </div>
            </div>

            <h2 class="text-3xl font-bold mt-3">
                5
            </h2>

            <p class="text-blue-600 text-sm mt-2">
                Unread
            </p>

        </div>

    </div>

@endsection