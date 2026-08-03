<?php

namespace App\Policies;

use App\Models\ProductStockLog;
use App\Models\User;

class ProductStockLogPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ProductStockLog $ProductStockLog): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ProductStockLog $ProductStockLog): bool
    {
        return true;
    }

    public function delete(User $user, ProductStockLog $ProductStockLog): bool
    {
        return true;
    }
}
