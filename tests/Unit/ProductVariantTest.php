<?php

namespace Tests\Unit;

use App\Models\ProductVariant;
use PHPUnit\Framework\TestCase;

class ProductVariantTest extends TestCase
{
    public function test_variant_attributes_casting(): void
    {
        $variant = new ProductVariant([
            'sku' => 'SKU-RED-XL',
            'name' => 'Red / XL',
            'attributes' => ['color' => 'Red', 'size' => 'XL'],
            'stock' => 10,
        ]);

        $this->assertIsArray($variant->attributes);
        $this->assertEquals('Red', $variant->attributes['color']);
    }
}
