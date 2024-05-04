<?php

namespace App\Livewire\User;

use App\Livewire\Forms\User\UserCreateForm;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserCreate extends Component
{
    public UserCreateForm $userCreate;

    public $roles = [];

    public function mount(){
        $this->roles = Role::all();
    }

    public function store(){
        $this->userCreate->store();
    }

    public function render()
    {
        return view('livewire.user.user-create');
    }
}
