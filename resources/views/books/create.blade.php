<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                        @csrf 

                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                            <input id="title" name="title" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label for="cover" class="block font-medium text-sm text-gray-700">Book Cover</label>
                            <input id="cover" name="cover" type="file" accept="image/*" class="block mt-1 w-full">
                        </div>

                        <div class="mt-4">
                            <label for="author" class="block font-medium text-sm text-gray-700">Author</label>
                            <input id="author" name="author" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></textarea>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <label for="published_at" class="block font-medium text-sm text-gray-700">Published date</label>
                                <input id="published_at" name="published_at" type="date" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            </div>
                            <div>
                                <label for="genre" class="block font-medium text-sm text-gray-700">Tags (comma-separated)</label>
                                <input id="genre" name="genre" type="text" placeholder="e.g., Fiction, Science, Drama" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('genre') }}">
                                <p class="text-xs text-gray-500 mt-1">Separate multiple tags with commas</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="rating" class="block font-medium text-sm text-gray-700">Rating</label>
                            <select name="rating" id="rating" class="block mt-1 w-32 rounded-md shadow-sm border-gray-300">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Save Book
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>