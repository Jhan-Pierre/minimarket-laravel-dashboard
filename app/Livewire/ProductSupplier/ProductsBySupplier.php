<?php

namespace App\Livewire\ProductSupplier;

use Livewire\Component;
use App\Models\Supplier;

class ProductsBySupplier extends Component
{
    public $supplier;

    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function render()
    {
        $products = $this->supplier->products()->get();

        return view('livewire.product-supplier.products-by-supplier', compact('products'));
    }
}
