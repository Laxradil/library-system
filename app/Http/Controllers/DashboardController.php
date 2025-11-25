<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalUsers = 0;
        $totalBooks = 0;
        $myBooksCount = 0;

        // Get stats ONLY if the user is an admin
        if ($user->can('is-admin')) {
            $totalUsers = User::count();
            $totalBooks = Book::count();
        }

        // Get stats if the user is a contributor
        if ($user->can('is-contributor')) {
            $myBooksCount = Book::where('user_id', $user->id)->count();
        }

        // Send all the data to the view
        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'totalBooks' => $totalBooks,
            'myBooksCount' => $myBooksCount,
        ]);
    }
}