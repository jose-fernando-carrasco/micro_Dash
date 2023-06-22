<?php

use App\Http\Controllers\graficosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/api/graficos', function (Request $request) {
//     $url = $request->root() . '/graficos';
//     return response()->json(['chart_url' => $url]);
// });