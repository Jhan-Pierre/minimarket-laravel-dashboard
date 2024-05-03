<?php

namespace App\Livewire\Category;

use App\Models\CategoryProduct;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class CategoryForm extends Component
{
    use WithPagination;
    
    public $categoriesCreate = [
        'nombre' => '',
    ];

    public $categoriesEdit = [
        'nombre' => '',
    ];

    public $openCreate = false;

    public $categoryEditId = '';
 
    public $openEdit = false;

    public $categoryDeleteId = "", $categoryDeleteName = "";

    public $openDelete = false;

    #[Url(as: 's')]
    public $search = "";

    public function updatingSearch(){
        $this->resetPage();    
    }

    public function save(){
  
        $this->validate([
            'categoriesCreate.nombre' =>'required|min:5|max:8',
        ],[
            'categoriesCreate.nombre.required' =>'El nombre es requerido.',
            'categoriesCreate.nombre.min' =>'El nombre debe tener al menos 5 caracteres.',
            'categoriesCreate.nombre.max' =>'El nombre debe tener menos de 60 caracteres.'
        ]);

        CategoryProduct::create([
            'nombre' => $this->categoriesCreate['nombre']
        ]);

        $this->reset(['categoriesCreate', 'openCreate']);

    }

    public function closeCreate(){
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['categoriesCreate', 'openCreate']);
    }

    public function edit($categoryId)
    {
        $this->resetValidation();

        $this->openEdit = true;

        $this->categoryEditId = $categoryId;

        $category = CategoryProduct::find($categoryId);
        $this->categoriesEdit['nombre'] = $category->nombre;
    }

    public function update()
    {
        $this->validate([
            'categoriesEdit.nombre' =>'required|min:5|max:8',
        ],[
            'categoriesEdit.nombre.required' =>'El nombre es requerido.',
            'categoriesEdit.nombre.min' =>'El nombre debe tener al menos 5 caracteres.',
            'categoriesEdit.nombre.max' =>'El nombre debe tener menos de 60 caracteres.'
        ]);

        $category = CategoryProduct::find($this->categoryEditId);

        $category->update([
            'nombre' => $this->categoriesEdit['nombre'],
        ]);

        $this->reset(['categoryEditId', 'openEdit']);
    }

    public function render()
    {
        $categories = CategoryProduct::orderBy('created_at', 'desc')
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })->paginate(10);

        return view('livewire.category.category-form', compact('categories'));
    }

    public function delete($categoryId, $categoryName)
    {
        $this->openDelete = true;

        $this->categoryDeleteId = $categoryId;
        $this->categoryDeleteName = $categoryName;
    }

    public function destroy()
    {
        $category = CategoryProduct::find($this->categoryDeleteId);
        $category->delete();

        $this->reset(['categoriesEdit', 'categoryDeleteId', 'openDelete']);
    }

}
