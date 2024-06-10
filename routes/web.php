<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdensController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/adicionar', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
Route::get('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::get('/ordens', [OrdensController::class, 'index'])->name('ordens.index');
Route::post('/ordens', [OrdensController::class, 'store'])->name('ordens.store');
Route::get('/adicionar-ordem', [OrdensController::class, 'create'])->name('adicionar_ordem');
Route::get('/buscar-cliente', [OrdensController::class, 'buscarCliente'])->name('buscar_cliente');
Route::get('/clientes/{id}', [OrdensController::class, 'show'])->name('clientes.show');
Route::post('/adicionar-tecnico', [FuncionarioController::class, 'store'])->name('adicionar_tecnico');
Route::post('/registrar-atendente', [FuncionarioController::class, 'create'])->name('registrar-atendente');
Route::delete('/remover-atendente/{id}', [FuncionarioController::class, 'destroy'])->name('remover-atendente');
Route::get('/atendentes', [FuncionarioController::class, 'getAtendentes']);
Route::delete('/remover-tecnico/{id}', [FuncionarioController::class, 'destroyTecnico'])->name('remover-tecnico');
Route::get('/tecnicos', [FuncionarioController::class, 'getTecnicos'])->name('tecnicos');
Route::get('/ajustes', [AjustesController::class, 'index'])->name('ajustes');
Route::get('/get-tecnicos', [FuncionarioController::class, 'getTecnicos'])->name('tecnicos');
Route::get('/get-atendentes', [FuncionarioController::class, 'getAtendentes']);
Route::get('/pdf', [PdfController::class, 'gerarPDF'])->name('pdf');
Route::get('/home', [HomeController::class, 'index'])->name('home');





