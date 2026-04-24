<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{--
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#09090b',
                        border: '#e4e4e7'
                    }
                }
            }
        }
    </script> --}}

    <title>Frontend - @yield('title')</title>

    <style>
        .fl-wrapper[data-position^=top-] {
            top: 85px !important;
            z-index: 999999 !important;
        }
    </style>

</head>

<body class="bg-slate-50 min-h-screen">

    <div x-data="{ sidebar:false, profile:false }" class="flex min-h-screen">

        <!-- Mobile Overlay -->
        <div x-show="sidebar" x-transition @click="sidebar=false" class="fixed inset-0 bg-black/40 z-30 lg:hidden">
        </div>

        <!-- SIDEBAR -->
        @include('frontend-user.layouts.partials.sidebar')

        <!-- MAIN -->
        <div class="flex-1">

            <!-- HEADER -->
            @include('frontend-user.layouts.partials.header')

            <main class="p-4 md:p-8">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>