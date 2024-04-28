<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserForm extends Component
{
    public function render()
    {
        $users = User::paginate(10);

        return view('livewire.user.user-form',compact('users'));
    }
}
