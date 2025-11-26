<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

// Homepage - shows books with wishlist button only
Route::get('/', [BookController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    // Redirect to the homepage (books listing) — we no longer use the default dashboard view as the primary page.
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public book listing
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Book detail (increments views) - restrict `{book}` to numeric IDs so routes like `/books/create` aren't captured
Route::get('/books/{book}', [BookController::class, 'show'])->whereNumber('book')->name('books.show');

// Increment view counter via AJAX (used by the global modal to increment once)
Route::post('/books/{book}/increment', [BookController::class, 'increment'])->whereNumber('book')->name('books.increment');
Route::middleware(['auth'])->group(function () {

    // Books routes
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // Wishlist routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{item}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

// ADMIN ROUTES
Route::middleware(['auth', 'can:is-admin'])->prefix('admin')->name('admin.')->group(function () {

    // This will be the main user list: /admin/users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // This will be the "Edit User" page: /admin/users/1/edit
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    // This will handle the "Update User" form submission
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // This will handle deleting a user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Admin book approval toggle
    Route::post('/books/{book}/approve', [\App\Http\Controllers\Admin\BookController::class, 'approve'])->name('books.approve');
});;

require __DIR__.'/auth.php';
