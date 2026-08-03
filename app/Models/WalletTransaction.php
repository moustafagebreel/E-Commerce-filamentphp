<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_wallet_id',
        'type',
        'amount',
        'description',
        'reference_id',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public function wallet()
    {
        return $this->belongsTo(UserWallet::class, 'user_wallet_id');
    }
}
