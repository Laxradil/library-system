<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WishlistItem;

class WishlistItemPolicy
{
    /**
     * Determine whether the user can delete the wishlist item.
     */
    public function delete(User $user, WishlistItem $item): bool
    {
        return $user->id === $item->user_id;
    }
}
