<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class UserForm extends Component
{

    use WithPagination;

    #[Url(as: 's')]
    public $search = "";

    public function updatingSearch(){
        $this->resetPage();    
    }

    public function render()
    {
        $users = User::orderby('created_at', 'desc')->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%') ;     
        })->paginate(10);

        return view('livewire.user.user-form',compact('users'));
    }
}
