<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_attribute_id',
        'value',
        'color_code',
    ];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }
}
