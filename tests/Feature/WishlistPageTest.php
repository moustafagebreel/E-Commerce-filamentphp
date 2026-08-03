<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishlistPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_wishlist(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($user)->get('/wishlist');
        $response->assertStatus(200)->assertSee($product->name);
    }
}
