<!DOCTYPE html>
<html x-data="data" lang="en" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Digital Library', 'Digital Library') }} :: @yield('title', 'Dashboard')</title>

    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Scripts -->
    <script src="{{ asset('js/init-alpine.js') }}"></script>

    <!-- tinymce -->
    <script src="https://cdn.tiny.cloud/1/2oib8af25tz6ikzr6fqfks0mrncjqj8ybbl576d7emupo4nk/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .notification-container {
            position: absolute;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="flex h-screen static" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @include('layouts.navigation')
        <!-- Mobile sidebar -->
        <!-- Mobile sidebar and backdrop -->
        <div
            x-show="isSideMenuOpen"
            x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
            @click="closeSideMenu"
            ></div>

            @include('layouts.navigation-mobile')
        <div class="flex flex-col flex-1 w-full">
            @include('layouts.top-menu')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <div class="flex items-center my-6 space-x-5">
                        <button onclick="window.history.back()" class="bg-purple-600 w-8 h-10 rounded-l-lg flex justify-center items-center">
                            <i class="fa-solid fa-arrow-left text-xl text-white"></i>
                        </button>
                        @yield('header')
                    </div>
                    @yield('content')
                </div>
            </main>
            <footer class="bottom-0 w-full h-20 bg-purple-600/95 text-white">
                 <div class="mx-6 flex flex-col justify-center w-full h-full gap-1">
                    <p class="text-sm">© 2024 Digital Library. All rights reserved.</p>
                    <p class="text-xs">This project is an assignment for Detik.com, developed by Ammar Asysyakur.</p>
                </div>
            </footer>
        </div>
    </div>

    <div class="notification-container">
        <x-notify::notify />
    </div>

    {{-- Chart --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Ajax --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('script')
    @notifyJs
</body>
</html>
