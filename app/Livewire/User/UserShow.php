<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserShow extends Component
{
    public User $user;

    public function mount($id)
    {
        $this->user = User::with('roles', 'estado')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.user.user-show');
    }
}
