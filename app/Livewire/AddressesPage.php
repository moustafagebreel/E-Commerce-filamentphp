<?php

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Address Book - E-Commerce Store')]
class AddressesPage extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $phone = '';
    public $street_address = '';
    public $city = '';
    public $state = '';
    public $zip_code = '';
    public $editingAddressId = null;
    public bool $showForm = false;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|max:50',
        'street_address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'zip_code' => 'required|string|max:20',
    ];

    public function openNewForm()
    {
        $this->reset(['first_name', 'last_name', 'phone', 'street_address', 'city', 'state', 'zip_code', 'editingAddressId']);
        $this->showForm = true;
    }

    public function saveAddress()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        Address::updateOrCreate(
            ['id' => $this->editingAddressId, 'user_id' => Auth::id()],
            [
                'user_id' => Auth::id(),
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone' => $this->phone,
                'street_address' => $this->street_address,
                'city' => $this->city,
                'state' => $this->state,
                'zip_code' => $this->zip_code,
            ]
        );

        $this->showForm = false;
        $this->reset(['first_name', 'last_name', 'phone', 'street_address', 'city', 'state', 'zip_code', 'editingAddressId']);
        session()->flash('success', 'Address saved successfully.');
    }

    public function editAddress($id)
    {
        $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $this->editingAddressId = $address->id;
        $this->first_name = $address->first_name;
        $this->last_name = $address->last_name;
        $this->phone = $address->phone;
        $this->street_address = $address->street_address ?? $address->strret_address;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->zip_code = $address->zip_code;
        $this->showForm = true;
    }

    public function deleteAddress($id)
    {
        Address::where('id', $id)->where('user_id', Auth::id())->delete();
        session()->flash('success', 'Address deleted successfully.');
    }

    public function render()
    {
        $addresses = Auth::check()
            ? Address::where('user_id', Auth::id())->latest()->get()
            : collect();

        return view('livewire.addresses-page', [
            'addresses' => $addresses,
        ]);
    }
}
