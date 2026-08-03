<?php

namespace App\Policies;

use App\Models\OrderStatusLog;
use App\Models\User;

class OrderStatusLogPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, OrderStatusLog $OrderStatusLog): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, OrderStatusLog $OrderStatusLog): bool
    {
        return true;
    }

    public function delete(User $user, OrderStatusLog $OrderStatusLog): bool
    {
        return true;
    }
}
