<?php

namespace App\Http\Controllers;

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
}
