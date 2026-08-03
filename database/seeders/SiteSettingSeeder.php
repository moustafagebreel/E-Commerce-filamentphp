<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Apex E-Commerce Store', 'group' => 'general'],
            ['key' => 'store_email', 'value' => 'support@apexecommerce.com', 'group' => 'contact'],
            ['key' => 'store_phone', 'value' => '+1 (800) 555-0199', 'group' => 'contact'],
            ['key' => 'currency_code', 'value' => 'USD', 'group' => 'general'],
            ['key' => 'currency_symbol', 'value' => '$', 'group' => 'general'],
            ['key' => 'meta_title', 'value' => 'Apex Store - Premium Electronics & Fashion', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Shop top quality products with fast global shipping and 24/7 support.', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::set($setting['key'], $setting['value'], $setting['group']);
        }
    }
}
