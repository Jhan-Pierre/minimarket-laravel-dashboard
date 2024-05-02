<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\State;
use App\Models\Supplier;

class Show extends Component
{
    public $supplier;

    public $states = [];

    public function mount(Supplier $supplier)
    {
        $this->states = State::all();
        $this->supplier = $supplier;
    }

    public function render()
    {
        return view('livewire.supplier.show');
    }
}
