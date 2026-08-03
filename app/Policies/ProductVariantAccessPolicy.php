<?php

namespace App\Policies;

use App\Models\ProductVariant;
use App\Models\User;

class ProductVariantAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ProductVariant $ProductVariant): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ProductVariant $ProductVariant): bool
    {
        return true;
    }

    public function delete(User $user, ProductVariant $ProductVariant): bool
    {
        return true;
    }
}
