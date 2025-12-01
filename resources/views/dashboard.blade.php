<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between relative">
            <!-- Floating Books Animation -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="floating-book absolute" style="left: 20%; top: 30%; animation-delay: 0.5s;">
                    <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 45%; top: 50%; animation-delay: 2.5s;">
                    <svg class="w-8 h-8 text-white/15" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 70%; top: 25%; animation-delay: 1.5s;">
                    <svg class="w-5 h-5 text-white/10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 88%; top: 40%; animation-delay: 3.5s;">
                    <svg class="w-7 h-7 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white drop-shadow-lg flex items-center gap-3">
                    <span class="text-2xl">🏠</span>
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 overflow-hidden shadow-2xl sm:rounded-2xl mb-8 animate-fade-in-up">
                <div class="p-8 text-white relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <defs>
                                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                    <circle cx="1" cy="1" r="1" fill="white"/>
                                </pattern>
                            </defs>
                            <rect width="100" height="100" fill="url(#grid)"/>
                        </svg>
                    </div>
                    
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h3>
                            <p class="text-white/80 text-lg">Ready to explore amazing books today?</p>
                        </div>
                        <div class="hidden md:block text-8xl animate-float">📚</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('home') }}" class="group bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 100ms;">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Browse Books</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Explore our collection</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('wishlist.index') }}" class="group bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 150ms;">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-pink-600 dark:group-hover:text-pink-400 transition-colors">My Wishlist</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">View saved favorites</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="group bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 200ms;">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">My Profile</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your account</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- User Info Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl animate-fade-in-up" style="animation-delay: 250ms;">
                <div class="p-8">
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-xl">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                            <div class="mt-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold
                                    @if(Auth::user()->role === 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300
                                    @elseif(Auth::user()->role === 'contributor') bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                    @endif">
                                    @if(Auth::user()->role === 'admin')
                                        🛡️ Admin
                                    @elseif(Auth::user()->role === 'contributor')
                                        ✏️ Contributor
                                    @else
                                        👁️ Viewer
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Member since</p>
                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->created_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
