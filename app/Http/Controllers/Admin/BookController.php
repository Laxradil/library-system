<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Approve or unapprove a book (Admin only)
     */
    public function approve(Book $book, Request $request)
    {
        $this->authorize('is-admin');

        $book->approved = (bool) $request->input('approved', true);
        $book->save();

        return redirect()->back();
    }
}
