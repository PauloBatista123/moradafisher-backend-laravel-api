<?php

namespace App\Http\Livewire\Lancamentos;

use App\Models\Lancamento;
use Livewire\Component;

class Lista extends Component
{

    protected $listeners = ['atualizar_lista' => 'render'];

    public function render()
    {
        $lancamentos = Lancamento::orderBy('id', 'desc')->limit(3)->get();

        return view('livewire.lancamentos.lista', [
            'lancamentos' => $lancamentos
        ]);
    }
}
