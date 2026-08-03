<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        $comments = [
            5 => ['Excellent quality!', 'Exceeded my expectations, fast shipping.', 'Superb build quality and looks amazing.'],
            4 => ['Very good product, works as advertised.', 'Satisfied with the purchase.', 'Great value for money.'],
            3 => ['Average quality, decent for the price.', 'Fair product, meets basic needs.'],
        ];

        foreach ($products as $product) {
            foreach ($users->random(min(3, $users->count())) as $user) {
                $rating = rand(3, 5);
                $sampleComments = $comments[$rating];
                ProductReview::firstOrCreate([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ], [
                    'rating' => $rating,
                    'headline' => 'Customer review for ' . $product->name,
                    'comment' => $sampleComments[array_rand($sampleComments)],
                    'is_approved' => true,
                ]);
            }
        }
    }
}
