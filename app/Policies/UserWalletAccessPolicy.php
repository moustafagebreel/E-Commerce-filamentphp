<?php

namespace App\Policies;

use App\Models\UserWallet;
use App\Models\User;

class UserWalletAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, UserWallet $UserWallet): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, UserWallet $UserWallet): bool
    {
        return true;
    }

    public function delete(User $user, UserWallet $UserWallet): bool
    {
        return true;
    }
}
