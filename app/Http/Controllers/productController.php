<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    // name:string
    // amount:int
    // price:real
    // sale_price:real
    // company_id:int

    public function store($company_id, Request $request){
         // Validar los datos de entrada
         $request->validate([
            'cod' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
        ]);

        // Crear un nuevo registro
        $registro = new Product();
        $registro->cod = $request->cod;
        $registro->name = $request->name;
        $registro->amount = $request->amount;
        $registro->price = $request->price;
        $registro->sale_price = $request->sale_price;
        $registro->company_id = $company_id;
        $registro->save();

        return response()->json(['data'=> 'ok']);
    }
}
