<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistButton extends Component
{
    public int $productId;
    public bool $isInWishlist = false;

    public function mount(int $productId)
    {
        $this->productId = $productId;
        $this->checkStatus();
    }

    public function checkStatus()
    {
        if (Auth::check()) {
            $this->isInWishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->exists();
        } else {
            $this->isInWishlist = false;
        }
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isInWishlist) {
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->delete();
            $this->isInWishlist = false;
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $this->productId,
            ]);
            $this->isInWishlist = true;
        }

        $this->dispatch('wishlistUpdated');
    }

    public function render()
    {
        return view('livewire.wishlist-button');
    }
}
