<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('books.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Add New Book</a>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @if ($books->count())
                        @foreach ($books as $book)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 hover:shadow-xl transition-shadow">
                                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ $book->title }}</h2>
                                <p class="text-gray-700 dark:text-gray-300">{{ $book->author }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ $book->description }}</p>
                                <p class="text-gray-500 dark:text-gray-500">Language: {{ $book->language }}</p>
                                <div class="mt-4">
                                    <a href="{{ Storage::url($book->file_path) }}" target="_blank" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Download</a>
                                    <a href="{{ route('books.edit', $book->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No books available.</p>
                    @endif
                </div>
                {{ $books->links() }} <!-- Pagination -->
            </div>
        </div>
    </div>
</x-app-layout>
