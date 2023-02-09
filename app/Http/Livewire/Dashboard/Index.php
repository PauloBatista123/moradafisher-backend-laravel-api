<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Funcionario;
use App\Models\Lancamento;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $dataFiltroInicio;
    public $dataFiltroFim;

    public function render()
    {

        $qEntradas = Lancamento::
                            when($this->dataFiltroInicio && $this->dataFiltroFim, function($query){
                                $query->where([
                                    ['lancamentos.created_at','>=' ,$this->dataFiltroInicio],
                                    ['lancamentos.created_at','<=' ,$this->dataFiltroFim]
                                ]);
                            })->where('tipo', 'ENTRADA');

        $qSaidas = Lancamento::when($this->dataFiltroInicio && $this->dataFiltroFim, function($query){
                                    $query->where([
                                        ['lancamentos.created_at','>=' ,$this->dataFiltroInicio],
                                        ['lancamentos.created_at','<=' ,$this->dataFiltroFim]
                                    ]);
                                })->where('tipo', 'SAIDA');

        $totalSaidas = $qSaidas->sum('peso');
        $totalEntradas = $qEntradas->sum('peso');

        $funcionarios = Funcionario::orderBy('nome')->get();


        //SQL AGRUPADO POR FUNCIONARIOS PARA EXIBIR NA LISTA DE COMPARAÇÃO
        $lancByFuncSaidas = $qSaidas
                                ->select('lancamentos.funcionario_id', \DB::raw("DATE_FORMAT(lancamentos.created_at, '%d-%m-%Y') as dataFormat,sum(lancamentos.peso) as total, count(lancamentos.id) as qtd"))
                                ->groupBy('lancamentos.funcionario_id')
                                ->orderBy('total')
                                ->get();

        $lancByFuncEntradas = $qEntradas
                                ->select('lancamentos.funcionario_id', \DB::raw("DATE_FORMAT(lancamentos.created_at, '%d-%m-%Y') as dataFormat,sum(lancamentos.peso) as total, count(lancamentos.id) as qtd"))
                                ->groupBy('lancamentos.funcionario_id')
                                ->orderBy('total')
                                ->get();

        //SQL AGRUPADO POR DATA E FUNCIONARIO PARA EXIBIR NA LISTA DE LANÇAMENTOS
        $lancamentosEntradas = Lancamento::
                                when($this->dataFiltroInicio && $this->dataFiltroFim, function($query){
                                    $query->where([
                                        ['lancamentos.created_at','>=' ,$this->dataFiltroInicio],
                                        ['lancamentos.created_at','<=' ,$this->dataFiltroFim]
                                    ]);
                                })
                                ->select('funcionario_id', \DB::raw("DATE_FORMAT(lancamentos.created_at, '%d-%m-%Y') as dataFormat,sum(lancamentos.peso) as peso, count(lancamentos.id) as qtd"))
                                ->where('tipo', 'ENTRADA')
                                ->groupBy('lancamentos.funcionario_id', 'dataFormat')
                                ->orderBy('dataFormat')
                                ->get();

        $lancamentosSaidas = Lancamento::
                            when($this->dataFiltroInicio && $this->dataFiltroFim, function($query){
                                $query->where([
                                    ['lancamentos.created_at','>=' ,$this->dataFiltroInicio],
                                    ['lancamentos.created_at','<=' ,$this->dataFiltroFim]
                                ]);
                            })
                            ->select('funcionario_id', \DB::raw("DATE_FORMAT(lancamentos.created_at, '%d-%m-%Y') as dataFormat,sum(lancamentos.peso) as peso, count(lancamentos.id) as qtd"))
                            ->where('tipo', 'SAIDA')
                            ->groupBy('lancamentos.funcionario_id', 'dataFormat')
                            ->orderBy('dataFormat')
                            ->get();

        return view('livewire.dashboard.index',[
            'totalSaidas' => $totalSaidas,
            'totalEntradas' => $totalEntradas,
            'funcionarios' => $funcionarios,
            'lancByFuncEntradas' => $lancByFuncEntradas,
            'lancByFuncSaidas' => $lancByFuncSaidas,
            'lancamentosEntradas' => $lancamentosEntradas,
            'lancamentosSaidas' => $lancamentosSaidas,
        ]);
    }

    public function mount()
    {
        $this->dataFiltroInicio = is_null($this->dataFiltroInicio) ? Carbon::now()->startOfMonth()->format('Y-m-d') : $this->dataFiltroInicio;
        $this->dataFiltroFim = is_null($this->dataFiltroFim) ? Carbon::now()->format('Y-m-d') : $this->dataFiltroFim;
    }
}
