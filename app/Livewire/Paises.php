<?php

namespace App\Livewire;

use Livewire\Component;
use PHPUnit\Framework\Constraint\Count;

class Paises extends Component
{
    public $paises = [
        'Brasil',
        'Argentina',
        'Chile',
        'Paraguai',
        'Uruguai',
        'Peru',
    ];

    public $enable = true;

    public $pais;

    public $count;

    public function increment()
    {
        $this->count++;
    }
    public function delete($index){
        unset($this->paises[$index]);
    }

    public function save(){
        array_push($this->paises, $this->pais);
    }

    public function render()
    {
        return view('livewire.paises');
    }
}
