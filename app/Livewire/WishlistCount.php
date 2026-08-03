<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class WishlistCount extends Component
{
    public int $count = 0;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('wishlistUpdated')]
    public function updateCount()
    {
        $this->count = Auth::check()
            ? Wishlist::where('user_id', Auth::id())->count()
            : 0;
    }

    public function render()
    {
        return view('livewire.wishlist-count');
    }
}
