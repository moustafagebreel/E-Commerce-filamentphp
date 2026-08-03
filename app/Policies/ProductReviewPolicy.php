<?php

namespace App\Policies;

use App\Models\ProductReview;
use App\Models\User;

class ProductReviewPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ProductReview $ProductReview): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ProductReview $ProductReview): bool
    {
        return true;
    }

    public function delete(User $user, ProductReview $ProductReview): bool
    {
        return true;
    }
}
