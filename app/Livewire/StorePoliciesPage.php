<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Store Policies - Apex E-Commerce Store')]
class StorePoliciesPage extends Component
{
    public string $activeTab = 'terms';

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.store-policies-page');
    }
}
