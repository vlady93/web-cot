<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ElementosController;
use App\Http\Controllers\LiquidacionController;
use App\Http\Controllers\LiquidacionDetallesController;
use App\Http\Controllers\PenalidadController;
use App\Http\Controllers\TerminoController;
use App\Http\Controllers\TerminosController;
use App\Models\LiquidacionDetalles;
use Illuminate\Support\Facades\Route;

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
;
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::resource('terminos', TerminoController::class);
    Route::resource('liquidador', LiquidacionController::class);
    Route::resource('elementos', ElementosController::class);
    Route::resource('penalidades', PenalidadController::class);
    Route::resource('liquidaciondetalles', LiquidacionDetallesController::class);

    Route::get('liquidador/pdf/{liquidacion}', [LiquidacionController::class,'pdf'])->name('liquidacion.pdf');
    Route::get('liquidaciones/pdfpb/{liquidacion}', [LiquidacionController::class,'pdfpb'])->name('liquidacion.pdfpb');
    Route::get('liquidaciones/pruebapdf/{liquidacion}', [LiquidacionController::class,'pruebapdf'])->name('liquidacion.pruebapdf');
    Route::get('liquidaciones/pruebapdf1/{liquidacion}', [LiquidacionController::class,'pruebapdf1'])->name('liquidacion.pruebapdf1');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
