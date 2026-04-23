@extends('backend-user.layouts.app')

@section('title', 'List Activity Logs')

@section('content')
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `List Activity Logs` }" class="mb-6">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="{{ route('admin.dashboard') }}">
                            Home
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5">
                <!-- Top Bar with Title -->
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        All Activity Logs
                    </h3>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.02]">
                    <div class="p-5">
                        <!-- ====== Table Start ====== -->
                        <div class="max-w-full overflow-x-auto">
                            <div class="min-w-[900px]">
                                <table class="w-full">
                                    <!-- Table Header -->
                                    <thead>
                                        <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    No
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    Performed By
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    Model Name
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    Action
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    IP Address
                                                </span>
                                            </th>
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    User Agent
                                                </span>
                                            </th>
                                            {{-- <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    URL
                                                </span>
                                            </th> --}}
                                            <th class="px-5 py-3 text-left">
                                                <span
                                                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                    Timestamp
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        @forelse($activities as $activity)
                                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                                <td class="px-5 py-4">
                                                    <span class="block text-sm font-medium text-gray-800 dark:text-white/90">
                                                        {{ $loop->iteration }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <div>
                                                        @php
                                                            $causer = $activity->causer;
                                                        @endphp

                                                        @if ($causer)
                                                            <span
                                                                class="block text-sm font-medium text-gray-800 dark:text-white/90">
                                                                {{ $causer->username ?? 'User #' . $causer->id }}
                                                            </span>

                                                            @if ($causer->email)
                                                                <span class="block text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ $causer->email }}
                                                                </span>
                                                            @endif
                                                        @elseif ($activity->causer_id)
                                                            <span
                                                                class="block text-sm font-medium text-gray-800 dark:text-white/90">
                                                                User #{{ $activity->causer_id }} (Deleted)
                                                            </span>
                                                        @else
                                                            <span
                                                                class="block text-sm font-medium text-gray-800 dark:text-white/90">
                                                                System/Automated
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">
                                                            {{ $activity->causer_type ?? 'System' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4">
                                                    @php
                                                        $event = $activity->event;

                                                        $badgeClass = match ($event) {
                                                            'created'
                                                            => 'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500',
                                                            'updated'
                                                            => 'bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400',
                                                            'deleted'
                                                            => 'bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500',
                                                            default
                                                            => 'bg-blue-light-50 text-blue-light-500 dark:bg-blue-light-500/15 dark:text-blue-light-500',
                                                        };
                                                    @endphp

                                                    <span
                                                        class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium {{ $badgeClass }}">
                                                        {{ ucfirst($event) }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span class="block text-sm font-mono text-gray-600 dark:text-gray-400">
                                                        {{ $activity->ip_address ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span
                                                        class="block text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs"
                                                        title="{{ $activity->user_agent ?? '' }}">
                                                        {{ $activity->user_agent ? Str::limit($activity->user_agent, 50) : '-' }}
                                                    </span>
                                                </td>
                                                {{-- <td class="px-5 py-4">
                                                    <span class="block text-sm font-mono text-gray-600 dark:text-gray-400">
                                                        {{ $activity->url ?? '-' }}
                                                    </span>
                                                </td> --}}
                                                <td class="px-5 py-4">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ $activity->created_at ? $activity->created_at->format('H:i') : '-' }}
                                                        </span>
                                                        <span class="text-xs text-gray-500 dark:text-gray-500">
                                                            {{ $activity->created_at ? $activity->created_at->format('d F Y') : '-' }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="px-5 py-12 text-center">
                                                    <div class="mx-auto max-w-md">
                                                        <div class="mb-3 flex justify-center">
                                                            <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <h4 class="mb-1 text-base font-medium text-gray-700 dark:text-gray-300">
                                                            No activity logs found
                                                        </h4>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                                            No activities have been logged yet.
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- ====== Table End ====== -->

                        <!-- Pagination -->
                        @if ($activities->hasPages())
                            <div class="mt-6 border-t border-gray-100 pt-5 dark:border-gray-800">
                                {{ $activities->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection