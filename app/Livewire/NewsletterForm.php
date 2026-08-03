<?php

namespace App\Livewire;

use App\Models\NewsletterSubscriber;
use Illuminate\Support\Str;
use Livewire\Component;

class NewsletterForm extends Component
{
    public string $email = '';

    public function subscribe()
    {
        $this->validate([
            'email' => 'required|email|max:255',
        ]);

        NewsletterSubscriber::updateOrCreate(
            ['email' => strtolower(trim($this->email))],
            [
                'is_subscribed' => true,
                'unsubscribe_token' => Str::random(32),
                'subscribed_at' => now(),
            ]
        );

        $this->reset('email');
        session()->flash('newsletter_success', 'Thank you for subscribing to our newsletter!');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
