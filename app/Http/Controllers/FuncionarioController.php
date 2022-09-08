<?php

namespace App\Http\Controllers;

use App\Http\Requests\Funcionario\StoreFuncionario;
use App\Http\Requests\Funcionario\UpdateFuncionario;
use App\Http\Resources\Transformers\Funcionario\FuncionarioResource;
use App\Http\Resources\Transformers\Funcionario\FuncionarioResourceCollection;
use App\Models\Funcionario;
use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    private $funcionario;

    public function __construct(Funcionario $funcionario){
        $this->funcionario = $funcionario;
     }

    public function store(StoreFuncionario $request){

        try {
            $funcionario = $this->funcionario->create([
                'nome' => $request->get('nome'),
                'cargo' => $request->get('cargo'),
                'status' => 'ATIVO',
                'user_id' => $request->get('usuario_id'),
            ]);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('funcionarios.store', null, $e);
        }

        return new FuncionarioResource($funcionario, ['route' => 'funcionarios.store', 'type' => 'store']);
    }

    public function show(){
        try {

            $funcionarios = $this->funcionario->paginate();

        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('funcionarios.show', null, $e);
        }

        return new FuncionarioResourceCollection($funcionarios);
    }

    public function update($id, UpdateFuncionario $request){

        try {
            $funcionario = $this->funcionario->find($id);
            $funcionario->nome = $request->get('nome');
            $funcionario->cargo = $request->get('cargo');
            $funcionario->status = $request->get('status');
            $funcionario->user_id = $request->get('user_id');
            $funcionario->save();

        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('funcionarios.update', $id, $e);
        }

        return new FuncionarioResource($funcionario, ['route' => 'funcionarios.update', 'type' => 'update', 'id' => $id]);
    }

    public function detalhes($id){

        try {
            $funcionario = $this->funcionario->find($id);

            return new FuncionarioResource($funcionario, ['route' => 'funcionarios.detalhes', 'type' => 'detalhes', 'id' => $id]);

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('funcionarios.detalhes', $id, $e);
        }

    }

    public function destroy($id){

        try {

            $funcionario = $this->funcionario->destroy($id);

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('funcionarios.detalhes', $id, $e);
        }

        return ResponseService::default(['route' => 'funcionarios.destroy', 'type' => 'destroy'], $id);

    }
}