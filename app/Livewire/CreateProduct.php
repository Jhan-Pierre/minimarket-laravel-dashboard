<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component
{

    public $title;
    public $name, $state_id;

    public function mount( Product $codproducto){
        /* $this->name = $codproducto->name;
        $this->state = $codproducto->state_id; */

        $this->fill(
            $codproducto->only(['name', 'state_id'])
        );
    }

    public function save(){
        /* dd($this->name); */
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
