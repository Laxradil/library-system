<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Manage Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    @can('is-contributor')
                    <div class="flex justify-end mb-6">
                        <a href="{{ route('books.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add New Book
                        </a>
                    </div> 
                    @endcan

                    <div class="space-y-5">
                        @forelse ($books as $book)
                            <div class="flex gap-6 p-6 min-h-80 border border-gray-200 dark:border-gray-700 rounded-xl shadow-md hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-purple-900/20 transition-all duration-300 transform hover:-translate-y-1" x-data="{ openModal: false }">
                                <!-- Book Cover (Left) -->
                                <div class="w-40 h-56 flex-shrink-0 overflow-hidden rounded-lg shadow-lg">
                                    @if ($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 rounded-lg text-gray-500 text-sm text-center">No cover</div>
                                    @endif
                                </div>

                                <!-- Book Info (Right) -->
                                <div class="flex-1 flex flex-col justify-between py-1">
                                    <div class="flex-1 flex flex-col">
                                        <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-1 line-clamp-2">{{ $book->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                            {{ $book->author }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500 mb-3 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h14m-14 4v8.5m0-8.5h14"></path></svg>
                                            Added by <span class="font-semibold">{{ $book->user->name ?? 'Unknown' }}</span>
                                        </p>
                                        
                                        <!-- Meta Info -->
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-3 space-y-1">
                                            <span class="block flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                Published: {{ optional($book->published_at)->format('M j, Y') ?? 'Unknown' }}
                                            </span>
                                            <span class="block flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Added: {{ $book->created_at->format('M j, Y') }}
                                            </span>
                                        </div>

                                        <!-- Genre Tags -->
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
                                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">{{ $book->description ?? 'No description provided' }}</p>
                                    </div>

                                    <!-- Actions (Bottom Right) -->
                                    <div class="flex gap-3 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                        @can('is-contributor')
                                            <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center gap-2 px-3 py-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white text-xs font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 active:scale-95">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit
                                            </a>
                                            <button @click="openModal = true" type="button" class="inline-flex items-center gap-2 px-3 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-xs font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 active:scale-95">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Delete
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                                        @can('is-viewer')
                                            <form action="{{ route('wishlist.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold rounded">♡ Wishlist</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>

                                <!-- Delete Modal (for contributors) -->
                                @can('is-contributor')
                                <div x-show="openModal" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50">
                                    <div class="bg-black bg-opacity-50 absolute inset-0" @click="openModal = false"></div>
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 z-10">
                                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Confirm Delete</h3>
                                        <p class="mb-4 text-gray-700 dark:text-gray-300">Are you sure you want to delete this book?</p>
                                        <div class="flex justify-end gap-2">
                                            <form action="{{ route('books.destroy', $book) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Delete</button>
                                            </form>
                                            <button @click="openModal = false" type="button" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                @endcan
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                You don't have any books in your library yet.
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>