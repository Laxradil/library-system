<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('books.update', $book) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Title</label>
                            <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label for="author" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Author</label>
                            <input id="author" name="author" type="text" value="{{ old('author', $book->author) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Description</label>
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600">{{ old('description', $book->description) }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Update Book
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
