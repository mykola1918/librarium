<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $books = Book::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', "%{$query}%")
                                ->orWhere('author', 'like', "%{$query}%")
                                ->orWhere('language', 'like', "%{$query}%");
        })->paginate(5); // You can adjust the pagination count

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'language' => 'required|string|max:255',
        'file' => 'required|file|mimes:pdf,epub,fb2,djvu,txt,docx', // Allowed file types
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allowed image types
    ]);

    // Store the uploaded book file with a unique name
    $file = $request->file('file');
    $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
    $filePath = $file->storeAs('books', $fileName, 'private'); // Store in storage/app/private/books

    // Check if a cover image was uploaded
    if ($request->hasFile('cover_image')) {
        $coverImage = $request->file('cover_image');
        $coverImageName = time() . '_' . preg_replace('/\s+/', '_', $coverImage->getClientOriginalName());
        $coverPath = $coverImage->storeAs('covers', $coverImageName, 'private'); // Store in storage/app/private/covers
    } else {
        // Use the placeholder image if no cover image is uploaded
        $coverPath = 'covers/book-cover.jpg'; // Adjust this path as necessary
    }
    // Create a new book record
    Book::create([
        'title' => $request->input('title'),
        'author' => $request->input('author'),
        'description' => $request->input('description'),
        'language' => $request->input('language'),
        'file_path' => $filePath,
        'cover_image_path' => $coverPath,
    ]);

    return redirect()->route('books.index')->with('success', 'Book added successfully!');
}



    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'language' => 'required|string|max:50',
            'file' => 'nullable|mimes:pdf|max:2048',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        // Check if a new file is uploaded
        if ($request->hasFile('file')) {
            Storage::delete($book->file_path); // Delete old file
            $filePath = $request->file('file')->store('books');
            $book->file_path = $filePath; // Update the file path
        }

        // Check if a new cover image is uploaded
        if ($request->hasFile('cover_image')) {
            Storage::delete($book->cover_image); // Delete old cover image
            $coverImagePath = $request->file('cover_image')->store('covers');
            $book->cover_image = $coverImagePath; // Update the cover image path
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->language = $request->language;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        Storage::delete($book->file_path); // Delete file
        if ($book->cover_image) {
            Storage::delete($book->cover_image); // Delete cover image if exists
        }
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}
