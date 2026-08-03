<?php

namespace App\Policies;

use App\Models\Coupon;
use App\Models\User;

class CouponAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Coupon $Coupon): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Coupon $Coupon): bool
    {
        return true;
    }

    public function delete(User $user, Coupon $Coupon): bool
    {
        return true;
    }
}
