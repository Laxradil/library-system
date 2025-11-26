@props(['book'])

<div x-data="{ open: false }" @keydown.escape="open = false" x-init="$watch('open', value => {
        // lock background scroll when modal is open
        if (value) {
            document.documentElement.classList.add('overflow-hidden');
        } else {
            document.documentElement.classList.remove('overflow-hidden');
        }

        if (value) {
            // Call the show endpoint to increment views and fetch latest book data (returns JSON when Accept: application/json)
            fetch('{{ route('books.show', $book) }}', { headers: { 'Accept': 'application/json' } })
                .then(resp => resp.ok ? resp.json() : null)
                .then(data => {
                    if (!data) return;
                    // Update modal views display
                    const modEl = document.getElementById('modal-views-{{ $book->id }}');
                    if (modEl) modEl.textContent = new Intl.NumberFormat().format(data.views || 0);
                    // Update card views display if present
                    const cardEl = document.getElementById('book-views-{{ $book->id }}');
                    if (cardEl) cardEl.textContent = new Intl.NumberFormat().format(data.views || 0);
                }).catch(()=>{});
        }
    })" class="relative w-full">
    <!-- Trigger (accessible) -->
    <div @click="open = true" @keydown.enter="open = true" role="button" tabindex="0" class="cursor-pointer w-full text-left focus:outline-none">
        {{ $slot }}
    </div>

    <!-- Teleport modal to body so it overlays the whole page correctly -->
    <template x-teleport="body">
        <!-- Modal Backdrop + Content -->
        <div x-show="open" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center">
            <div class="absolute inset-0 bg-black/70 dark:bg-black/80 backdrop-blur-sm transition-opacity duration-300" @click="open = false"></div>

            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.stop
                 class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-6xl max-h-[88vh] overflow-hidden mx-4">
            <!-- Close button (absolute) -->
            <button @click="open = false" class="absolute right-6 top-6 z-50 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 bg-transparent p-2 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 max-h-[78vh] overflow-y-auto">
                <!-- Cover -->
                <div class="col-span-1 flex items-start md:items-stretch justify-center md:justify-start">
                    <div class="w-56 h-80 rounded-lg shadow-xl overflow-hidden ring-1 ring-black/5 dark:ring-white/5">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 text-gray-500 text-sm text-center">No cover</div>
                        @endif
                    </div>
                </div>

                <!-- Details -->
                <div class="col-span-2 space-y-4 pr-2">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $book->title }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">@ {{ $book->author }}</p>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/></svg>
                                <span class="font-medium">{{ number_format($book->rating) ?? '0' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <span id="modal-views-{{ $book->id }}" class="font-medium">{{ number_format($book->views ?? 0) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-300">
                        @if ($book->published_at)
                            <div class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> <span>Published: <strong class="font-medium text-gray-300 dark:text-gray-200">{{ $book->published_at->format('M j, Y') }}</strong></span></div>
                        @endif
                        <div class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h14m-14 4v8.5m0-8.5h14"></path></svg> <span>Added: <strong class="font-medium text-gray-300 dark:text-gray-200">{{ $book->created_at->format('M j, Y') }}</strong></span></div>
                        <div class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20l-6-6 1.414-1.414L10 17.172l4.586-4.586L16 14l-6 6z"></path></svg> <span>By: <strong class="font-medium text-gray-300 dark:text-gray-200">{{ $book->user->name ?? 'Unknown' }}</strong></span></div>
                    </div>

                    <div class="pt-3">
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $book->description ?? 'No description provided' }}</p>
                    </div>

                    <div class="mt-4">
                        @if ($book->genre)
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $book->genre) as $tag)
                                    <span class="inline-block px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/50 dark:to-blue-800/50 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full border border-blue-200 dark:border-blue-700/50">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center gap-3 justify-end">
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
    </div>
</div>
