<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order_Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'price', 'images', 'is_active' ,'is_featured','on_sale','in_stock','category_id','brand_id'];


   
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    protected $casts = [
        'images' => 'array',
    ];


    public function order_items()
    {
        return $this->hasMany(Order_Item::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->where('is_approved', true)->avg('rating') ?? 0, 1);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}


