<?php

namespace App\Livewire\Sale;

use App\Livewire\Forms\Sale\SaleCreateForm;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
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
        $paymmentMethods = Cache::remember('payment_methods', now()->addHours(1), function () {
            return PaymentMethod::all();
        });

        $voucherTypes = Cache::remember('voucher_types', now()->addHours(1), function () {
            return VoucherType::all();
        });

        return view('livewire.sale.sale-create', compact('paymmentMethods', 'voucherTypes'));
    }
}

