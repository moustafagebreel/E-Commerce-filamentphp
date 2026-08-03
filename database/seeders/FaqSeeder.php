<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How long does shipping take?',
                'answer' => 'Standard shipping typically takes 3-5 business days. Express shipping arrives in 1-2 business days.',
                'category' => 'Shipping & Delivery',
                'sort_order' => 1,
            ],
            [
                'question' => 'What is your return policy?',
                'answer' => 'We offer a 30-day money-back guarantee for unused products in their original packaging.',
                'category' => 'Returns & Refunds',
                'sort_order' => 2,
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept Visa, MasterCard, PayPal, Cash on Delivery, and Stripe payments.',
                'category' => 'Payments',
                'sort_order' => 3,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], $faq);
        }
    }
}
