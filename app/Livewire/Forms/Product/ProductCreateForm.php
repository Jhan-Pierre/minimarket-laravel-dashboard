<?php

namespace App\Livewire\Forms\Product;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductCreateForm extends Form
{
    public $openCreate = false;

    public $name, $barcode, $purchase_price, $sale_price, $stock, $category_id, $state_id;

    public function rules() 
    {
        return [
            'name' => 'required|min:3|max:100',
            'barcode' => 'required|min:3|max:100|unique:products,barcode',
            'purchase_price' => 'required|numeric|min:0.01',
            'sale_price' => 'required|numeric|min:0|gte:purchase_price',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:tb_categoria_producto,id',
            'state_id' => 'required|exists:tb_estado,id'
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no debe exceder los 100 caracteres.',
            'barcode.min' => 'El código de barras debe tener al menos 1 caracter.',
            'barcode.max' => 'El código de barras no debe exceder los 100 caracteres.',
            'barcode.required' => 'El código de barras es obligatorio.',
            'barcode.unique' => 'El código de barras ya está en uso.',
            'purchase_price.required' => 'El precio de compra es obligatorio.',
            'purchase_price.numeric' => 'El precio de compra debe ser un número.',
            'purchase_price.min' => 'El precio de compra debe ser mayor a 0.',
            'sale_price.required' => 'El precio de venta es obligatorio.',
            'sale_price.numeric' => 'El precio de venta debe ser un número.',
            'sale_price.min' => 'El precio de venta no puede ser 0.',
            'sale_price.gte' => 'El precio de venta debe ser mayor al precio de compra.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser mayor o igual a 0.',
            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'state_id.required' => 'El estado es obligatorio.',
            'state_id.exists' => 'El estado seleccionado no existe.'
        ];
    }

    public function save(){    
        $this->validate();

        Product::create(
            $this->only('name', 'barcode', 'purchase_price', 'sale_price', 'stock', 'category_id', 'state_id')
        );
    
        $this->reset();
    }

}
