<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between relative">
            <!-- Floating Books Animation -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="floating-book absolute" style="left: 15%; top: 25%; animation-delay: 0s;">
                    <svg class="w-7 h-7 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 35%; top: 55%; animation-delay: 2s;">
                    <svg class="w-5 h-5 text-white/15" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 60%; top: 30%; animation-delay: 4s;">
                    <svg class="w-9 h-9 text-white/10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 80%; top: 45%; animation-delay: 1s;">
                    <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 92%; top: 20%; animation-delay: 3s;">
                    <svg class="w-5 h-5 text-white/15" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white drop-shadow-lg flex items-center gap-3">
                    <span class="text-2xl">📚</span>
                    {{ __('Browse Books') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-4 gap-6">
                <!-- Sidebar -->
                <div class="col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl sticky top-24 h-fit animate-slide-in-left transition-all duration-300 hover:shadow-2xl">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2h7a1 1 0 011 1v2h-2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V9H1V7h2V4z"></path></svg>
                                </div>
                                Filter by Genre
                            </h3>

                            <form method="GET" action="{{ route('home') }}" class="space-y-3" id="filterForm">
                                @if (request('q'))
                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                @endif

                                <!-- Clear Filters Button -->
                                @if (!empty($selectedTags))
                                    <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95 mb-4">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Clear All Filters
                                    </a>
                                @endif

                                <!-- Genre List -->
                                <div class="space-y-2 min-h-[380px]">
                                    @if (!empty($mainGenres) && count($mainGenres))
                                        @foreach ($mainGenres as $index => $tag)
                                            <label class="group flex items-center gap-3 p-3 rounded-xl border-2 border-transparent hover:border-indigo-200 dark:hover:border-indigo-800 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 cursor-pointer transition-all duration-300 {{ in_array($tag, $selectedTags) ? 'bg-indigo-50 dark:bg-indigo-900/30 border-indigo-300 dark:border-indigo-700' : '' }}"
                                                   style="animation: fadeInUp 0.4s ease-out forwards; animation-delay: {{ 100 + ($index * 50) }}ms; opacity: 0;">
                                                <input 
                                                    type="checkbox" 
                                                    name="tags[]" 
                                                    value="{{ $tag }}"
                                                    onchange="document.getElementById('filterForm').submit()"
                                                    @if (in_array($tag, $selectedTags)) checked @endif
                                                    class="w-5 h-5 text-indigo-600 bg-gray-100 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 dark:border-gray-600 dark:bg-gray-700 cursor-pointer transition-transform duration-200 checked:scale-110"
                                                >
                                                <span class="text-sm text-gray-700 dark:text-gray-300 font-medium group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $tag }}</span>
                                            </label>
                                        @endforeach
                                    @else
                                        @forelse ($allTags as $index => $tag)
                                            <label class="group flex items-center gap-3 p-3 rounded-xl border-2 border-transparent hover:border-indigo-200 dark:hover:border-indigo-800 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 cursor-pointer transition-all duration-300 {{ in_array($tag, $selectedTags) ? 'bg-indigo-50 dark:bg-indigo-900/30 border-indigo-300 dark:border-indigo-700' : '' }}"
                                                   style="animation: fadeInUp 0.4s ease-out forwards; animation-delay: {{ 100 + ($index * 50) }}ms; opacity: 0;">
                                                <input 
                                                    type="checkbox" 
                                                    name="tags[]" 
                                                    value="{{ $tag }}"
                                                    onchange="document.getElementById('filterForm').submit()"
                                                    @if (in_array($tag, $selectedTags)) checked @endif
                                                    class="w-5 h-5 text-indigo-600 bg-gray-100 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 dark:border-gray-600 dark:bg-gray-700 cursor-pointer transition-transform duration-200 checked:scale-110"
                                                >
                                                <span class="text-sm text-gray-700 dark:text-gray-300 font-medium group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $tag }}</span>
                                            </label>
                                        @empty
                                            <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">No genres available</p>
                                        @endforelse
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-span-3">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl animate-fade-in-up">
                        <div class="p-8 text-gray-900 dark:text-gray-100">
                                @if (session('success'))
                                    <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800/50 text-green-800 dark:text-green-200 text-sm flex items-center gap-3 animate-fade-in-up">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        {{ session('success') }}
                                    </div>
                                @endif

                            <!-- Recently Released -->
                            @if (!empty($recentBooks) && $recentBooks->count())
                                <div class="mb-8 animate-fade-in-up" style="animation-delay: 100ms;">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-3">
                                        <span class="text-2xl">🆕</span>
                                        Recently Released
                                    </h3>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                                        @foreach ($recentBooks as $index => $book)
                                            <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-book-modal',{detail:{id:{{ $book->id }}}}))" 
                                                    class="group text-left bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 border-2 border-transparent hover:border-indigo-300 dark:hover:border-indigo-700"
                                                    style="animation: fadeInUp 0.5s ease-out forwards; animation-delay: {{ 150 + ($index * 75) }}ms; opacity: 0;">
                                                <div class="relative overflow-hidden">
                                                    @if ($book->cover)
                                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" loading="lazy" class="w-full h-36 object-cover group-hover:scale-110 transition-transform duration-500">
                                                    @else
                                                        <div class="w-full h-36 flex items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-800 text-gray-500 text-sm">
                                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                                        </div>
                                                    @endif
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                </div>
                                                <div class="p-3">
                                                    <div class="text-sm font-bold text-gray-900 dark:text-gray-100 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $book->title }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $book->author ?? 'Unknown' }}</div>
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="mb-8 p-10 text-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-2xl animate-fade-in-up">
                                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center animate-float">
                                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium">No recently released books yet.</p>
                                </div>
                            @endif

                            <!-- Browse by Genre -->
                            @if (!empty($genrePanels) && count($genrePanels))
                                <div class="mb-8 animate-fade-in-up" style="animation-delay: 200ms;">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-3">
                                        <span class="text-2xl">📖</span>
                                        Browse by Genre
                                    </h3>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        @foreach ($genrePanels as $index => $data)
                                            @php 
                                                $genre = is_array($data) ? ($data['genre'] ?? $index) : $index;
                                                $panelBooks = is_array($data) ? ($data['books'] ?? $data) : $data;
                                            @endphp
                                            @if (is_countable($panelBooks) && count($panelBooks))
                                                <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 p-4 border-2 border-transparent hover:border-indigo-200 dark:hover:border-indigo-800 hover:-translate-y-1"
                                                     style="animation: fadeInUp 0.5s ease-out forwards; animation-delay: {{ 250 + ($loop->index * 75) }}ms; opacity: 0;">
                                                    <div class="flex items-center justify-between mb-3">
                                                        <div class="font-bold text-sm text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $genre }}</div>
                                                    </div>

                                                    <div class="grid grid-cols-3 gap-2 mb-3">
                                                        @foreach ($panelBooks as $gbook)
                                                            <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-book-modal',{detail:{id:{{ $gbook->id }}}}))" class="w-full h-20 overflow-hidden rounded-lg hover:scale-110 transition-transform duration-300 shadow-md hover:shadow-lg">
                                                                @if ($gbook->cover)
                                                                    <img src="{{ asset('storage/' . $gbook->cover) }}" class="w-full h-full object-cover" alt="{{ $gbook->title }}" loading="lazy">
                                                                @else
                                                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-xs text-gray-500">📚</div>
                                                                @endif
                                                            </button>
                                                        @endforeach
                                                    </div>

                                                    <a href="{{ route('home', ['tags' => [$genre]]) }}" class="block w-full text-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-xs font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95">View all</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Active Filters Display -->
                            @if (!empty($selectedTags))
                                <div class="mb-6 flex flex-wrap items-center gap-3 p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl border border-indigo-200 dark:border-indigo-800/50 animate-fade-in-up">
                                    <span class="text-sm font-semibold text-indigo-800 dark:text-indigo-300">Active filters:</span>
                                    @foreach ($selectedTags as $tag)
                                        <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-sm font-semibold rounded-full shadow-lg">
                                            {{ $tag }}
                                            <a href="{{ route('home', ['q' => request('q')]) }}" onclick="document.querySelectorAll('input[value=\'{{ $tag }}\']')[0]?.click(); return false;" class="hover:bg-white/20 rounded-full p-0.5 transition-colors">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </a>
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Sort + Books Grid/List -->
                            <div class="mb-6 flex items-center justify-between animate-fade-in-up" style="animation-delay: 300ms;">
                                <div>
                                    <!-- keep active filters here -->
                                </div>
                                <form method="GET" action="{{ route('home') }}" class="flex items-center gap-3">
                                    @if (request('q'))
                                        <input type="hidden" name="q" value="{{ request('q') }}">
                                    @endif
                                    @foreach (request('tags', []) as $t)
                                        <input type="hidden" name="tags[]" value="{{ $t }}">
                                    @endforeach
                                    <label class="text-sm font-medium text-gray-600 dark:text-gray-300">Sort:</label>
                                    <div class="flex items-center gap-2">
                                        <select id="sort-select" name="sort" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 text-sm font-medium hover:border-indigo-400 dark:hover:border-indigo-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 cursor-pointer">
                                            <option value="latest" {{ !request('sort') || request('sort') === 'latest' ? 'selected' : '' }}>🕐 Latest</option>
                                            <option value="alpha" {{ request('sort') === 'alpha' ? 'selected' : '' }}>🔤 Alphabetical</option>
                                            <option value="most_viewed" {{ request('sort') === 'most_viewed' ? 'selected' : '' }}>👁️ Most Viewed</option>
                                            <option value="highest_rated" {{ request('sort') === 'highest_rated' ? 'selected' : '' }}>⭐ Highest Rated</option>
                                            <option value="top_rated" {{ request('sort') === 'top_rated' ? 'selected' : '' }}>🏆 Top Rated</option>
                                            <option value="most_popular" {{ request('sort') === 'most_popular' ? 'selected' : '' }}>🔥 Most Popular</option>
                                        </select>
                                        <div class="relative group">
                                            <svg id="sort-help-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 cursor-help transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10A8 8 0 11-2 10a8 8 0 0120 0zM9 7a1 1 0 112 0 1 1 0 01-2 0zm.25 2.5a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0V10.25a.75.75 0 00-.75-.75z" clip-rule="evenodd"/></svg>
                                            <div id="sort-help" class="absolute hidden group-hover:block bg-gray-900 dark:bg-gray-950 text-white text-xs p-3 rounded-xl shadow-2xl whitespace-nowrap z-10 -right-2 top-8 w-max border border-gray-700">Sort by most recent by default.</div>
                                        </div>
                                    </div>
                                    <script>
                                        (function(){
                                            const help = document.getElementById('sort-help');
                                            const select = document.getElementById('sort-select');
                                            const descriptions = {
                                                latest: 'Sorts by newest books first (default).',
                                                alpha: 'Alphabetical by title (A → Z).',
                                                most_viewed: 'Books with the highest view counts first.',
                                                highest_rated: 'Books sorted by rating (stars) descending.',
                                                top_rated: 'Books sorted by rating, with views as tiebreaker.',
                                                most_popular: 'Popularity = views + (wishlist × 10).'
                                            };
                                            function update(){
                                                const v = select.value || 'latest';
                                                help.textContent = descriptions[v] || 'Sort by most recent by default.';
                                            }
                                            select.addEventListener('change', update);
                                            update();
                                        })();
                                    </script>
                                </form>
                            </div>

                            <div class="space-y-5">
                                @forelse ($books as $index => $book)
                                    <div style="animation: fadeInUp 0.5s ease-out forwards; animation-delay: {{ 350 + ($index * 50) }}ms; opacity: 0;">
                                        <x-book-card :book="$book" mode="browse" />
                                    </div>
                        @empty
                            <div class="p-16 text-center animate-fade-in-up">
                                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center animate-float">
                                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                                    @if (!empty($selectedTags))
                                        No books found
                                    @else
                                        No books available yet
                                    @endif
                                </h3>
                                <p class="text-gray-500 dark:text-gray-400">
                                    @if (!empty($selectedTags))
                                        Try adjusting your filters or browse all books
                                    @else
                                        Check back soon for new additions!
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
