<?php

namespace App\Livewire\User;

use App\Livewire\Forms\User\UserEditForm;
use Livewire\Component;
use App\Models\User;

class UserEdit extends Component
{
    public UserEditForm $userEdit;

    public function mount($id)
    {
        $this->userEdit->edit($id);
    }

    public function update(){
        $this->userEdit->update();
    }

    public function render()
    {
        return view('livewire.user.user-edit');
    }
}
