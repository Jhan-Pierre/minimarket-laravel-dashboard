<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Sale;
use App\Models\User;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        return view('admin.sale.index');
    }

    public function create(){
        return view("admin.sale.create");
    } 
    // ****************************************************************
    //esta es la forma para reeplazar el mount de los livewire
    // ****************************************************************
    
}
