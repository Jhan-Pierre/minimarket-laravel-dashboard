<?php

namespace App\Livewire\Forms\Category;

use App\Models\CategoryProduct;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryEditForm extends Form
{
    public $categoryId = '';
 
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

    public function edit($categoryId){
        $this->open = true;

        $this->categoryId = $categoryId;

        $category = CategoryProduct::find($categoryId);

        $this->nombre = $category->nombre;
    }

    public function update(){

        $this->validate();

        $category = CategoryProduct::find($this->categoryId);

        $category->update(
            $this->only('nombre')
        );

        $this->reset();
    }

}
