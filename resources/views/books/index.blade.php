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
                        @if (session('success'))
                            <div class="mb-4 p-3 rounded bg-green-50 dark:bg-green-900/30 border border-green-100 dark:border-green-800 text-green-800 dark:text-green-200 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif
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
                            <x-book-card :book="$book" mode="manage" />
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