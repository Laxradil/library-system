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
                                Filter by Genre
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

                                <!-- Genre List (use mainGenres from controller) -->
                                <div class="space-y-2 max-h-96 overflow-y-auto">
                                    @if (!empty($mainGenres) && count($mainGenres))
                                        @foreach ($mainGenres as $tag)
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
                                        @endforeach
                                    @else
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
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-span-3">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-8 text-gray-900 dark:text-gray-100">
                                @if (session('success'))
                                    <div class="mb-4 p-3 rounded bg-green-50 dark:bg-green-900/30 border border-green-100 dark:border-green-800 text-green-800 dark:text-green-200 text-sm">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            <!-- Recently Released (approved only) -->
                            @if (!empty($recentBooks) && $recentBooks->count())
                                <div class="mb-6">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">Recently Released</h3>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                                        @foreach ($recentBooks as $book)
                                            <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-book-modal',{detail:{id:{{ $book->id }}}}))" class="text-left bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                                                @if ($book->cover)
                                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-36 object-cover">
                                                @else
                                                    <div class="w-full h-36 flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 text-gray-500 text-sm">No cover</div>
                                                @endif
                                                <div class="p-2">
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100 line-clamp-2">{{ $book->title }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $book->user->name ?? 'Unknown' }}</div>
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Browse by Genre -->
                            @if (!empty($genrePanels) && count($genrePanels))
                                <div class="mb-8">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">Browse by Genre</h3>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        @foreach ($genrePanels as $genre => $panelBooks)
                                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="font-semibold text-sm text-gray-900 dark:text-gray-100">{{ $genre }}</div>
                                                    <a href="{{ route('home', ['tags' => [$genre]]) }}" class="text-xs text-blue-600 hover:underline">View all</a>
                                                </div>

                                                <div class="grid grid-cols-3 gap-2">
                                                    @if ($panelBooks->count())
                                                        @foreach ($panelBooks as $gbook)
                                                            <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-book-modal',{detail:{id:{{ $gbook->id }}}}))" class="w-full h-20 overflow-hidden rounded">
                                                                @if ($gbook->cover)
                                                                    <img src="{{ asset('storage/' . $gbook->cover) }}" class="w-full h-full object-cover" alt="{{ $gbook->title }}">
                                                                @else
                                                                    <div class="w-full h-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-xs text-gray-500">No cover</div>
                                                                @endif
                                                            </button>
                                                        @endforeach
                                                    @else
                                                        <div class="col-span-3 w-full h-20 bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-xs text-gray-500">No featured books</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

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

                            <!-- Sort + Books Grid/List -->
                            <div class="mb-4 flex items-center justify-between">
                                <div>
                                    <!-- keep active filters here -->
                                </div>
                                <form method="GET" action="{{ route('home') }}" class="flex items-center gap-2">
                                    @if (request('q'))
                                        <input type="hidden" name="q" value="{{ request('q') }}">
                                    @endif
                                    @foreach (request('tags', []) as $t)
                                        <input type="hidden" name="tags[]" value="{{ $t }}">
                                    @endforeach
                                    <label class="text-sm text-gray-500 dark:text-gray-300">Sort:</label>
                                    <select name="sort" onchange="this.form.submit()" class="ms-2 px-2 py-1 rounded bg-white dark:bg-gray-700 border text-sm">
                                        <option value="latest" {{ request('sort') !== 'most_viewed' ? 'selected' : '' }}>Latest</option>
                                        <option value="most_viewed" {{ request('sort') === 'most_viewed' ? 'selected' : '' }}>Most Viewed</option>
                                    </select>
                                </form>
                            </div>

                            <div class="space-y-5">
                                @forelse ($books as $book)
                                    <x-book-card :book="$book" mode="browse" />
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
