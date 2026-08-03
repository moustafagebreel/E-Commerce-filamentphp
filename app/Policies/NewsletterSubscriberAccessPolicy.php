<?php

namespace App\Policies;

use App\Models\NewsletterSubscriber;
use App\Models\User;

class NewsletterSubscriberAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, NewsletterSubscriber $NewsletterSubscriber): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, NewsletterSubscriber $NewsletterSubscriber): bool
    {
        return true;
    }

    public function delete(User $user, NewsletterSubscriber $NewsletterSubscriber): bool
    {
        return true;
    }
}
