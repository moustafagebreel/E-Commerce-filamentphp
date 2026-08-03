<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStockLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity_change',
        'new_stock_level',
        'reason',
        'user_id',
    ];

    protected $casts = [
        'quantity_change' => 'integer',
        'new_stock_level' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
