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

        // Recently released (approved only) - used on homepage top section
        // Include books that are approved and use `published_at` if present,
        // otherwise fall back to `created_at` so newly-created approved books
        // appear in the list immediately.
        $recentBooks = Book::with('user')
            ->where('approved', true)
            ->orderByRaw("COALESCE(published_at, created_at) DESC")
            ->limit(6)
            ->get();

        // Send the user to a view file, and pass the $books variable to it
        return view('books.home', [
            'books' => $books,
            'allTags' => $allTags,
            'selectedTags' => $selectedTags,
            'recentBooks' => $recentBooks,
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

        // For Manage Books: hide unapproved only from unauthenticated users and viewers
        // Contributors and Admins should see pending books in Manage view
        if (!auth()->check() || (auth()->user() && auth()->user()->role === 'viewer')) {
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

        // If created by a non-admin (contributor), mark as not approved.
        $validated['approved'] = auth()->user() && auth()->user()->role === 'admin' ? true : false;

        // Handle cover upload
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $path;
        }

        // 2. Create the new book in the database
        Book::create($validated);

        // 3. Redirect the user back to the main books list
        // Show a friendly flash message to contributors that the book will be visible after admin approval
        if (auth()->user() && auth()->user()->role !== 'admin') {
            return redirect(route('books.index'))->with('success', 'Book submitted — it will be visible once an admin approves it.');
        }

        return redirect(route('books.index'))->with('success', 'Book created successfully.');
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
        // For direct page views (regular browser request) we increment here.
        // For AJAX/json requests (the global modal), we do NOT increment here
        // to avoid double-counting — the modal should call the dedicated
        // increment endpoint which performs a single increment and returns
        // the updated book JSON.
        if (!$request->wantsJson()) {
            $book->increment('views');
            $book->refresh();
        }

        if ($request->wantsJson()) {
            return response()->json($book->load('user'));
        }

        return view('books.show', compact('book'));
    }

    /**
     * Increment views via AJAX and return the updated book JSON.
     */
    public function increment(Book $book, Request $request)
    {
        // Prevent rapid duplicate increments from the same session (10s window)
        $key = 'book_viewed_' . $book->id;
        $last = $request->session()->get($key);
        $now = time();
        $throttleSeconds = 10;

        if ($last && ($now - $last) < $throttleSeconds) {
            // Return current value without incrementing
            $book->refresh();
            return response()->json($book->load('user'));
        }

        // Mark timestamp and increment
        $request->session()->put($key, $now);
        $book->increment('views');
        $book->refresh();
        return response()->json($book->load('user'));
    }
}