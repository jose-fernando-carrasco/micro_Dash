<?php

namespace App\Http\Controllers;

use App\Models\CompanyWorker;
use App\Models\Worker;
use Illuminate\Http\Request;

class workerController extends Controller
{
    public function store($company_id, Request $request){
        // Validar los datos de entrada
        $request->validate([
           'cod' => 'required',
           'name' => 'required'
       ]);

       // Crear un nuevo registro
       $worker = new Worker();
       $worker->cod = $request->cod;
       $worker->name = $request->name;
       $worker->save();

       $registro = new CompanyWorker();
       $registro->company_id = $company_id;
       $registro->worker_id = $worker->id;
       $registro->save();

       return response()->json(['data'=> 'ok']);
   }

}
