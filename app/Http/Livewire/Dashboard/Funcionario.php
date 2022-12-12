<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Funcionario as ModelsFuncionario;
use App\Models\Lancamento;
use Carbon\Carbon;
use Livewire\Component;

class Funcionario extends Component
{

    public $allFuncionario;

    public $isMonth = null;
    public $date = null;
    public $funcionarioId = null;
    public $isFiltered = false;
    public $openOffCanvas = false;

    public $entradasTotal;
    public $saidasTotal;
    public $aproveitamento;
    public $listaSaidas;
    public $listaEntradas;

    public $funcionarioSelected;

    public function render()
    {
        return view('livewire.dashboard.funcionario');
    }

    public function mount()
    {
        $this->allFuncionario = ModelsFuncionario::orderBy('nome')->get();
    }

    public function filtrar()
    {

        $this->funcionarioSelected = ModelsFuncionario::find($this->funcionarioId);
        $this->isFiltered = true;
        $this->dispatchBrowserEvent('close-offCanvas');

        $this->listaEntradas  = Lancamento::when($this->date, function($query){
            if($this->isMonth == 'mes'){
                $query->whereMonth('created_at', Carbon::parse($this->date)->month)->whereYear('created_at', Carbon::parse($this->date)->year);
            }else{
                $query->whereDate('created_at', $this->date);
            }
        })
        ->when($this->funcionarioId, function($query){
            $query->where('funcionario_id', $this->funcionarioId);
        })
        ->orderBy('created_at')
        ->where('tipo', 'ENTRADA')
        ->get()
        ->map(function ($entrada){
            return [
                'peso' => number_format($entrada->peso, 4, ',', '.'),
                'usuario' => $entrada->usuario->name,
                'created_at' => Carbon::parse($entrada->created_at)->format('d/m/Y H:i'),
                'produto' => $entrada->produto->nome,
            ];
        });

        $this->listaSaidas = Lancamento::when($this->date, function($query){
            if($this->isMonth == 'mes'){
                $query->whereMonth('created_at', Carbon::parse($this->date)->month)->whereYear('created_at', Carbon::parse($this->date)->year);
            }else{
                $query->whereDate('created_at', $this->date);
            }
        })
        ->when($this->funcionarioId, function($query){
            $query->where('funcionario_id', $this->funcionarioId);
        })
        ->where('tipo', 'SAIDA')
        ->orderBy('created_at')
        ->get()
        ->map(function ($entrada){
            return [
                'peso' => number_format($entrada->peso, 4, ',', '.'),
                'usuario' => $entrada->usuario->name,
                'created_at' => Carbon::parse($entrada->created_at)->format('d/m/Y H:i'),
                'produto' => $entrada->produto->nome,
            ];
        });

        $this->entradasTotal = Lancamento::
                                where(['tipo' => 'ENTRADA', 'funcionario_id' => $this->funcionarioId])
                                ->when($this->date, function($query){
                                    if($this->isMonth == 'mes'){
                                        $query->whereMonth('created_at', Carbon::parse($this->date)->month)->whereYear('created_at', Carbon::parse($this->date)->year);
                                    }else{
                                        $query->whereDate('created_at', $this->date);
                                    }
                                })->sum('peso');

        $this->saidasTotal = Lancamento::
                                where(['tipo' => 'SAIDA', 'funcionario_id' => $this->funcionarioId])
                                ->when($this->date, function($query){
                                    if($this->isMonth == 'mes'){
                                        $query->whereMonth('created_at', Carbon::parse($this->date)->month)->whereYear('created_at', Carbon::parse($this->date)->year);
                                    }else{
                                        $query->whereDate('created_at', $this->date);
                                    }
                                })
                                ->sum('peso');

        $this->aproveitamento = number_format($this->saidasTotal / $this->entradasTotal * 100, 2, '.', ',');
    }
}
