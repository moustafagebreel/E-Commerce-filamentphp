<?php

namespace App\Policies;

use App\Models\Banner;
use App\Models\User;

class BannerAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Banner $Banner): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Banner $Banner): bool
    {
        return true;
    }

    public function delete(User $user, Banner $Banner): bool
    {
        return true;
    }
}
