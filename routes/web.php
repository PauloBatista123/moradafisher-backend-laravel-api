<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\ProdutoController;
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
    return view('admin.index');
});

Route::get('/funcionarios',[FuncionarioController::class, "index"])->name("funcionarios.index");
Route::get('/produtos',[ProdutoController::class, "index"])->name("produtos.index");
Route::get('/lancamentos',[LancamentoController::class, "index"])->name("lancamentos.index");
Route::get('/lancamentos/cadastro',[LancamentoController::class, "cadastrar"])->name("lancamentos.cadastrar");

Route::get('/dashboard',[HomeController::class, "dashboard"])->name("dashboard.index");
Route::get('/dashboard/funcionario',[HomeController::class, "funcionario"])->name("dashboard.funcionario");
