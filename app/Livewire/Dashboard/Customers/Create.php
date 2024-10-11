<?php

namespace App\Livewire\Dashboard\Customers;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    
    public $password;
    public $password_confirmation;
    public $name;
    public $email;

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $this->dispatch('close')->to(Customers::class);

        $this->success(
            'New user created successfully',
            'You will <strong>love it :)</strong>',
            position: 'toast-top toast-end',
            icon: 'o-heart',
            css: 'bg-primary text-base-100'
        );

        $this->reset(['name', 'email', 'password']);
    }

    public function render()
    {
        return view('livewire.dashboard.customers.create');
    }
}
