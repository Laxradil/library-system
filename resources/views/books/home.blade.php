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
