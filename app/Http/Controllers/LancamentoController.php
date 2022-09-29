<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lancamento\StoreLancamentos;
use App\Http\Resources\Transformers\Lancamento\LancamentoResource;
use App\Http\Resources\Transformers\Lancamento\LancamentoResourceCollection;
use App\Models\Lancamento;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    private $lancamento;

    public function __construct(Lancamento $lancamento){
        $this->lancamento = $lancamento;
    }

    public function show(){
        try {

            $lancamento = $this->lancamento->paginate();

        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('produtos.show', null, $e);
        }

        return new LancamentoResourceCollection($lancamento);
    }

    public function store(StoreLancamentos $request){
        try {
            $lancamento = $this->lancamento->create([
                'tipo' => $request->get('tipo'),
                'peso' => $request->get('peso'),
                'usuario_id' => $request->get('usuario_id'),
                'funcionario_id' => $request->get('funcionario_id'),
                'produto_id' => $request->get('produto_id'),
            ]);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('lancamentos.store', null, $e);
        }

        return new LancamentoResource($lancamento, ['route' => 'lancamentos.store', 'type' => 'store']);
    }

    public function destroy($id){

        try {

            $lancamento = $this->lancamento->destroy($id);

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('lancamentos.destroy', $id, $e);
        }

        return ResponseService::default(['route' => 'lancamentos.destroy', 'type' => 'destroy'], $id);

    }
}
