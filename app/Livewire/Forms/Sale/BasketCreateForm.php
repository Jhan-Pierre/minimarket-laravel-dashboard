<?php

namespace App\Livewire\Forms\Sale;

use App\Models\TemporaryBasket;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;

class BasketCreateForm extends Form
{
    public $codbarras;
    
    public function rules(){
        return [
            'codbarras' => 'required|min:3|max:100|exists:products,barcode',
        ];
    }


    public function messages(){
        return [
            'codbarras.required' => 'El código de barras es requerido',
            'barcode.min' => 'El código de barras debe tener al menos :min caracteres.',
            'barcode.max' => 'El código de barras no debe exceder los :max caracteres.',
            'codbarras.exists' => 'El código de barras no existe',
        ];
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

    public function store(){
        $this->validate();

        $userID = auth()->user()->id;

        DB::statement('CALL sp_registrar_cesta_temporal(?, ?)', [$userID, $this->codbarras]);
        $this->codbarras = "";
    }

}
