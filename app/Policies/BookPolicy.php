<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Determine whether the user can update the book.
     */
    public function update(User $user, Book $book): bool
    {
        // Admins can update any book; the uploader (owner) can update their own book
        return $user->role === 'admin' || $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can delete the book.
     */
    public function delete(User $user, Book $book): bool
    {
        // Admins can delete any book; the uploader (owner) can delete their own book
        return $user->role === 'admin' || $user->id === $book->user_id;
    }
}
