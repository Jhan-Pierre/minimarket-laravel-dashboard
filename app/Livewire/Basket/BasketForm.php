<?php

namespace App\Livewire\Basket;

use App\Models\TemporaryBasket;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;

class BasketForm extends Component
{
    public $codbarras = "";

    #[Modelable]
    public $total;

    public function store(int $id){
        DB::statement('CALL sp_registrar_cesta_temporal(?, ?)', [$id, $this->codbarras]);
        $this->codbarras = "";
    }

    public function render()
    {
        $userId = auth()->id(); // Obtener el ID del usuario autenticado
        $baskets = TemporaryBasket::where('user_id', $userId)->get();
        $total = $baskets->sum('subtotal');

        $this->total = round($total, 2);

        return view('livewire.basket.basket-form', compact('baskets'));
    }
}
