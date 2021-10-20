<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DireccionController;
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
    return view('layouts.template');
});


// RUTAS PARA CLIENTES
Route::get('/clientes', [ClienteController::class, 'getAll'])->name('clientes');
Route::get('/clientes/{id?}', [ClienteController::class, 'getOne'])->name('clientes.get');
Route::post('/clientes', [ClienteController::class, 'Store'])->name('clientes.store');
Route::delete('/clientes/{id}', [ClienteController::class, 'Destroy'])->name('clientes.delete');

// RUTAS PARA DIRECCIONES
Route::get('/direcciones', [DireccionController::class, 'getAll'])->name('direccion');
Route::get('/direcciones/{id?}', [DireccionController::class, 'getOne'])->name('direccion.get');
Route::post('/direcciones', [DireccionController::class, 'Store'])->name('direccion.store');
Route::delete('/direcciones/{id}', [DireccionController::class, 'Destroy'])->name('direccion.delete');