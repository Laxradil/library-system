<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LibraryHub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-950 dark:via-slate-900 dark:to-indigo-950">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="relative overflow-hidden">
                    <!-- Decorative background -->
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 opacity-90"></div>
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
                    
                    <div class="relative max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            <div class="animate-fade-in-up flex-1">
                                {{ $header }}
                            </div>
                            <!-- Decorative element -->
                            <div class="hidden lg:flex items-center gap-3 text-white/60 ml-8">
                                <div class="w-2 h-2 rounded-full bg-white/40 animate-pulse"></div>
                                <div class="w-2 h-2 rounded-full bg-white/60 animate-pulse delay-100"></div>
                                <div class="w-2 h-2 rounded-full bg-white/80 animate-pulse delay-200"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Curved bottom edge -->
                    <div class="absolute bottom-0 left-0 right-0 h-4 bg-gradient-to-b from-transparent to-slate-50 dark:to-gray-950"></div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="relative">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="relative mt-20 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-indigo-900 to-slate-900"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.03\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
                
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Brand -->
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <span class="text-xl font-bold text-white">LibraryHub</span>
                            </div>
                            <p class="text-gray-400 text-sm max-w-md">
                                Your gateway to endless knowledge. Discover, explore, and manage your favorite books in one beautiful place.
                            </p>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Browse Books</a></li>
                                @auth
                                    <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition-colors">Dashboard</a></li>
                                    <li><a href="{{ route('wishlist.index') }}" class="text-gray-400 hover:text-white transition-colors">My Wishlist</a></li>
                                @endauth
                            </ul>
                        </div>

                        <!-- Account -->
                        <div>
                            <h4 class="text-white font-semibold mb-4">Account</h4>
                            <ul class="space-y-2 text-sm">
                                @guest
                                    <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Sign In</a></li>
                                    <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Create Account</a></li>
                                @else
                                    <li><a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-white transition-colors">Profile Settings</a></li>
                                @endguest
                            </ul>
                        </div>
                    </div>

                    <div class="border-t border-white/10 mt-8 pt-8 flex flex-col md:flex-row items-start justify-between">
                        <div class="flex flex-col gap-1">
                            <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} <span class="font-semibold text-white">LibraryHub</span></p>
                            <p class="text-gray-500 text-xs">Made by <span class="text-gray-400">Fhilip Briones</span> & <span class="text-purple-400 font-medium">Kietz Matamorosa</span></p>
                        </div>
                        <div class="flex items-center gap-4 mt-4 md:mt-0">
                            <span class="text-gray-600 text-xs">Built with Laravel</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        @include('components.book-detail-portal')
    </body>
</html>
