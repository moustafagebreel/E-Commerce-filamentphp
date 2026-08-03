<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'is_active'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    

    
    // public function scopeActive($query)
    // {
    //     return $query->where('is_active', 1);
    // }

    // public function scopeInactive($query)
    // {
    //     return $query->where('is_active', 0);
    // }

    // public function scopeSearch($query, $search)
    // {
    //     return $query->where('name', 'like', "%$search%");
    // }


   
}
