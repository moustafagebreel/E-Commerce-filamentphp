<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'discount_percentage',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'discount_percentage' => 'float',
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'flash_sale_product')
            ->withPivot('sale_price')
            ->withTimestamps();
    }

    public function isCurrentlyActive(): bool
    {
        $now = now();
        return $this->is_active && $now->between($this->start_time, $this->end_time);
    }
}
