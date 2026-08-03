<?php

namespace App\Livewire;

use App\Models\ProductQuestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductQuestionsComponent extends Component
{
    public int $productId;
    public string $questionText = '';

    public function mount(int $productId)
    {
        $this->productId = $productId;
    }

    public function askQuestion()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'questionText' => 'required|string|min:5|max:500',
        ]);

        ProductQuestion::create([
            'product_id' => $this->productId,
            'user_id' => Auth::id(),
            'question' => $this->questionText,
            'is_approved' => true,
        ]);

        $this->reset('questionText');
        session()->flash('question_success', 'Your question has been submitted successfully.');
    }

    public function render()
    {
        $questions = ProductQuestion::where('product_id', $this->productId)
            ->where('is_approved', true)
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.product-questions-component', [
            'questions' => $questions,
        ]);
    }
}
