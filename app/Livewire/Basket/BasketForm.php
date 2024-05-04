<?php

namespace App\Livewire\Basket;

use App\Livewire\Forms\Sale\BasketCreateForm;
use App\Models\TemporaryBasket;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Modelable;

class BasketForm extends Component
{
    public BasketCreateForm $basketCreate;

    #[Modelable]
    public $total;

    public function incrementQuantity($productId)
    {
        $this->basketCreate->incrementQuantity($productId);
    }

    public function decrementQuantity($productId)
    {
        $this->basketCreate->decrementQuantity($productId);
    }

    public function store(){
        $this->basketCreate->store();
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

    public function render()
    {
        $userId = auth()->id(); // Obtener el ID del usuario autenticado
        $baskets = TemporaryBasket::where('user_id', $userId)->get();
        $total = $baskets->sum('subtotal');

        $this->total = round($total, 2);

        return view('livewire.basket.basket-form', compact('baskets'));
    }
}
