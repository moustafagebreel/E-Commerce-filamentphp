<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'order_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'strret_address',
        'city',
        'state',
        'country',
        'zip_code',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
