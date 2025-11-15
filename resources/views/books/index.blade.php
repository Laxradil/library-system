<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('is-contributor')
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('books.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                            Add New Book
                        </a>
                    </div> 
                    @endcan 
                    
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Your Book Collection
                    </h3>

                    <div class="space-y-4">
                        @forelse ($books as $book)
                            <div class="p-4 border rounded-lg dark:border-gray-700" x-data="{ openModal: false }">
                                <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $book->title }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">by {{ $book->author }}</p> 
                                <p class="text-sm text-gray-500">Added by: {{ $book->user->name ?? 'Unknown' }}</p>
                                <p class="mt-2 dark:text-gray-200">{{ $book->description }}</p>
                                @can('is-contributor')
                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold rounded">Edit</a>
                                    <button @click="openModal = true" type="button" class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded">Delete</button>
                                </div>
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