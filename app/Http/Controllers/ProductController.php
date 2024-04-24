<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
        //alternativas a compact
        //return view('students.index')->with('students', $students);
        //return view('students.index', ['students' => $students]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'barcode' => 'required|string|min:6|max:50',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|integer',      
            'category_id' => 'required|integer',
            'state_id' => 'required|integer'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');
        
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(int $id)
    {
        $product = Product::findorfail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}
