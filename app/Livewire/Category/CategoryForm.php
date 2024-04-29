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

    public $nombre;

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
        CategoryProduct::create(
            $this->only('nombre')
        );

        $this->reset(['nombre', 'openCreate']);

    }

    public function edit($categoryId)
    {
        $this->openEdit = true;

        $this->categoryEditId = $categoryId;

        $category = CategoryProduct::find($categoryId);
        $this->categoriesEdit['nombre'] = $category->nombre;
    }

    public function update()
    {
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
            })
            ->paginate(10);

        return view('livewire.category.category-form', compact('categories'));
    }
}
