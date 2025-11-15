<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Add this entire block at the bottom of routes/web.php

Route::middleware(['auth'])->group(function () {
    // This will be our main page to list all books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    // This will be the page with the "Add New Book" form
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

    // This route will handle the form submission
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
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
});

require __DIR__.'/auth.php';
