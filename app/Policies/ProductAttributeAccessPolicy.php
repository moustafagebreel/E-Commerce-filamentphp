<?php

namespace App\Policies;

use App\Models\ProductAttribute;
use App\Models\User;

class ProductAttributeAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ProductAttribute $ProductAttribute): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ProductAttribute $ProductAttribute): bool
    {
        return true;
    }

    public function delete(User $user, ProductAttribute $ProductAttribute): bool
    {
        return true;
    }
}
