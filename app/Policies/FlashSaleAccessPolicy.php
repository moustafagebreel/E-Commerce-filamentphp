<?php

namespace App\Policies;

use App\Models\FlashSale;
use App\Models\User;

class FlashSaleAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, FlashSale $FlashSale): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, FlashSale $FlashSale): bool
    {
        return true;
    }

    public function delete(User $user, FlashSale $FlashSale): bool
    {
        return true;
    }
}
