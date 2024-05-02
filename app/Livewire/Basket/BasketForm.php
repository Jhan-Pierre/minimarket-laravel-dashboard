<?php

namespace App\Livewire\Basket;

use App\Models\TemporaryBasket;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Modelable;

class BasketForm extends Component
{
    public $codbarras = "";

    #[Modelable]
    public $total;

    public function store(int $id){
        DB::statement('CALL sp_registrar_cesta_temporal(?, ?)', [$id, $this->codbarras]);
        $this->codbarras = "";
    }

    public function delete($productId)
    {
         $userId = auth()->id();

         TemporaryBasket::where('user_id', $userId)
             ->where('product_id', $productId)
             ->delete();
    }

    public function clearBasket()
    {
        $userId = auth()->id();
        TemporaryBasket::where('user_id', $userId)->delete();
    }


    public function incrementQuantity($productId)
{
    $basket = TemporaryBasket::where('user_id', auth()->id())
        ->where('product_id', $productId)
        ->firstOrFail();

    $basket->cantidad++;
    $basket->subtotal = $basket->precio_unitario * $basket->cantidad;
    $basket->save();
}

public function decrementQuantity($productId)
{
    $basket = TemporaryBasket::where('user_id', auth()->id())
        ->where('product_id', $productId)
        ->firstOrFail();

    if ($basket->cantidad > 1) {
        $basket->cantidad--;
        $basket->subtotal = $basket->precio_unitario * $basket->cantidad;
        $basket->save();
    }
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
