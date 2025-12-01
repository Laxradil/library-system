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
        <div x-show="open" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
            <!-- Backdrop with blur -->
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900/80 via-indigo-900/50 to-purple-900/80 backdrop-blur-md transition-opacity duration-300" @click="open = false"></div>

            <!-- Modal Container -->
            <div x-transition:enter="transition ease-out duration-400"
                 x-transition:enter-start="opacity-0 transform scale-90 translate-y-8"
                 x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.stop
                 class="relative bg-white dark:bg-gray-900 rounded-3xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden border border-gray-200/50 dark:border-gray-700/50">
                
                <!-- Decorative gradient header -->
                <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-br from-indigo-500/10 via-purple-500/10 to-pink-500/10 pointer-events-none"></div>

                <!-- Close button -->
                <button @click="open = false" 
                        class="absolute right-4 top-4 z-50 p-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Content -->
                <div class="relative grid grid-cols-1 lg:grid-cols-5 gap-0 max-h-[90vh] overflow-y-auto">
                    <!-- Cover Section -->
                    <div class="lg:col-span-2 p-6 lg:p-8 flex flex-col items-center lg:items-start justify-start bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800/50 dark:to-gray-900/50">
                        <div class="relative group">
                            <!-- Cover Image -->
                            <div class="w-56 lg:w-64 h-80 lg:h-96 rounded-2xl shadow-2xl overflow-hidden ring-1 ring-black/10 dark:ring-white/10 transform group-hover:scale-[1.02] transition-transform duration-300">
                                @if ($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50">
                                        <svg class="w-16 h-16 text-indigo-300 dark:text-indigo-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        <span class="text-sm text-indigo-400 dark:text-indigo-500 font-medium">No Cover</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Floating Rating Badge -->
                            @if($book->rating)
                            <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 flex items-center gap-1.5 px-4 py-2 bg-white dark:bg-gray-800 rounded-full shadow-lg border border-gray-100 dark:border-gray-700">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                                <span class="ml-1 text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $book->rating }}/5</span>
                            </div>
                            @endif
                        </div>

                        <!-- Quick Stats -->
                        <div class="mt-8 w-full max-w-xs grid grid-cols-2 gap-3">
                            <div class="flex flex-col items-center p-4 bg-white dark:bg-gray-800/80 rounded-xl border border-gray-100 dark:border-gray-700/50">
                                <svg class="w-5 h-5 text-indigo-500 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span id="modal-views-{{ $book->id }}" class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($book->views ?? 0) }}</span>
                                <span class="text-xs text-gray-500">Views</span>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white dark:bg-gray-800/80 rounded-xl border border-gray-100 dark:border-gray-700/50">
                                <svg class="w-5 h-5 text-purple-500 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-lg font-bold text-gray-900 dark:text-white">{{ optional($book->published_at)->format('Y') ?? 'N/A' }}</span>
                                <span class="text-xs text-gray-500">Published</span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="lg:col-span-3 p-6 lg:p-8 space-y-6">
                        <!-- Title & Author -->
                        <div>
                            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white leading-tight mb-2">{{ $book->title }}</h2>
                            <p class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-lg font-medium">{{ $book->author }}</span>
                            </p>
                        </div>

                        <!-- Meta Info Cards -->
                        <div class="flex flex-wrap gap-3">
                            @if ($book->published_at)
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl text-sm">
                                <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-indigo-700 dark:text-indigo-300">{{ $book->published_at->format('F j, Y') }}</span>
                            </div>
                            @endif
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-50 dark:bg-purple-900/30 rounded-xl text-sm">
                                <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-purple-700 dark:text-purple-300">Added {{ $book->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-pink-50 dark:bg-pink-900/30 rounded-xl text-sm">
                                <svg class="w-4 h-4 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-pink-700 dark:text-pink-300">By {{ $book->user->name ?? 'Unknown' }}</span>
                            </div>
                        </div>

                        <!-- Genres -->
                        @if ($book->genre)
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Genres</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $book->genre) as $tag)
                                    <span class="inline-flex items-center px-4 py-1.5 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/40 dark:to-purple-900/40 text-indigo-700 dark:text-indigo-300 text-sm font-medium rounded-full border border-indigo-200/50 dark:border-indigo-700/50">
                                        {{ trim($tag) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Description -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Description</h3>
                            <div class="prose prose-sm dark:prose-invert max-w-none">
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $book->description ?? 'No description provided for this book.' }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-wrap items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            @auth
                                <form action="{{ route('wishlist.store') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" 
                                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                        </svg>
                                        Add to Wishlist
                                    </button>
                                </form>
                            @endauth
                            <button @click="open = false" 
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-semibold rounded-xl transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
