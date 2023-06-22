<?php

use App\Http\Controllers\graficosController;
use App\Http\Controllers\productController;
use App\Http\Controllers\productOutflowController;
use App\Http\Controllers\workerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/xd', function () {
    return "saludis";
});


Route::post('/product/store/{company_id}', [productController::class,'store']);
Route::post('/worker/store/{company_id}', [workerController::class,'store']);
Route::post('/productOutflow/store/{company_id}', [productOutflowController::class,'store']);

// -------------------------------------- SERVICIOS GRAFICOS ---------------------------------------------------
Route::get('/stock_barras/{company_id}', [graficosController::class,'stock_barras']);
Route::get('/ventas_primer_semestre_linea/{company_id}/{ano}', [graficosController::class,'ventas_primer_semestre_linea']);
Route::get('/ventas_segundo_semestre_linea/{company_id}/{ano}', [graficosController::class,'ventas_segundo_semestre_linea']);
Route::get('/Rendimiento_trabajador_torta/{company_id}', [graficosController::class,'Rendimiento_trabajador_torta']);
Route::get('/ganancias_primer_semestre_linea/{company_id}/{ano}', [graficosController::class,'ganancias_primer_semestre_linea']);
Route::get('/ganancias_segundo_semestre_linea/{company_id}/{ano}', [graficosController::class,'ganancias_segundo_semestre_linea']);
Route::get('/valor_inventario_barras/{company_id}', [graficosController::class,'valor_inventario_barras']);
//--------------------------------------------------------------------------------------------------------------

Route::get('/area/{company_id}', [graficosController::class,'area']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
