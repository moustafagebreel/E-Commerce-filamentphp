<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Contact Us - E-Commerce Store')]
class ContactPage extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|min:10|max:2000',
    ];

    public function submitMessage()
    {
        $this->validate();

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'subject', 'message']);
        session()->flash('success', 'Thank you! Your message has been sent successfully.');
    }

    public function render()
    {
        return view('livewire.contact-page');
    }
}
