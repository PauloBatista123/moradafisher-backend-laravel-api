<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpiredPasswordController;
use App\Http\Controllers\PapelController;
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

Route::group(['middleware'=>'auth'], function(){

    Route::middleware(['password_expired'])->group(function () {

        Route::get('/', function () {
            return view('admin.index');
        });

        Route::get('/', [UserController::class, 'index'])->name('admin.index');
        Route::get('/sair', [UserController::class, 'sair'])->name('admin.sair');
        Route::get('/accessCode', [AccessCodeController::class, 'view'])->name('admin.access_code.view');
        Route::post('/accessCode/verificar', [AccessCodeController::class, 'verificar'])->name('admin.access_code.verificar');


        Route::get('/funcionarios',[FuncionarioController::class, "index"])->name("funcionarios.index");
        Route::get('/lancamentos',[LancamentoController::class, "index"])->name("lancamentos.index");
        Route::get('/lancamentos/cadastro',[LancamentoController::class, "cadastrar"])->name("lancamentos.cadastrar");

        Route::get('/dashboard',[HomeController::class, "dashboard"])->name("dashboard.index");
        Route::get('/dashboard/funcionario',[HomeController::class, "funcionario"])->name("dashboard.funcionario");
        Route::get('/dashboard/exportar',[HomeController::class, "exportar"])->name("dashboard.exportar");

        Route::get('cadastro/usuarios', [UserController::class, 'index_usuario'])->name('admin.cadastro.usuarios');
        Route::get('cadastro/usuarios/alterar-senha/{id}', [UserController::class, 'alterar_senha'])->name('admin.cadastro.usuarios.alterar_senha');
        Route::get('cadastro/usuarios/adicionar', [UserController::class, 'adicionar'])->name('admin.cadastro.usuarios.adicionar');
        Route::post('cadastro/usuarios/salvar', [UserController::class, 'salvar'])->name('admin.cadastro.usuarios.salvar');
        Route::get('cadastro/usuarios/editar/{id}', [UserController::class, 'editar'])->name('admin.cadastro.usuarios.editar');
        Route::post('cadastro/usuarios/atualizar', [UserController::class, 'atualizar'])->name('admin.cadastro.usuarios.atualizar');
        Route::get('cadastro/usuarios/deletar/{id}', [UserController::class, 'deletar'])->name('admin.cadastro.usuarios.deletar');
        Route::post('cadastro/usuarios/atualizar/perfil/{id}', [UserController::class, 'atualizar_perfil'])->name('admin.cadastro.usuarios.atualizar_perfil');


        Route::get('cadastro/usuarios/papel/{id}', [UserController::class, 'papel'])->name('admin.cadastro.usuarios.papel');
        Route::post('cadastro/usuarios/papel/salvar/{id}', [UserController::class, 'salvarPapel'])->name('admin.cadastro.usuarios.papel.salvar');
        Route::get('cadastro/usuarios/papel/remover/{id}/{papel_id}', [UserController::class, 'removerPapel'])->name('admin.cadastro.usuarios.papel.remover');

        Route::post('usuarios/permissao/confirmar', [UserController::class, 'confirmar'])->name('usuarios.confirmar');

        Route::get('cadastro/papel', [PapelController::class, 'index'])->name('admin.cadastro.papel');
        Route::get('cadastro/papel/adicionar', [PapelController::class, 'adicionar'])->name('admin.cadastro.papel.adicionar');
        Route::post('cadastro/papel/salvar', [PapelController::class, 'salvar'])->name('admin.cadastro.papel.salvar');
        Route::get('cadastro/papel/editar/{id}', [PapelController::class, 'editar'])->name('admin.cadastro.papel.editar');
        Route::put('cadastro/papel/atualizar/{id}', [PapelController::class, 'atualizar'])->name('admin.cadastro.papel.atualizar');
        Route::get('cadastro/papel/deletar/{id}', [PapelController::class, 'deletar'])->name('admin.cadastro.papel.deletar');

        Route::get('cadastro/papel/permissao/{id}', [PapelController::class, 'permissao'])->name('admin.cadastro.papel.permissao');
        Route::post('cadastro/papel/permissao/salvar/{id}', [PapelController::class, 'salvarPermissao'])->name('admin.cadastro.papel.permissao.salvar');
        Route::get('cadastro/papel/permissao/remover/{id}/{id_permissao}', [PapelController::class, 'removerPermissao'])->name('admin.cadastro.papel.permissao.remover');


    });

    Route::post('/senha-post', [ExpiredPasswordController::class, 'postExpired'])->name('password.post_expired');
    Route::get('/password/expired', [ExpiredPasswordController::class, 'expired'])->name('password.expired');
});

Route::post('/login', [UserController::class, 'login'])->name('admin.login');

Route::get('/forgot-password', [UserController::class, 'reset'])->name('admin.login.reset');
Route::post('/forgot-password', [UserController::class, 'password_reset'])->name('admin.login.password_reset');

Route::get('/forgot-password-confirm', [UserController::class, 'password_reset_view'])->name('password.reset');

Route::get('/resetar/{token}', [UserController::class, 'resetar'])->name('admin.resetar');
Route::post('/resetar/update/{token}', [UserController::class, 'resetar_update'])->name('password.update');

Route::get('/login', function(){

    return view('admin.login');

})->name('admin.login.index');
