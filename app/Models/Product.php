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

    protected $fillable = ['name', 'slug', 'description', 'price', 'image', 'is_active' ,'is_featured','on_sale','in_stock','category_id','brand_id'];


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand()
    {
        return $this->belongsToMany(Brand::class);
    }

    protected $casts = [
        'images' => 'array',
    ];


    public function order_items()
    {
        return $this->hasMany(Order_Item::class);
    }




}
