<?php

namespace Tests\Unit;

use App\Models\SiteSetting;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteSettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_site_setting_can_be_set_and_retrieved(): void
    {
        SiteSetting::set('store_name', 'My Test Store', 'general');

        $this->assertEquals('My Test Store', SiteSetting::get('store_name'));
    }

    public function test_site_setting_returns_default_when_not_found(): void
    {
        $this->assertEquals('Default Value', SiteSetting::get('non_existent_key', 'Default Value'));
    }
}
