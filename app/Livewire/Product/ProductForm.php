<?php

namespace App\Livewire\Product;

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

    public $name, $barcode, $purchase_price, $sale_price, $stock, $category_id, $state_id;

    public $productsEdit = [
        'name' => '',
        'barcode' => '',
        'purchase_price' => '',
        'sale_price' => '',
        'stock' => '',
        'category_id' => '',
        'state_id' => '',
    ];

    public $openCreate = false;

    public $productEditId = '';
 
    public $openEdit = false;

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

    public function save(){
        Product::create(
            $this->only('name', 'barcode', 'purchase_price', 'sale_price', 'stock', 'category_id', 'state_id')
        );

        $this->reset(['name', 'barcode', 'purchase_price', 'sale_price', 'stock', 'category_id', 'state_id', 'openCreate']);

    }

    public function edit($productid){
        $this->openEdit = true;

        $this->productEditId = $productid;

        $product = Product::find($productid);
        $this->productsEdit['name'] = $product->name;
        $this->productsEdit['barcode'] = $product->barcode;
        $this->productsEdit['purchase_price'] = $product->purchase_price;
        $this->productsEdit['sale_price'] = $product->sale_price;
        $this->productsEdit['stock'] = $product->stock;
        $this->productsEdit['category_id'] = $product->category_id;
        $this->productsEdit['state_id'] = $product->state_id;
    }

    public function update(){
        $product = Product::find($this->productEditId);

        $product->update([
            'name' => $this->productsEdit['name'],
            'barcode' => $this->productsEdit['barcode'],
            'purchase_price' => $this->productsEdit['purchase_price'],
            'sale_price' => $this->productsEdit['sale_price'],
            'stock' => $this->productsEdit['stock'],
            'category_id' => $this->productsEdit['category_id'],
            'state_id' => $this->productsEdit['state_id']
        ]);

        $this->reset(['productDeleteName', 'productEditId', 'openEdit']);
    }
    
    public function delete($productid, $productname){
        $this->openDelete = true;

        $this->productDeleteId = $productid;
        $this->productDeleteName = $productname;

    }

    public function destroy(){
        $product = Product::find($this->productDeleteId);
        $product->delete();

        $this->reset(['productsEdit', 'productDeleteId', 'openDelete']);

    }

    public function render()
    {
         $products = Product::orderby('created_at', 'desc')->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search.'%');
         })->with('categoria', 'estado')->paginate(10);

        return view('livewire.product.product-form', compact('products'));
    }
}
