<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LowStockDetectedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
    }
}
