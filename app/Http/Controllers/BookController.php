<?php

namespace App\Http\Controllers;

// Add this line at the top, right after "use Illuminate\Http\Request;"
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{ 
    use AuthorizesRequests;

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
}