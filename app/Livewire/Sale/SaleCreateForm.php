<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use App\Models\User;
use App\Models\VoucherType;
use App\Models\PaymentMethod;
class SaleCreateForm extends Component
{

    public $total = 0.0;

    public function render()
    {
        $users = User::all();
        $paymmentMethods = PaymentMethod::all();
        $voucherTypes = VoucherType::all(); 

        return view('livewire.sale.sale-create-form', compact('users', 'paymmentMethods', 'voucherTypes'));
    }
}
