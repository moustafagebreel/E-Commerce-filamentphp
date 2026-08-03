<?php

namespace App\Policies;

use App\Models\OrderRefund;
use App\Models\User;

class OrderRefundPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, OrderRefund $OrderRefund): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, OrderRefund $OrderRefund): bool
    {
        return true;
    }

    public function delete(User $user, OrderRefund $OrderRefund): bool
    {
        return true;
    }
}
