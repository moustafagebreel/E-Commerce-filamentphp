<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use App\Models\Order_Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'status',
    'grand_total',
    'payment_method',
    'payment_status', 
    'currency',
    'shipping_amount',
    'shipping_method',
    'notes'
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(Order_Item::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
