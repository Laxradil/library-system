<?php

namespace App\Http\Controllers;

// Add this line at the top, right after "use Illuminate\Http\Request;"
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Get all books from the database, newest first
        $books = Book::with('user')->latest()->get();

        // Send the user to a view file, and pass the $books variable to it
        return view('books.index', [
            'books' => $books,
        ]);
    }

    // This function just shows the page with the form
    public function create()
    { 
        $this->authorize('is-contributor'); // Only Admins and Contributors can see the form
        return view('books.create');
    }

    // This function validates and saves the new book
    public function store(Request $request)
    { 
        $this->authorize('is-contributor'); // Only Admins and Contributors can save a book
        // 1. Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $validated['user_id'] = auth()->id(); 

        // 2. Create the new book in the database
        Book::create($validated);

        // 3. Redirect the user back to the main books list
        return redirect(route('books.index'));
    }

    // Show edit form
    public function edit(Book $book)
    {
        $this->authorize('is-contributor');
        return view('books.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $this->authorize('is-contributor');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete book
    public function destroy(Book $book)
    {
        $this->authorize('is-contributor');
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}