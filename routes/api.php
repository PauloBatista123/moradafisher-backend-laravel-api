<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('users/register', [UserController::class, 'store'])->name('users.store');

Route::post('funcionarios/register', [FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::get('funcionarios', [FuncionarioController::class, 'show'])->name('funcionarios.show');
Route::put('funcionarios/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::get('funcionarios/{id}', [FuncionarioController::class, 'detalhes'])->name('funcionarios.detalhes');
Route::delete('funcionarios/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

Route::post('produtos/register', [ProdutoController::class, 'store'])->name('produtos.store');
Route::get('produtos', [ProdutoController::class, 'show'])->name('produtos.show');
Route::put('produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::get('produtos/detalhes/{id}', [ProdutoController::class, 'detalhes'])->name('produtos.detalhes');
Route::delete('produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
