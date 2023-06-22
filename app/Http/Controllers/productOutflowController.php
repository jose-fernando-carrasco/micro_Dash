<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOutflow;
use App\Models\Worker;
use Illuminate\Http\Request;

class productOutflowController extends Controller
{

    // quantity
    // fecha
    // worker_id
    // product_id
    // product_id
    // company_id


    public function store($company_id, Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'quantity' => 'required',
            'fecha' => 'required',
            'worker_cod' => 'required',
            'product_cod' => 'required',
        ]);

        $worker = Worker::join('company_workers', 'workers.id', '=', 'company_workers.worker_id')
            ->where('company_workers.company_id', $company_id)
            ->where('workers.cod', $request->worker_cod)
            ->select('workers.*')
            ->first();

        $product = Product::join('companies', 'products.company_id', '=', 'companies.id')
            ->where('products.cod', $request->product_cod)
            ->where('companies.id', $company_id)
            ->select('products.*')
            ->first();

        // Crear un nuevo registro
        $productOut = new ProductOutflow();
        $productOut->quantity = $request->quantity;
        $productOut->fecha = $request->fecha;
        $productOut->worker_id = $worker->id;
        $productOut->product_id = $product->id;
        $productOut->company_id = $company_id;
        $productOut->save();

        return response()->json(['data' => 'ok']);
    }
}
