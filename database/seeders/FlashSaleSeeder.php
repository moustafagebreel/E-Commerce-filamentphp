<?php

namespace Database\Seeders;

use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Database\Seeder;

class FlashSaleSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('is_active', true)->take(4)->get();
        if ($products->isEmpty()) {
            return;
        }

        $flashSale = FlashSale::updateOrCreate(
            ['title' => '24-Hour Mega Tech Flash Sale'],
            [
                'description' => 'Huge discounts on high demand gadgets and electronics. Limited quantities!',
                'start_time' => now(),
                'end_time' => now()->addHours(24),
                'discount_percentage' => 25.00,
                'is_active' => true,
            ]
        );

        foreach ($products as $product) {
            $flashSale->products()->syncWithoutDetaching([
                $product->id => ['sale_price' => $product->price * 0.75],
            ]);
        }
    }
}
