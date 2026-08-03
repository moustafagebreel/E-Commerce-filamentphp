<?php

namespace App\Policies;

use App\Models\Wishlist;
use App\Models\User;

class WishlistPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Wishlist $Wishlist): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Wishlist $Wishlist): bool
    {
        return true;
    }

    public function delete(User $user, Wishlist $Wishlist): bool
    {
        return true;
    }
}
