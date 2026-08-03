<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductReviewsComponent extends Component
{
    public Product $product;
    public int $rating = 5;
    public string $headline = '';
    public string $comment = '';
    public bool $submitted = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'headline' => 'nullable|string|max:255',
        'comment' => 'required|string|min:5|max:1000',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function submitReview()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        ProductReview::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product->id,
            'rating' => $this->rating,
            'headline' => $this->headline,
            'comment' => $this->comment,
            'is_approved' => true,
        ]);

        $this->reset(['headline', 'comment', 'rating']);
        $this->rating = 5;
        $this->submitted = true;
        session()->flash('review_success', 'Thank you! Your review has been submitted.');
    }

    public function render()
    {
        $reviews = $this->product->reviews()
            ->with('user')
            ->where('is_approved', true)
            ->latest()
            ->get();

        return view('livewire.product-reviews-component', [
            'reviews' => $reviews,
        ]);
    }
}
