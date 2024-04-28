<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        /* $products = DB::select('call sp_list_products()');
        return view('products.index', compact('products')); */
        return view('admin.products.index');
        //alternativas a compact
        //return view('students.index')->with('students', $students);
        //return view('students.index', ['students' => $students]);
    }

    public function create()
    {
        /* return view('products.create'); */
    }

    public function store(Request $request)
    {
        /* $request->validate([
            'name' => 'required|string|min:3|max:100',
            'barcode' => 'required|string|min:6|max:50',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|integer',      
            'category_id' => 'required|integer',
            'state_id' => 'required|integer'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index'); */
        
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        /* $product = Product::findorfail($id);
        return view('products.edit', compact('product')); */
    }

    public function update(Request $request, string $id)
    {
        /* $request->validate([
            'name' => 'required|string|min:3|max:100',
            'barcode' => 'required|string|min:6|max:50',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|integer',      
            'category_id' => 'required|integer',
            'state_id' => 'required|integer'
        ]); */

    }

    public function destroy(int $id)
    {
;
    }

    /* // Store procedures
    public function sp_list_products(){
        $product = DB::select('call sp_list_products()');

        return view('products.index', compact('product'));
    } */

}
