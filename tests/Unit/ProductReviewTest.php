<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductReview;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_average_rating_calculation(): void
    {
        $product = Product::factory()->create();

        ProductReview::factory()->create([
            'product_id' => $product->id,
            'rating' => 5,
            'is_approved' => true,
        ]);

        ProductReview::factory()->create([
            'product_id' => $product->id,
            'rating' => 3,
            'is_approved' => true,
        ]);

        $this->assertEquals(4.0, $product->average_rating);
        $this->assertEquals(2, $product->reviews_count);
    }
}
