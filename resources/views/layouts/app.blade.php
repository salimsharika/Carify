<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Carify') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Additional Meta -->
        <meta name="description" content="Carify - Your Ultimate Car Management Platform">
        <meta name="theme-color" content="#1E40AF">
    </head>
    <body class="font-sans antialiased h-full bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow-sm animate-fadeIn">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $header }}
                        </h1>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative animate-fadeIn" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative animate-fadeIn" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="animate-fadeIn">
                    {{ $slot ?? 'No content to display' }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 shadow-inner mt-auto">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                        {{ date('Y') }} Carify. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>

        <!-- Scripts for dynamic features -->
        <script>
            // Theme toggler
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
    </body>
</html>
