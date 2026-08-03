<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    protected $model = Banner::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'subtitle' => $this->faker->sentence(6),
            'image' => 'banners/sample.jpg',
            'link_url' => '/products',
            'button_text' => 'Shop Now',
            'position' => 'hero',
            'sort_order' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
        ];
    }
}
