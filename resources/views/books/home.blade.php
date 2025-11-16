<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Browse Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-4 gap-6">
                <!-- Sidebar -->
                <div class="col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg sticky top-24 h-fit">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2h7a1 1 0 011 1v2h-2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V9H1V7h2V4z"></path></svg>
                                Filter by Tags
                            </h3>

                            <form method="GET" action="{{ route('home') }}" class="space-y-3" id="filterForm">
                                @if (request('q'))
                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                @endif

                                <!-- Clear Filters Button -->
                                @if (!empty($selectedTags))
                                    <a href="{{ route('home') }}" class="block w-full text-center px-4 py-2 bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 text-sm font-medium rounded-lg hover:bg-red-200 dark:hover:bg-red-900 transition-colors duration-200 mb-4">
                                        Clear All Filters
                                    </a>
                                @endif

                                <!-- Tags List -->
                                <div class="space-y-2 max-h-96 overflow-y-auto">
                                    @forelse ($allTags as $tag)
                                        <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer transition-colors duration-200">
                                            <input 
                                                type="checkbox" 
                                                name="tags[]" 
                                                value="{{ $tag }}"
                                                onchange="document.getElementById('filterForm').submit()"
                                                @if (in_array($tag, $selectedTags)) checked @endif
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 dark:border-gray-600 dark:bg-gray-700 dark:text-blue-400"
                                            >
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $tag }}</span>
                                        </label>
                                    @empty
                                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">No tags available</p>
                                    @endforelse
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-span-3">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-8 text-gray-900 dark:text-gray-100">
                            <!-- Active Filters Display -->
                            @if (!empty($selectedTags))
                                <div class="mb-6 flex flex-wrap gap-2">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Active filters:</span>
                                    @foreach ($selectedTags as $tag)
                                        <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-sm font-medium rounded-full">
                                            {{ $tag }}
                                            <a href="{{ route('home', ['q' => request('q')]) }}" onclick="document.querySelectorAll('input[value=\'{{ $tag }}\']')[0]?.click(); return false;" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </a>
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Books Grid/List -->
                            <div class="space-y-5">
                                @forelse ($books as $book)
                                    <x-book-detail-modal :book="$book">
                                        <!-- Desktop Card -->
                                        <div class="flex gap-6 p-6 w-full h-auto border border-gray-200 dark:border-gray-700 rounded-xl shadow-md hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-purple-900/20 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer bg-white dark:bg-gray-800 mb-24">
                                            <!-- Book Cover (Left) -->
                                            <div class="w-40 h-56 flex-shrink-0 overflow-hidden rounded-lg shadow-lg bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
                                                @if ($book->cover)
                                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-300 cursor-pointer">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm text-center px-2 font-medium">No cover</div>
                                                @endif
                                            </div>

                                            <!-- Book Info (Right) -->
                                            <div class="flex-1 flex flex-col justify-between w-full h-auto min-h-56">
                                                <div>
                                                    <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-1 line-clamp-2">{{ $book->title }}</h4>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 flex items-center gap-1">
                                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                                        <span class="truncate">{{ $book->author }}</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-500 mb-3 flex items-center gap-1">
                                                        <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h14m-14 4v8.5m0-8.5h14"></path></svg>
                                                        Added by <span class="font-semibold truncate">{{ $book->user->name ?? 'Unknown' }}</span>
                                                    </p>
                                                    
                                                    <!-- Meta Info -->
                                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-3 space-y-1">
                                                        <span class="block flex items-center gap-1">
                                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                            <span class="truncate">Published: {{ optional($book->published_at)->format('M j, Y') ?? 'Unknown' }}</span>
                                                        </span>
                                                        <span class="block flex items-center gap-1">
                                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            Added: {{ $book->created_at->format('M j, Y') }}
                                                        </span>
                                                    </div>

                                                    <!-- Tags -->
                                                    <div class="flex flex-wrap gap-2 mb-3">
                                                        @if ($book->genre)
                                                            @foreach (explode(',', $book->genre) as $tag)
                                                                <span class="inline-block px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/50 dark:to-blue-800/50 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full border border-blue-200 dark:border-blue-700/50 hover:shadow-md transition-shadow duration-200 cursor-pointer hover:bg-blue-200 dark:hover:bg-blue-800/50 truncate">{{ trim($tag) }}</span>
                                                            @endforeach
                                                        @else
                                                            <span class="inline-block px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-medium rounded-full">No tags</span>
                                                        @endif
                                                    </div>

                                                    <!-- Rating -->
                                                    <div class="flex items-center gap-2 mb-3">
                                                        <span class="text-lg">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <span class="inline-block transition-transform hover:scale-125 duration-200 {{ $i <= $book->rating ? 'text-yellow-400 drop-shadow-lg' : 'text-gray-300 dark:text-gray-600' }}">{{ $i <= $book->rating ? '★' : '☆' }}</span>
                                                            @endfor
                                                        </span>
                                                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">({{ $book->rating }}/5)</span>
                                                    </div>

                                                    <!-- Description (Truncated) -->
                                                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed line-clamp-3">{{ $book->description ?? 'No description provided' }}</p>
                                                </div>

                                                <!-- Actions (Bottom) - Wishlist only -->
                                                <div class="flex justify-center gap-3 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 w-full">
                                                    <form action="{{ route('wishlist.store') }}" method="POST" class="w-44" @click.stop>
                                                        @csrf
                                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 hover:brightness-110 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg hover:shadow-purple-500/50 transform hover:scale-105 transition-all duration-200 active:scale-95 whitespace-nowrap">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                                                            <span>{{ auth()->check() ? 'Wishlist' : 'Login' }}</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </x-book-detail-modal>
                        @empty
                            <div class="p-12 text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path></svg>
                                <p class="text-lg text-gray-500 dark:text-gray-400 font-medium">
                                    @if (!empty($selectedTags))
                                        No books found with the selected tags
                                    @else
                                        No books available yet
                                    @endif
                                </p>
                            </div>
                        @endforelse
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
