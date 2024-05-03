<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\Category\CategoryCreateForm;
use App\Livewire\Forms\Category\CategoryEditForm;
use App\Models\CategoryProduct;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class CategoryForm extends Component
{
    use WithPagination;
    
    public CategoryCreateForm $categoryCreate;

    public CategoryEditForm $categoryEdit;

    public $categoryDeleteId = "", $categoryDeleteName = "";

    public $openDelete = false;

    #[Url(as: 's')]
    public $search = "";

    public function updatingSearch(){
        $this->resetPage();    
    }

    public function save(){
        $this->categoryCreate->save();
    }

    public function closeCreate(){
        $this->categoryCreate->close();
    }

    public function edit($categoryId){
        $this->resetValidation();
        $this->categoryEdit->edit($categoryId);
    }

    public function update(){
        $this->categoryEdit->update();
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

        $this->reset(['categoryEdit', 'categoryDeleteId', 'openDelete']);
    }

}
