<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between relative">
            <!-- Floating Books Animation -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="floating-book absolute" style="left: 18%; top: 30%; animation-delay: 0s;">
                    <svg class="w-7 h-7 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 40%; top: 55%; animation-delay: 2s;">
                    <svg class="w-5 h-5 text-white/15" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 65%; top: 25%; animation-delay: 4s;">
                    <svg class="w-9 h-9 text-white/10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 85%; top: 45%; animation-delay: 1s;">
                    <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white drop-shadow-lg flex items-center gap-3">
                    <span class="text-2xl animate-float">💖</span>
                    {{ __('My Wishlist') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl animate-fade-in-up">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    
                    <!-- Wishlist Stats -->
                    @if($wishlist->count() > 0)
                    <div class="mb-8 p-4 bg-gradient-to-r from-pink-50 to-purple-50 dark:from-pink-900/20 dark:to-purple-900/20 rounded-xl border border-pink-200 dark:border-pink-800/30 animate-fade-in-up" style="animation-delay: 50ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $wishlist->count() }} {{ Str::plural('book', $wishlist->count()) }} in your wishlist</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Your saved favorites are waiting for you!</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="space-y-6">
                        @forelse ($wishlist as $index => $item)
                            <div class="flex gap-6 p-6 min-h-80 border-2 border-gray-100 dark:border-gray-700 rounded-2xl shadow-lg hover:shadow-2xl dark:hover:shadow-purple-900/20 transition-all duration-500 transform hover:-translate-y-2 hover:border-indigo-200 dark:hover:border-indigo-700 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900" 
                                 x-data="{ openModal: false }"
                                 style="animation: fadeInUp 0.6s ease-out forwards; animation-delay: {{ 100 + ($index * 100) }}ms; opacity: 0;">
                                
                                <!-- Book Cover (Left) -->
                                <div class="w-40 h-56 flex-shrink-0 overflow-hidden rounded-xl shadow-xl group relative">
                                    @if ($item->book->cover)
                                        <img src="{{ asset('storage/' . $item->book->cover) }}" alt="{{ $item->book->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-800 rounded-xl text-gray-500 text-sm text-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Book Info (Right) -->
                                <div class="flex-1 flex flex-col justify-between py-1">
                                    <div class="flex-1 flex flex-col">
                                        <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300">{{ $item->book->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                                <svg class="w-3.5 h-3.5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                            </span>
                                            <span class="font-medium">{{ $item->book->author }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500 mb-3 flex items-center gap-2">
                                            <span class="w-5 h-5 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h14m-14 4v8.5m0-8.5h14"></path></svg>
                                            </span>
                                            Added by <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $item->book->user->name ?? 'Unknown' }}</span>
                                        </p>

                                        <!-- Meta Info -->
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-4 flex flex-wrap gap-4">
                                            <span class="flex items-center gap-1.5 bg-gray-100 dark:bg-gray-700/50 px-3 py-1.5 rounded-full">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                Published: {{ optional($item->book->published_at)->format('M j, Y') ?? 'Unknown' }}
                                            </span>
                                            <span class="flex items-center gap-1.5 bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300 px-3 py-1.5 rounded-full">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                                Wishlisted: {{ $item->created_at->format('M j, Y') }}
                                            </span>
                                        </div>

                                        <!-- Genre Tags -->
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @if ($item->book->genre)
                                                @foreach (explode(',', $item->book->genre) as $tag)
                                                    <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-700 dark:text-indigo-300 text-xs font-semibold rounded-full border border-indigo-200 dark:border-indigo-700/50 hover:shadow-md hover:scale-105 transition-all duration-200">{{ trim($tag) }}</span>
                                                @endforeach
                                            @else
                                                <span class="inline-block px-3 py-1.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-medium rounded-full">No genre</span>
                                            @endif
                                        </div>

                                        <!-- Rating -->
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="flex items-center bg-yellow-50 dark:bg-yellow-900/20 px-3 py-1.5 rounded-full border border-yellow-200 dark:border-yellow-800/50">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span class="text-lg transition-transform hover:scale-125 duration-200 {{ $i <= $item->book->rating ? 'text-yellow-400 drop-shadow-lg' : 'text-gray-300 dark:text-gray-600' }}">{{ $i <= $item->book->rating ? '★' : '☆' }}</span>
                                                @endfor
                                            </div>
                                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">({{ $item->book->rating }}/5)</span>
                                        </div>

                                        <!-- Description -->
                                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed line-clamp-3">{{ $item->book->description ?? 'No description provided' }}</p>
                                    </div>

                                    <!-- Actions (Bottom Right) -->
                                    <div class="flex gap-3 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <button @click="openModal = true" type="button" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 active:scale-95">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>

                                <!-- Remove Modal -->
                                <div x-show="openModal" 
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                     style="display: none;" 
                                     class="fixed inset-0 flex items-center justify-center z-50">
                                    <div class="bg-black/60 backdrop-blur-sm absolute inset-0" @click="openModal = false"></div>
                                    <div x-show="openModal"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0 scale-90"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-90"
                                         class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 z-10 max-w-md w-full mx-4 border border-gray-200 dark:border-gray-700">
                                        <div class="flex items-center gap-4 mb-4">
                                            <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Remove from Wishlist?</h3>
                                        </div>
                                        <p class="mb-6 text-gray-600 dark:text-gray-400">Are you sure you want to remove "<span class="font-semibold text-gray-800 dark:text-gray-200">{{ $item->book->title }}</span>" from your wishlist?</p>
                                        <div class="flex justify-end gap-3">
                                            <button @click="openModal = false" type="button" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-300">Cancel</button>
                                            <form action="{{ route('wishlist.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-16 text-center animate-fade-in-up">
                                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-pink-100 to-purple-100 dark:from-pink-900/30 dark:to-purple-900/30 rounded-full flex items-center justify-center animate-float">
                                    <svg class="w-12 h-12 text-pink-400 dark:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Your wishlist is empty</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">Start exploring our collection and save your favorite books to read later!</p>
                                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    Browse Books
                                </a>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
