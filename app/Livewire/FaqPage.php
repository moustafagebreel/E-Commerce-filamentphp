<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Frequently Asked Questions - E-Commerce Store')]
class FaqPage extends Component
{
    public function render()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('livewire.faq-page', [
            'faqCategories' => $faqs,
        ]);
    }
}
