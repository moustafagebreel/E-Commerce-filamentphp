<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Category $Category): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Category $Category): bool
    {
        return true;
    }

    public function delete(User $user, Category $Category): bool
    {
        return true;
    }
}
