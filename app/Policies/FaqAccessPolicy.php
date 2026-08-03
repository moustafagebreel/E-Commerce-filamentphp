<?php

namespace App\Policies;

use App\Models\Faq;
use App\Models\User;

class FaqAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Faq $Faq): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Faq $Faq): bool
    {
        return true;
    }

    public function delete(User $user, Faq $Faq): bool
    {
        return true;
    }
}
