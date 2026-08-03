<?php

namespace App\Policies;

use App\Models\ShippingZone;
use App\Models\User;

class ShippingZoneAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ShippingZone $ShippingZone): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ShippingZone $ShippingZone): bool
    {
        return true;
    }

    public function delete(User $user, ShippingZone $ShippingZone): bool
    {
        return true;
    }
}
