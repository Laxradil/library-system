<?php

namespace App\Http\Controllers;

// Add this line at the top, right after "use Illuminate\Http\Request;"
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Homepage - shows all books with only wishlist button visible
     */
    public function home()
    {
        // Searching by title or author (optional)
        $query = request('q');
        $selectedTags = request('tags', []);
        if (is_string($selectedTags)) {
            $selectedTags = [$selectedTags];
        }

        $booksQuery = Book::with('user');

        // Filter by approval for non-admins
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            $booksQuery->where('approved', true);
        }

        // Sorting support
        if (request('sort') === 'most_viewed') {
            $booksQuery->orderBy('views', 'desc');
        } else {
            $booksQuery->latest();
        }

        if ($query) {
            $booksQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('author', 'like', "%{$query}%")
                  ->orWhere('genre', 'like', "%{$query}%");
            });
        }

        if (!empty($selectedTags)) {
            $booksQuery->where(function ($q) use ($selectedTags) {
                foreach ($selectedTags as $tag) {
                    $q->orWhere('genre', 'like', "%{$tag}%");
                }
            });
        }

        $books = $booksQuery->get();
        $allTags = Book::getAllTags();

        // Send the user to a view file, and pass the $books variable to it
        return view('books.home', [
            'books' => $books,
            'allTags' => $allTags,
            'selectedTags' => $selectedTags,
        ]);
    }

    /**
     * Browse Books page - full CRUD for contributors
     */
    public function index()
    {
        // Searching by title or author (optional)
        $query = request('q');

        $booksQuery = Book::with('user');

        // For public listing, show only approved books to non-admins
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            $booksQuery->where('approved', true);
        }

        if (request('sort') === 'most_viewed') {
            $booksQuery->orderBy('views', 'desc');
        } else {
            $booksQuery->latest();
        }

        if ($query) {
            $booksQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('author', 'like', "%{$query}%")
                  ->orWhere('genre', 'like', "%{$query}%");
            });
        }

        $books = $booksQuery->get();

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
            'cover' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'genre' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);
        
        $validated['user_id'] = auth()->id(); 

        // Handle cover upload
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $path;
        }

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
            'cover' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'genre' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $path;
        }
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

    /**
     * Show a single book and increment view counter (supports AJAX).
     */
    public function show(Book $book, Request $request)
    {
        // Increment views counter
        $book->increment('views');

        if ($request->wantsJson()) {
            return response()->json($book);
        }

        return view('books.show', compact('book'));
    }
}