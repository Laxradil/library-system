<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between relative">
            <!-- Floating Books Animation -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="floating-book absolute" style="left: 20%; top: 40%; animation-delay: 0.5s;">
                    <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 55%; top: 55%; animation-delay: 2.5s;">
                    <svg class="w-7 h-7 text-white/15" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 80%; top: 35%; animation-delay: 1.5s;">
                    <svg class="w-5 h-5 text-white/10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 92%; top: 50%; animation-delay: 3.5s;">
                    <svg class="w-8 h-8 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white drop-shadow-lg flex items-center gap-3">
                    <span class="text-2xl">✏️</span>
                    {{ __('Edit Book') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl animate-fade-in-up transition-all duration-300 hover:shadow-2xl">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="animate-fade-in-up" style="animation-delay: 100ms;">
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2" for="title">
                                📖 Title
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500" 
                                required placeholder="Enter the book title">
                        </div>

                        <!-- Cover Image -->
                        <div class="animate-fade-in-up" style="animation-delay: 150ms;">
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2" for="cover">
                                🖼️ Book Cover
                            </label>
                            @if ($book->cover)
                                <div class="mb-3 relative inline-block group">
                                    <img src="{{ asset('storage/' . $book->cover) }}" 
                                        class="w-24 h-32 object-cover rounded-xl shadow-lg transition-transform duration-300 group-hover:scale-105" 
                                        alt="Current cover">
                                    <div class="absolute inset-0 bg-black/40 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <span class="text-white text-xs font-medium">Current</span>
                                    </div>
                                </div>
                            @endif
                            <input type="file" name="cover" id="cover" accept="image/*" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 transition-all duration-300 hover:border-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>

                        <!-- Author -->
                        <div class="animate-fade-in-up" style="animation-delay: 200ms;">
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2" for="author">
                                ✍️ Author
                            </label>
                            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500" 
                                required placeholder="Who wrote this book?">
                        </div>

                        <!-- Description -->
                        <div class="animate-fade-in-up" style="animation-delay: 250ms;">
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2" for="description">
                                📝 Description
                            </label>
                            <textarea name="description" id="description" rows="4" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500 resize-none"
                                placeholder="Tell us about this book...">{{ old('description', $book->description) }}</textarea>
                        </div>

                        <!-- Genres -->
                        <div class="animate-fade-in-up" style="animation-delay: 300ms;">
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-3">
                                🏷️ Genres <span class="font-normal text-gray-500">(select one or more)</span>
                            </label>
                            @php
                                $presetGenres = [
                                    ['name' => 'Fiction', 'icon' => '📚'],
                                    ['name' => 'Non-Fiction', 'icon' => '📰'],
                                    ['name' => 'Fantasy', 'icon' => '🧙'],
                                    ['name' => 'Science Fiction', 'icon' => '🚀'],
                                    ['name' => 'Mystery / Thriller', 'icon' => '🔍'],
                                    ['name' => 'Romance', 'icon' => '💕'],
                                    ['name' => 'Horror', 'icon' => '👻'],
                                    ['name' => 'Historical', 'icon' => '🏛️']
                                ];
                                // Parse existing genres from comma-separated string
                                $currentGenres = old('genres', array_filter(explode(',', trim($book->genre ?? ''))));
                                $currentGenres = array_map('trim', $currentGenres);
                            @endphp
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($presetGenres as $index => $g)
                                    <label class="group flex items-center gap-3 p-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 hover:border-indigo-400 dark:hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 cursor-pointer transition-all duration-300 hover:scale-[1.02] hover:shadow-md {{ in_array($g['name'], $currentGenres) ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/30' : '' }}"
                                           style="animation: fadeInUp 0.5s ease-out forwards; animation-delay: {{ 350 + ($index * 50) }}ms; opacity: 0;">
                                        <input type="checkbox" name="genres[]" value="{{ $g['name'] }}" 
                                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-500 text-indigo-600 focus:ring-indigo-500 transition-transform duration-200 checked:scale-110" 
                                            @if(in_array($g['name'], $currentGenres)) checked @endif>
                                        <span class="text-lg">{{ $g['icon'] }}</span>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $g['name'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Select one or more genres for easier filtering.</p>
                        </div>

                        <!-- Published Date -->
                        <div class="animate-fade-in-up" style="animation-delay: 400ms;">
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2" for="published_at">
                                📅 Published Date
                            </label>
                            <input type="date" name="published_at" id="published_at" value="{{ old('published_at', optional($book->published_at)->format('Y-m-d')) }}" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500">
                        </div>

                        <!-- Rating -->
                        <div class="animate-fade-in-up" style="animation-delay: 450ms;">
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2" for="rating">
                                ⭐ Rating
                            </label>
                            <select name="rating" id="rating" 
                                class="block w-40 px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 hover:border-gray-300 dark:hover:border-gray-500 cursor-pointer">
                                @for ($i=0; $i<=5; $i++)
                                    <option value="{{ $i }}" @if (old('rating', $book->rating) == $i) selected @endif>
                                        {{ $i == 0 ? '☆ 0 Stars' : '⭐ ' . $i . ' Star' . ($i > 1 ? 's' : '') }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700 animate-fade-in-up" style="animation-delay: 500ms;">
                            <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" 
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
