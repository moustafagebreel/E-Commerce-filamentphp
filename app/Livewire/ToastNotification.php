<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ToastNotification extends Component
{
    public array $toasts = [];

    #[On('notify')]
    public function notify(string $type = 'success', string $message = '')
    {
        $this->toasts[] = [
            'id' => uniqid(),
            'type' => $type,
            'message' => $message,
        ];
    }

    public function removeToast(string $id)
    {
        $this->toasts = array_filter($this->toasts, fn ($t) => $t['id'] !== $id);
    }

    public function render()
    {
        return view('livewire.toast-notification');
    }
}
