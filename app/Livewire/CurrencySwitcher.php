<?php

namespace App\Livewire;

use Livewire\Component;

class CurrencySwitcher extends Component
{
    public string $currentCurrency = 'USD';

    public function mount()
    {
        $this->currentCurrency = session('currency', 'USD');
    }

    public function changeCurrency(string $code)
    {
        if (in_array($code, ['USD', 'SAR', 'EGP', 'EUR', 'AED'])) {
            $this->currentCurrency = $code;
            session(['currency' => $code]);
            $this->dispatch('currencyChanged', currency: $code);
            return redirect(request()->header('Referer'));
        }
    }

    public function render()
    {
        return view('livewire.currency-switcher');
    }
}
