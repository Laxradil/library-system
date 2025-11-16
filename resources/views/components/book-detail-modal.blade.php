@props(['book'])

<div x-data="{ open: false }" @keydown.escape="open = false" class="relative w-full">
    <!-- Trigger Button/Card Click -->
    <button @click="open = true" type="button" class="w-full text-left">
        {{ $slot }}
    </button>

    <!-- Modal Backdrop -->
    <div x-show="open" class="fixed inset-0 bg-black/50 dark:bg-black/70 z-40 transition-opacity duration-300" @click="open = false" style="display: none;"></div>

    <!-- Modal Content -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         @click.self="open = false"
         style="display: none;">
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700 sticky top-0 bg-white dark:bg-gray-800">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 line-clamp-2">{{ $book->title }}</h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6">
                <!-- Book Cover and Basic Info -->
                <div class="flex gap-6">
                    <!-- Cover -->
                    <div class="w-48 h-64 flex-shrink-0 overflow-hidden rounded-lg shadow-lg">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 text-gray-500 text-sm text-center">No cover</div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="flex-1 space-y-4">
                        <!-- Author -->
                        <div>
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Author</p>
                            <p class="text-lg text-gray-900 dark:text-gray-100 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                {{ $book->author }}
                            </p>
                        </div>

                        <!-- Rating -->
                        <div>
                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Rating</p>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="inline-block transition-transform hover:scale-125 duration-200 {{ $i <= $book->rating ? 'text-yellow-400 drop-shadow-lg' : 'text-gray-300 dark:text-gray-600' }}">{{ $i <= $book->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </span>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">({{ $book->rating }}/5)</span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div class="space-y-2">
                            @if ($book->published_at)
                                <div class="text-sm flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span><strong>Published:</strong> {{ $book->published_at->format('M j, Y') }}</span>
                                </div>
                            @endif
                            <div class="text-sm flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span><strong>Added:</strong> {{ $book->created_at->format('M j, Y') }}</span>
                            </div>
                            <div class="text-sm flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h14m-14 4v8.5m0-8.5h14"></path></svg>
                                <span><strong>By:</strong> {{ $book->user->name ?? 'Unknown' }}</span>
                            </div>
                        </div>

                        <!-- Tags -->
                        @if ($book->genre)
                            <div>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Tags</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach (explode(',', $book->genre) as $tag)
                                        <span class="inline-block px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/50 dark:to-blue-800/50 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full border border-blue-200 dark:border-blue-700/50">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Full Description -->
                <div>
                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-3">Description</p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $book->description ?? 'No description provided' }}</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                @auth
                    <form action="{{ route('wishlist.store') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 active:scale-95">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                            Add to Wishlist
                        </button>
                    </form>
                @endauth
                <button @click="open = false" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-semibold rounded-lg transition-all duration-200">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
