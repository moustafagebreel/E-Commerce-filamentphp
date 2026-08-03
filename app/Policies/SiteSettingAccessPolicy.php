<?php

namespace App\Policies;

use App\Models\SiteSetting;
use App\Models\User;

class SiteSettingAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SiteSetting $SiteSetting): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, SiteSetting $SiteSetting): bool
    {
        return true;
    }

    public function delete(User $user, SiteSetting $SiteSetting): bool
    {
        return true;
    }
}
