<?php

namespace App\Http\Controllers;

use App\Models\WishlistItem;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Show user's wishlist
    public function index()
    {
        $wishlist = WishlistItem::where('user_id', auth()->id())->with('book.user')->latest()->get();
        return view('wishlist.index', compact('wishlist'));
    }

    // Add book to wishlist
    public function store(Request $request)
    {
        $validated = $request->validate(['book_id' => 'required|exists:books,id']);

        // Check if already in wishlist
        $exists = WishlistItem::where('user_id', auth()->id())
            ->where('book_id', $validated['book_id'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Already in your wishlist.');
        }

        WishlistItem::create([
            'user_id' => auth()->id(),
            'book_id' => $validated['book_id'],
        ]);

        return redirect()->back()->with('success', 'Added to wishlist!');
    }

    // Remove from wishlist
    public function destroy(WishlistItem $item)
    {
        $this->authorize('delete', $item);
        $item->delete();
        return redirect()->back()->with('success', 'Removed from wishlist.');
    }
}
