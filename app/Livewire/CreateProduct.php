<?php

namespace App\Livewire;

use Livewire\Component;

class CreateProduct extends Component
{

    public $title;

    public function render()
    {
        return view('livewire.create-product');
    }
}
