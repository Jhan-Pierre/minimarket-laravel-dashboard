<?php

namespace App\Livewire\User;

use App\Livewire\Forms\User\UserCreateForm;
use App\Models\State;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserCreate extends Component
{
    public UserCreateForm $userCreate;

    public $roles = [];
    public $states = [];

    public function mount(){
        $this->roles = Role::all();
        $this->states = State::all();

    }

    public function store(){
        $this->userCreate->store();
    }

    public function render()
    {
        return view('livewire.user.user-create');
    }
}
