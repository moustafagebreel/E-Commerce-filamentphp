<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Product $Product): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Product $Product): bool
    {
        return true;
    }

    public function delete(User $user, Product $Product): bool
    {
        return true;
    }
}
