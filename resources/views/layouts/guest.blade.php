<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="auth-container min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Animated background particles -->
            <div class="particles">
                <div class="particle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
                <div class="particle" style="left: 20%; top: 60%; animation-delay: 1s;"></div>
                <div class="particle" style="left: 70%; top: 30%; animation-delay: 2s;"></div>
                <div class="particle" style="left: 80%; top: 70%; animation-delay: 3s;"></div>
                <div class="particle" style="left: 50%; top: 10%; animation-delay: 4s;"></div>
                <div class="particle" style="left: 30%; top: 80%; animation-delay: 5s;"></div>
                <div class="particle" style="left: 90%; top: 50%; animation-delay: 6s;"></div>
                <div class="particle" style="left: 5%; top: 40%; animation-delay: 7s;"></div>
            </div>

            <!-- Logo -->
            <div class="relative z-10 animate-fade-in-down">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl shadow-lg group-hover:shadow-xl group-hover:shadow-blue-500/30 transition-all duration-300 group-hover:-translate-y-1">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-white hidden sm:block">Library System</span>
                </a>
            </div>

            <!-- Auth Card -->
            <div class="w-full sm:max-w-md mt-8 px-8 py-10 relative z-10 auth-card rounded-3xl">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <p class="mt-8 text-gray-400 text-sm relative z-10 animate-fade-in delay-500 stagger-item" style="animation-fill-mode: forwards; animation-delay: 0.8s;">
                &copy; {{ date('Y') }} Library System. All rights reserved.
            </p>
        </div>
    </body>
</html>
