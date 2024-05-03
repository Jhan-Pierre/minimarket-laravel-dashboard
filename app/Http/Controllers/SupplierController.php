<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return view('admin.supplier.index');
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.supplier.show', compact('supplier'));
    }
}
