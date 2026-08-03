<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Wishlist - E-Commerce Store')]
class WishlistPage extends Component
{
    public function removeFromWishlist($wishlistId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Wishlist::where('id', $wishlistId)
            ->where('user_id', Auth::id())
            ->delete();

        session()->flash('success', 'Item removed from your wishlist.');
    }

    public function render()
    {
        $wishlists = Auth::check()
            ? Wishlist::where('user_id', Auth::id())->with('product')->latest()->get()
            : collect();

        return view('livewire.wishlist-page', [
            'wishlists' => $wishlists,
        ]);
    }
}
