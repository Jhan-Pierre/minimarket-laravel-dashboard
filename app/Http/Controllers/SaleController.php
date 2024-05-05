<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('admin.sale.index');
    }

    public function show($id){
        return view("admin.sale.show", compact('id'));
    }

    public function create(){
        return view("admin.sale.create");
    } 
    // ****************************************************************
    //esta es la forma para reeplazar el mount de los livewire
    // ****************************************************************
    
}
