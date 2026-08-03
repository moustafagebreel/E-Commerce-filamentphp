<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Summer Sale Collection',
                'subtitle' => 'Get up to 50% OFF on premium fashion and gadgets',
                'image' => 'banners/hero-1.jpg',
                'link_url' => '/products',
                'button_text' => 'Shop Summer Deals',
                'position' => 'hero',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Next-Gen Electronics',
                'subtitle' => 'Explore top-tier laptops, smartphones, and accessories',
                'image' => 'banners/hero-2.jpg',
                'link_url' => '/categories',
                'button_text' => 'Explore Tech',
                'position' => 'hero',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::firstOrCreate(['title' => $banner['title']], $banner);
        }
    }
}
