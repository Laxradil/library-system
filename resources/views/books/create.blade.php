<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between relative">
            <!-- Floating Books Animation -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="floating-book absolute" style="left: 25%; top: 35%; animation-delay: 0s;">
                    <svg class="w-7 h-7 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 50%; top: 50%; animation-delay: 2s;">
                    <svg class="w-5 h-5 text-white/15" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 75%; top: 30%; animation-delay: 4s;">
                    <svg class="w-8 h-8 text-white/10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="floating-book absolute" style="left: 90%; top: 45%; animation-delay: 1s;">
                    <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white drop-shadow-lg flex items-center gap-3">
                    <span class="text-2xl">📚</span>
                    {{ __('Add a New Book') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl animate-fade-in-up transition-all duration-300 hover:shadow-2xl">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    @auth
                        @if (!auth()->user()->isAdmin())
                            <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-amber-500/10 to-orange-500/10 border border-amber-500/30 text-amber-800 dark:text-amber-200 text-sm animate-fade-in flex items-center gap-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span>Books you add will be visible on the site only after an admin approves them.</span>
                            </div>
                        @endif
                    @endauth
                    
                    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf 

                        <!-- Title -->
                        <div class="animate-fade-in-up" style="animation-delay: 100ms;">
                            <label for="title" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">
                                📖 Title
                            </label>
                            <input id="title" name="title" type="text" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500" 
                                required autofocus placeholder="Enter the book title">
                        </div>

                        <!-- Cover Image -->
                        <div class="animate-fade-in-up" style="animation-delay: 150ms;">
                            <label for="cover" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">
                                🖼️ Book Cover
                            </label>
                            <div class="relative">
                                <input id="cover" name="cover" type="file" accept="image/*" 
                                    class="block w-full px-4 py-3 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 transition-all duration-300 hover:border-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>
                        </div>

                        <!-- Author -->
                        <div class="animate-fade-in-up" style="animation-delay: 200ms;">
                            <label for="author" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">
                                ✍️ Author
                            </label>
                            <input id="author" name="author" type="text" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500" 
                                required placeholder="Who wrote this book?">
                        </div>

                        <!-- Description -->
                        <div class="animate-fade-in-up" style="animation-delay: 250ms;">
                            <label for="description" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">
                                📝 Description
                            </label>
                            <textarea id="description" name="description" rows="4" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500 resize-none"
                                placeholder="Tell us about this book..."></textarea>
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
                                $selectedGenres = old('genres', []);
                            @endphp
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($presetGenres as $index => $g)
                                    <label class="group flex items-center gap-3 p-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 hover:border-indigo-400 dark:hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 cursor-pointer transition-all duration-300 hover:scale-[1.02] hover:shadow-md"
                                           style="animation: fadeInUp 0.5s ease-out forwards; animation-delay: {{ 350 + ($index * 50) }}ms; opacity: 0;">
                                        <input type="checkbox" name="genres[]" value="{{ $g['name'] }}" 
                                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-500 text-indigo-600 focus:ring-indigo-500 transition-transform duration-200 checked:scale-110" 
                                            @if(in_array($g['name'], $selectedGenres)) checked @endif>
                                        <span class="text-lg">{{ $g['icon'] }}</span>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $g['name'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Published Date -->
                        <div class="animate-fade-in-up" style="animation-delay: 400ms;">
                            <label for="published_at" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">
                                📅 Published Date
                            </label>
                            <input id="published_at" name="published_at" type="date" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500">
                        </div>

                        <!-- Rating -->
                        <div class="animate-fade-in-up" style="animation-delay: 450ms;">
                            <label for="rating" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">
                                ⭐ Rating
                            </label>
                            <select name="rating" id="rating" 
                                class="block w-40 px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 hover:border-gray-300 dark:hover:border-gray-500 cursor-pointer">
                                <option value="0">☆ 0 Stars</option>
                                <option value="1">⭐ 1 Star</option>
                                <option value="2">⭐ 2 Stars</option>
                                <option value="3">⭐ 3 Stars</option>
                                <option value="4">⭐ 4 Stars</option>
                                <option value="5">⭐ 5 Stars</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700 animate-fade-in-up" style="animation-delay: 500ms;">
                            <a href="{{ route('books.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors duration-300 hover:underline">
                                ← Back to Books
                            </a>
                            <button type="submit" 
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Save Book
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>