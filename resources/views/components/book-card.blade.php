@props(['book', 'mode' => 'browse'])

<div class="flex items-start gap-6 p-6 min-h-[220px] border border-gray-200 dark:border-gray-700 rounded-xl shadow-md hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-purple-900/20 transition-all duration-300 transform hover:-translate-y-1 bg-white dark:bg-gray-800">
    <!-- Cover -->
    <div class="w-40 h-56 flex-shrink-0 overflow-hidden rounded-lg shadow-lg bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
        @if ($book->cover)
            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="block w-full h-full object-cover object-center">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm text-center">No cover</div>
        @endif
    </div>

    <!-- Content -->
    <div class="flex-1 flex flex-col justify-between w-full h-auto">
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
                        <span class="inline-block px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/50 dark:to-blue-800/50 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full border border-blue-200 dark:border-blue-700/50 hover:shadow-md transition-shadow duration-200">{{ trim($tag) }}</span>
                    @endforeach
                @else
                    <span class="inline-block px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-medium rounded-full">No genre</span>
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

            <!-- Description -->
            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed line-clamp-3">{{ $book->description ?? 'No description provided' }}</p>
        </div>

        <!-- Actions (mode-aware) -->
        <div class="flex gap-3 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 w-full">
            {{-- Admin approval badge / action --}}
            @can('is-admin')
                <div class="ms-auto me-0 text-sm">
                    @if ($book->approved)
                        <span class="inline-flex items-center px-2 py-1 rounded bg-green-100 text-green-800 text-xs">Approved</span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded bg-yellow-100 text-yellow-800 text-xs">Pending</span>
                    @endif
                </div>
                <form action="{{ route('admin.books.approve', $book) }}" method="POST">
                    @csrf
                    <input type="hidden" name="approved" value="{{ $book->approved ? 0 : 1 }}">
                    <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 text-white text-xs font-semibold rounded-lg shadow-md hover:shadow-lg">
                        {{ $book->approved ? 'Unapprove' : 'Approve' }}
                    </button>
                </form>
            @endcan
            @if ($mode === 'manage')
                @can('is-contributor')
                    <div class="ms-auto me-0 text-sm">
                        @if ($book->approved)
                            <span class="inline-flex items-center px-2 py-1 rounded bg-green-100 text-green-800 text-xs">Approved</span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded bg-gray-900 text-white text-xs">Pending</span>
                        @endif
                    </div>
                    <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center gap-2 px-3 py-2 bg-amber-500 text-white text-xs font-semibold rounded-lg shadow-md hover:shadow-lg">Edit</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 bg-red-600 text-white text-xs font-semibold rounded-lg shadow-md hover:shadow-lg">Delete</button>
                    </form>
                @endcan
            @endif

            @if ($mode === 'browse')
                @can('is-viewer')
                    <form action="{{ route('wishlist.store') }}" method="POST" class="ml-auto">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg">♡ Wishlist</button>
                    </form>
                @endcan
            @endif
        </div>
    </div>
</div>
