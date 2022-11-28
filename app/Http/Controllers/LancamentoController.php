<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lancamento\StoreLancamentos;
use App\Http\Resources\Transformers\Lancamento\LancamentoRelatoriosCollection;
use App\Http\Resources\Transformers\Lancamento\LancamentoResource;
use App\Http\Resources\Transformers\Lancamento\LancamentoResourceCollection;
use App\Models\Funcionario;
use App\Models\Lancamento;
use App\Services\ResponseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LancamentoController extends Controller
{
    private $lancamento;

    public function __construct(Lancamento $lancamento){
        $this->lancamento = $lancamento;
    }

    public function show(Request $request){
        try {
            $pagination = $request->get('page');
            $filtro_funcionario = $request->get('funcionario');
            $filtro_produto = $request->get('produto');
            $filtro_tipo = $request->get('tipo');

            if(boolval($pagination)){

                $lancamento = $this->lancamento
                ->withOnly(['funcionario', 'usuario', 'produto'])
                ->when($filtro_funcionario, function ($query) use ($filtro_funcionario){
                    $query->where('funcionario_id', $filtro_funcionario);
                })
                ->when($filtro_produto, function ($query) use ($filtro_produto){
                    $query->where('produto_id', $filtro_produto);
                })
                ->when($filtro_tipo, function ($query) use ($filtro_tipo){
                    $query->where('tipo', $filtro_tipo);
                })
                ->orderBy($filtro_ordem ?? 'id')
                ->paginate();

            }else{
                $lancamento = $this->lancamento->orderBy('created_at')->get();
            }

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

    public function relatorios()
    {
        try{

            $saidas = DB::table('funcionarios')
            ->join('lancamentos', 'funcionarios.id', 'lancamentos.funcionario_id')
            ->select('funcionarios.nome', 'funcionarios.id', DB::raw('sum(lancamentos.peso) as total, count(lancamentos.id) as quantidade'))
            ->where('tipo', 'SAIDA')
            ->groupBy('funcionarios.nome')
            ->get();

            $entradas = DB::table('funcionarios')
            ->join('lancamentos', 'funcionarios.id', 'lancamentos.funcionario_id')
            ->select('funcionarios.nome', 'funcionarios.id', DB::raw('sum(lancamentos.peso) as total, count(lancamentos.id) as quantidade'))
            ->where('tipo', 'ENTRADA')
            ->groupBy('funcionarios.nome')
            ->get();

            $relatorios = [
                'saidas' => $saidas,
                'entradas' => $entradas,
                'totalSaidas' => $saidas->sum('total'),
                'totalEntradas' => $entradas->sum('total'),
            ];

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('lancamentos.show', null ,$e);
        }

        return new LancamentoRelatoriosCollection($relatorios);
    }
}
