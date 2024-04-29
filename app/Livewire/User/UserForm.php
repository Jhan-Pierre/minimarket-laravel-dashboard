<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class UserForm extends Component
{
    use WithPagination;

    public $openDelete = false;
    public $userDeleteId = "";
    public $userDeleteName = "";

    #[Url(as: 's')]
    public $search = "";

    public function updatingSearch(){
        $this->resetPage();    
    }

    public function delete($userId, $userName)
    {
        $this->openDelete = true;
        $this->userDeleteId = $userId;
        $this->userDeleteName = $userName;
    }

    public function destroy()
    {
        User::destroy($this->userDeleteId);
        $this->openDelete = false;
        $this->reset(['userDeleteId', 'userDeleteName', 'openDelete']);
    }

    public function render()
    {
        $users = User::orderby('created_at', 'desc')->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%') ;     
        })->paginate(10);

        return view('livewire.user.user-form',compact('users'));
    }
}
