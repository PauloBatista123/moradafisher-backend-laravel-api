<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Funcionario;
use App\Models\Lancamento;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $dataFiltro;

    public function render()
    {

        $qEntradas = Lancamento::
                            when($this->dataFiltro, function($query){
                                $query->whereDate('lancamentos.created_at', $this->dataFiltro);
                            })->where('tipo', 'ENTRADA');

        $qSaidas = Lancamento::when($this->dataFiltro, function($query){
                                    $query->whereDate('lancamentos.created_at', $this->dataFiltro);
                                })->where('tipo', 'SAIDA');

        $totalSaidas = $qSaidas->sum('peso');
        $totalEntradas = $qEntradas->sum('peso');

        $funcionarios = Funcionario::orderBy('nome')->get();


        $lancByFuncSaidas = $qSaidas
                                ->join('produtos', 'lancamentos.produto_id', '=', 'produtos.id')
                                ->select('funcionario_id', 'produtos.nome', \DB::raw('sum(lancamentos.peso) as total, count(lancamentos.id) as qtd'))
                                ->groupBy('funcionario_id')
                                ->orderBy('total')
                                ->get();

        $lancByFuncEntradas = $qEntradas
                                ->join('produtos', 'lancamentos.produto_id', '=', 'produtos.id')
                                ->select('funcionario_id', 'produtos.nome', \DB::raw('sum(lancamentos.peso) as total, count(lancamentos.id) as qtd'))
                                ->groupBy('funcionario_id')
                                ->orderBy('total')
                                ->get();

        $lancamentosEntradas = Lancamento::
                                when($this->dataFiltro, function($query){
                                    $query->whereDate('lancamentos.created_at', $this->dataFiltro);
                                })->where('tipo', 'ENTRADA')
                                ->get();

        $lancamentosSaidas = Lancamento::
                            when($this->dataFiltro, function($query){
                                $query->whereDate('lancamentos.created_at', $this->dataFiltro);
                            })->where('tipo', 'SAIDA')
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
        $this->dataFiltro = is_null($this->dataFiltro) ? Carbon::now()->format('Y-m-d') : $this->dataFiltro;
    }
}
