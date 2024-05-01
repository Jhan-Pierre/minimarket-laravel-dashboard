<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Sale;
use App\Models\User;
use App\Models\VoucherType;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('admin.sale.index');
    }

    public function create(){
        
        $users = User::all();
        $paymmentMethods = PaymentMethod::all();
        $voucherTypes = VoucherType::all(); 

        return view("admin.sale.create", compact('users', 'paymmentMethods', 'voucherTypes'));
    } 
    // ****************************************************************
    //esta es la forma para reeplazar el mount de los livewire
    // ****************************************************************

    
    public function store(Request $request, Sale $user){

        /* $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Añade la regla 'confirmed'
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]); */
    
        /* $user = new Sale();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email']; */

        $user->save();

        if ($request->has('roles')) {
            $user->roles()->attach($request->input('roles'));
        }

        return redirect()->route('admin.users.index');
    }

}
