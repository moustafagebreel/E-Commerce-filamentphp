<?php

namespace App\Livewire;

use App\Models\ShippingZone;
use App\Services\ShippingCalculatorService;

class ShippingCalculatorWidget extends Component
{
    public ?int $selected_zone_id = null;
    public float $subtotal = 0;

    public function mount(float $subtotal = 0)
    {
        $this->subtotal = $subtotal;
        $default = ShippingZone::where('is_active', true)->first();
        if ($default) {
            $this->selected_zone_id = $default->id;
        }
    }

    public function render()
    {
        $zones = ShippingZone::where('is_active', true)->get();
        $rateInfo = ShippingCalculatorService::getRateForZone($this->selected_zone_id, $this->subtotal);

        return view('livewire.shipping-calculator-widget', [
            'zones' => $zones,
            'rateInfo' => $rateInfo,
        ]);
    }
}
