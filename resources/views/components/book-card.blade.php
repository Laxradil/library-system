@props(['book', 'mode' => 'browse'])

<div class="group relative bg-white dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl border border-gray-100 dark:border-gray-700/50 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden">
    <!-- Hover Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 via-transparent to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
    
    <div class="relative flex items-start gap-5 p-5">
        <!-- Cover -->
        <div class="relative w-36 h-52 flex-shrink-0 overflow-hidden rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 to-purple-600/20 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            @if ($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" 
                     class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 flex flex-col items-center justify-center">
                    <svg class="w-12 h-12 text-indigo-300 dark:text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="text-xs text-indigo-400 dark:text-indigo-500 font-medium">No Cover</span>
                </div>
            @endif
            
            <!-- Rating Badge -->
            @if($book->rating)
            <div class="absolute top-2 right-2 z-20 flex items-center gap-1 px-2 py-1 bg-black/60 backdrop-blur-sm rounded-lg">
                <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="text-xs font-semibold text-white">{{ $book->rating }}</span>
            </div>
            @endif
        </div>

        <!-- Content -->
        <div class="flex-1 flex flex-col min-h-[200px]">
            <!-- Header -->
            <div class="mb-3">
                <div class="flex items-start justify-between gap-3">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white leading-tight line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">
                        {{ $book->title }}
                    </h4>
                    <div class="flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 dark:bg-gray-700/50 rounded-full shrink-0">
                        <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span id="book-views-{{ $book->id }}" data-book-views="{{ $book->id }}" class="text-xs font-semibold text-gray-600 dark:text-gray-300">{{ number_format($book->views ?? 0) }}</span>
                    </div>
                </div>
                
                <p class="mt-1.5 text-sm text-gray-600 dark:text-gray-400 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="font-medium">{{ $book->author }}</span>
                </p>
            </div>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 dark:text-gray-400 mb-3">
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ optional($book->published_at)->format('M Y') ?? 'Unknown' }}
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Added {{ $book->created_at->diffForHumans() }}
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    by {{ $book->user->name ?? 'Unknown' }}
                </span>
            </div>

            <!-- Tags -->
            <div class="flex flex-wrap gap-1.5 mb-3">
                @if ($book->genre)
                    @foreach (array_slice(explode(',', $book->genre), 0, 3) as $tag)
                        <span class="inline-flex items-center px-2.5 py-0.5 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/30 text-indigo-700 dark:text-indigo-300 text-xs font-medium rounded-full border border-indigo-100 dark:border-indigo-800/50">
                            {{ trim($tag) }}
                        </span>
                    @endforeach
                    @if(count(explode(',', $book->genre)) > 3)
                        <span class="inline-flex items-center px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs rounded-full">
                            +{{ count(explode(',', $book->genre)) - 3 }}
                        </span>
                    @endif
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs font-medium rounded-full">
                        No genre
                    </span>
                @endif
            </div>

            <!-- Description -->
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed line-clamp-2 mb-4 flex-grow">
                {{ $book->description ?? 'No description provided for this book.' }}
            </p>

            <!-- Actions -->
            <div class="flex flex-wrap items-center gap-2 pt-3 border-t border-gray-100 dark:border-gray-700/50">
                <button type="button" 
                        onclick="window.dispatchEvent(new CustomEvent('open-book-modal',{detail:{id:{{ $book->id }}}}))" 
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View
                </button>

                {{-- Admin approval badge / action --}}
                @can('is-admin')
                    @if ($book->approved)
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-medium rounded-lg">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Approved
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-medium rounded-lg">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                            Pending
                        </span>
                    @endif
                    <form action="{{ route('admin.books.approve', $book) }}" method="POST" class="ml-auto">
                        @csrf
                        <input type="hidden" name="approved" value="{{ $book->approved ? 0 : 1 }}">
                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 {{ $book->approved ? 'bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300' : 'bg-emerald-600 hover:bg-emerald-700 text-white' }} text-xs font-medium rounded-xl transition-colors duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $book->approved ? 'M6 18L18 6M6 6l12 12' : 'M5 13l4 4L19 7' }}"/>
                            </svg>
                            {{ $book->approved ? 'Unapprove' : 'Approve' }}
                        </button>
                    </form>
                @endcan

                @if ($mode === 'manage')
                    @can('is-contributor')
                        @if ($book->approved)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-medium rounded-lg">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Approved
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-medium rounded-lg">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                Pending
                            </span>
                        @endif
                        <div class="flex items-center gap-2 ml-auto">
                            <a href="{{ route('books.edit', $book) }}" 
                               class="inline-flex items-center gap-1.5 px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-xl transition-colors duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center gap-1.5 px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-xl transition-colors duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                @endif

                @if ($mode === 'browse')
                    @can('is-viewer')
                        <form action="{{ route('wishlist.store') }}" method="POST" class="ml-auto">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" 
                                    class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white text-sm font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-300 group/btn">
                                <svg class="w-4 h-4 transition-transform group-hover/btn:scale-110" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                                Wishlist
                            </button>
                        </form>
                    @endcan
                @endif
            </div>
        </div>
    </div>
</div>
