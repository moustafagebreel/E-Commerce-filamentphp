<?php

namespace App\Policies;

use App\Models\ContactMessage;
use App\Models\User;

class ContactMessageAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ContactMessage $ContactMessage): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ContactMessage $ContactMessage): bool
    {
        return true;
    }

    public function delete(User $user, ContactMessage $ContactMessage): bool
    {
        return true;
    }
}
