<?php

namespace App\Livewire\Sale;

use App\Livewire\Forms\Sale\SaleCreateForm;
use Livewire\Component;
use App\Models\User;
use App\Models\VoucherType;
use App\Models\PaymentMethod;

class SaleCreate extends Component
{
    public SaleCreateForm $saleCreate;

    public function store(){
        $this->saleCreate->store();
    }

    public function render()
    {
        $users = User::all();
        $paymmentMethods = PaymentMethod::all();
        $voucherTypes = VoucherType::all(); 

        return view('livewire.sale.sale-create', compact('users', 'paymmentMethods', 'voucherTypes'));
    }
}

