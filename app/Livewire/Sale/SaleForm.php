<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class SaleForm extends Component
{

    use WithPagination;

    #[Url(as: 's')]
    public $search = "";

    public function updatingSearch(){
        $this->resetPage();    
    }

    public function render()
    {
        $sales = Sale::orderBy('created_at', 'desc')
            ->when($this->search, function($query) {
                $query->whereHas('users', function($userQuery) {
                    $userQuery->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->with('tipocomprobante', 'metodoPago', 'users')
            ->paginate(10);

        return view('livewire.sale.sale-form', compact('sales'));
    }
}
