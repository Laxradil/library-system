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
        $sort = request('sort');
        switch ($sort) {
            case 'alpha':
                // Alphabetical A - Z
                $booksQuery->orderBy('title', 'asc');
                break;
            case 'most_viewed':
                $booksQuery->orderBy('views', 'desc');
                break;
            case 'highest_rated':
                // Order by rating only
                $booksQuery->orderBy('rating', 'desc');
                break;
            case 'top_rated':
                // Order by rating first, then views as tiebreaker
                $booksQuery->orderBy('rating', 'desc')->orderBy('views', 'desc');
                break;
            case 'most_popular':
                // Combine views + wishlist adds (subquery) with weighting to estimate popularity
                // Wishlist adds are weighted higher (x10) so a book with many adds ranks higher.
                $booksQuery->orderByRaw("(COALESCE(views,0) + COALESCE((select count(*) from wishlist_items where wishlist_items.book_id = books.id),0) * 10) DESC");
                break;
            default:
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
                    $q->orWhere(function ($genreQuery) use ($tag) {
                        $genreQuery
                            ->where('genre', $tag)
                            ->orWhere('genre', 'like', $tag . ',%')
                            ->orWhere('genre', 'like', '%,' . $tag)
                            ->orWhere('genre', 'like', '%,' . $tag . ',%');
                    });
                }
            });
        }

        $books = $booksQuery->get();
        $allTags = Book::getAllTags();

        // Main genres for the sidebar (8 main genres)
        $mainGenres = [
            'Fiction',
            'Non-Fiction',
            'Fantasy',
            'Science Fiction',
            'Mystery / Thriller',
            'Romance',
            'Horror',
            'Historical',
        ];

        // Recently released (approved only) - used on homepage top section
        // Prioritize created_at (upload date) to show newly uploaded books first,
        // falling back to published_at if created_at is very old.
        $recentBooks = Book::with('user')
            ->where('approved', true)
            ->orderByRaw("created_at DESC")
            ->limit(6)
            ->get();

        // Prepare 1-3 featured approved books for each main genre for the Browse-by-Genre panels
        $genrePanels = [];
        foreach ($mainGenres as $g) {
            $genrePanels[$g] = Book::with('user')
                ->where('approved', true)
                ->where(function ($query) use ($g) {
                    $query
                        ->where('genre', $g)
                        ->orWhere('genre', 'like', $g . ',%')
                        ->orWhere('genre', 'like', '%,' . $g)
                        ->orWhere('genre', 'like', '%,' . $g . ',%');
                })
                ->orderByRaw("COALESCE(published_at, created_at) DESC")
                ->limit(3)
                ->get();
        }

        // Send the user to a view file, and pass the $books variable to it
        return view('books.home', [
            'books' => $books,
            'allTags' => $allTags,
            'selectedTags' => $selectedTags,
            'mainGenres' => $mainGenres,
            'recentBooks' => $recentBooks,
            'genrePanels' => $genrePanels,
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

        // For Manage Books:
        // - Admins see all books (approved and pending)
        // - Contributors only see their own books
        // - Viewers/unauthenticated only see approved books
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role === 'admin') {
                // Admin sees all books
            } elseif ($user->role === 'contributor') {
                // Contributors only see their own books
                $booksQuery->where('user_id', $user->id);
            } else {
                // Viewers only see approved books
                $booksQuery->where('approved', true);
            }
        } else {
            // Unauthenticated users only see approved books
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
            'genres' => 'nullable|array',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);
        
        // Convert genres array to comma-separated string
        $validated['genre'] = !empty($validated['genres']) ? implode(',', $validated['genres']) : null;
        unset($validated['genres']);
        
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
        $this->authorize('update-book', $book);
        return view('books.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $this->authorize('update-book', $book);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'genres' => 'nullable|array',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);
        
        // Convert genres array to comma-separated string
        $validated['genre'] = !empty($validated['genres']) ? implode(',', $validated['genres']) : null;
        unset($validated['genres']);

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
        $this->authorize('delete-book', $book);
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