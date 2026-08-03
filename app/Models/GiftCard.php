<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount',
        'balance',
        'issued_to_user_id',
        'purchased_by_user_id',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'amount' => 'float',
        'balance' => 'float',
        'is_active' => 'boolean',
        'expires_at' => 'date',
    ];

    public static function generateCode(): string
    {
        do {
            $code = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));
        } while (static::where('code', $code)->exists());

        return $code;
    }

    public function isValid(): bool
    {
        return $this->is_active
            && $this->balance > 0
            && (!$this->expires_at || $this->expires_at->isFuture());
    }

    public function issuedTo()
    {
        return $this->belongsTo(User::class, 'issued_to_user_id');
    }

    public function purchasedBy()
    {
        return $this->belongsTo(User::class, 'purchased_by_user_id');
    }
}
