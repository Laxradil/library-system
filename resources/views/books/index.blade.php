<x-app-layout>
    <x-slot name="header">
        <style>
            @keyframes floatHorizontal {
                0%, 100% {
                    transform: translateX(0) translateY(0) rotate(0deg);
                    opacity: 0.3;
                }
                25% {
                    transform: translateX(30px) translateY(-10px) rotate(5deg);
                    opacity: 0.5;
                }
                50% {
                    transform: translateX(60px) translateY(5px) rotate(-3deg);
                    opacity: 0.4;
                }
                75% {
                    transform: translateX(30px) translateY(-5px) rotate(3deg);
                    opacity: 0.5;
                }
            }
            .floating-book-anim {
                animation: floatHorizontal 12s ease-in-out infinite;
            }
            .floating-book-anim:hover {
                animation-play-state: paused;
                opacity: 0.8 !important;
                transform: scale(1.3) !important;
            }
        </style>
        <div class="flex items-center justify-between relative w-full">
            <!-- Floating Books Animation -->
            <div class="absolute inset-0 overflow-hidden pointer-events-auto">
                <div class="floating-book-anim absolute cursor-pointer transition-transform duration-300" style="left: 10%; top: 20%; animation-delay: 0s;">
                    <svg class="w-8 h-8 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book-anim absolute cursor-pointer transition-transform duration-300" style="left: 25%; top: 60%; animation-delay: 1.5s;">
                    <svg class="w-6 h-6 text-white/25" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book-anim absolute cursor-pointer transition-transform duration-300" style="left: 45%; top: 30%; animation-delay: 3s;">
                    <svg class="w-10 h-10 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book-anim absolute cursor-pointer transition-transform duration-300" style="left: 55%; top: 50%; animation-delay: 4.5s;">
                    <svg class="w-7 h-7 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <div class="relative z-10 flex-shrink-0 ml-4">
                <h2 class="text-3xl font-bold text-white drop-shadow-lg">
                    {{ __('Manage Books') }}
                </h2>
                <p class="mt-1 text-sm text-white/70">Manage your book collection and contributions</p>
            </div>
            
            <div class="flex-1"></div>
            
            @can('is-contributor')
            <a href="{{ route('books.create') }}" 
               class="relative z-10 flex-shrink-0 mr-8 inline-flex items-center gap-2 px-5 py-3 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl border border-white/30 transform hover:scale-105 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Book
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 animate-fadeIn">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-emerald-800 dark:text-emerald-200">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-900/50 rounded-xl">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $books->count() }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Books</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $books->where('approved', true)->count() }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Approved</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-amber-100 dark:bg-amber-900/50 rounded-xl">
                            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $books->where('approved', false)->count() }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Pending Review</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books List -->
            <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-2xl border border-gray-100 dark:border-gray-700/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700/50">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Your Book Collection
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse ($books as $book)
                            <div class="animate-fadeInUp" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                <x-book-card :book="$book" mode="manage" />
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full mb-6">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No books yet</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-6">Start building your collection by adding your first book</p>
                                @can('is-contributor')
                                <a href="{{ route('books.create') }}" 
                                   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Add Your First Book
                                </a>
                                @endcan
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>