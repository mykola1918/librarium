<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="author" class="block text-gray-700 dark:text-gray-300">Author</label>
                        <input type="text" name="author" id="author" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="language" class="block text-gray-700 dark:text-gray-300">Language</label>
                        <input type="text" name="language" id="language" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="file" class="block text-gray-700 dark:text-gray-300">Upload Book (PDF, EPUB, TXT)</label>
                        <input type="file" name="file" id="file" class="mt-1 block w-full text-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" accept=".pdf,.epub,.txt,.fb2,.djvu">
                    </div>

                    <div class="mb-4">
                        <label for="cover" class="block text-gray-700 dark:text-gray-300">Cover Image (optional)</label>
                        <input type="file" name="cover" id="cover" class="mt-1 block w-full text-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" accept="image/*">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Add Book</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
