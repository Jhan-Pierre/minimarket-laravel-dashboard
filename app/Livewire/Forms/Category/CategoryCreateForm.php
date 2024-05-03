<?php

namespace App\Livewire\Forms\Category;

use App\Models\CategoryProduct;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryCreateForm extends Form
{

    public $open = false;

    public $nombre;

    public function rules() 
    {
        return [
            'nombre' => 'required|min:5',
        ];
    }

    public function messages() 
    {
        return [
            'nombre.min' => 'El nombre debe tener al menos 5 caracteres.',
            'nombre.max' => 'El nombre debe tener menos de 60 caracteres.'
        ];
    }

    public function close(){
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function save(){

        $this->open = true;

        $this->validate();

        CategoryProduct::create(
            $this->only('nombre')
        );

        $this->reset();
    }

}
