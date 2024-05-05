<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\Product\ProductCreateForm;
use App\Livewire\Forms\Product\ProductEditForm;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\State;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class ProductForm extends Component
{
    use WithPagination;

    public $categories = [], $states = [];

    public ProductCreateForm $productCreate;
 
    public ProductEditForm $productEdit;

    public $productDeleteId = "", $productDeleteName = "";

    public $openDelete = false;

    #[Url(as: 's')]
    public $search = "";

    public function updatingSearch(){
        $this->resetPage();    
    }

    public function mount(){
        $this->categories = CategoryProduct::all();
        $this->states = State::all();
    }

    public function closeCreate(){
        $this->productCreate->close();
    }

    public function save(){
        $this->productCreate->save();
    }

    public function edit($productid){
        $this->resetValidation();
        $this->productEdit->edit($productid);
    }

    public function update(){
        $this->productEdit->update();
    }
    
    public function delete($productid, $productname){
        $this->openDelete = true;

        $this->productDeleteId = $productid;
        $this->productDeleteName = $productname;

    }

    public function destroy(){
        $product = Product::find($this->productDeleteId);
        $product->delete();

        $this->reset(['productDeleteId', 'openDelete']);

    }

    public function render()
    {
         $products = Product::orderby('created_at', 'desc')->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search.'%');
         })->with('categoria', 'estado')->paginate(10);

        return view('livewire.product.product-form', compact('products'));
    }
}
