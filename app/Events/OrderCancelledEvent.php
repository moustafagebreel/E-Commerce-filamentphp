<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCancelledEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
    }
}
