<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Profile - E-Commerce Store')]
class ProfilePage extends Component
{
    public string $name = '';
    public string $email = '';
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function updateProfile()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('profile_success', 'Profile information updated successfully.');
    }

    public function updatePassword()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Current password does not match.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('password_success', 'Password changed successfully.');
    }

    public function render()
    {
        $user = Auth::user();
        $recentOrders = $user ? $user->orders()->latest()->take(3)->get() : collect();
        $savedAddresses = $user ? $user->addresses()->latest()->get() : collect();

        return view('livewire.profile-page', [
            'recentOrders' => $recentOrders,
            'savedAddresses' => $savedAddresses,
        ]);
    }
}
