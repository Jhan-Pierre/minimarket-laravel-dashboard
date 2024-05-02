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
    public function store(Request $request)
    {
        $userId = auth()->id(); 

        $total = $request->total;
        $igv = $request->igv;
        $metodo_pago_id = $request->metodo_pago_id;
        $tipo_comprobante_id = $request->tipo_comprobante_id;

        DB::statement('CALL sp_registrar_venta(?, ?, ?, ?, ?)', [
            $igv, 
            $total, 
            $tipo_comprobante_id, 
            $metodo_pago_id, 
            $userId
        ]);

        return redirect()->route('admin.sale.index');
    }
}
