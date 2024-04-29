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

    #[Url(as: 's')]
    public $search = "";

    public function updatingSearch(){
        $this->resetPage();    
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
