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
                            <div class="p-4 border rounded-lg dark:border-gray-700">
                                <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $book->title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Added by: {{ $book->user->name ?? 'Unknown' }}</p>
                                <p class="mt-2 dark:text-gray-200">{{ $book->description }}</p>
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