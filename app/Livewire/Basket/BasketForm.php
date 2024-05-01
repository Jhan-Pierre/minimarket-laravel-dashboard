<?php

namespace App\Livewire\Basket;

use App\Models\TemporaryBasket;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BasketForm extends Component
{
    public $codbarras = "";

    public function store(int $id){
        DB::statement('CALL sp_registrar_cesta_temporal(?, ?)', [$id, $this->codbarras]);
        $this->codbarras = "";
    }

    public function render()
    {
        $userId = auth()->id(); // Obtener el ID del usuario autenticado
        $baskets = TemporaryBasket::where('user_id', $userId)->get();

        return view('livewire.basket.basket-form', compact('baskets'));
    }
}
