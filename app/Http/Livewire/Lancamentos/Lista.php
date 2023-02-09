<?php

namespace App\Http\Livewire\Lancamentos;

use App\Models\Lancamento;
use Exception;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Lista extends Component
{
    use LivewireAlert;

    protected $listeners = ['atualizar_lista' => 'render', 'deletar'];

    public $onLancamentoDelete = null;

    public function render()
    {
        $lancamentos = Lancamento::orderBy('id', 'desc')->limit(4)->get();

        return view('livewire.lancamentos.lista', [
            'lancamentos' => $lancamentos
        ]);
    }

    public function deletar()
    {
        try {

            Lancamento::find($this->onLancamentoDelete)->delete();

            $this->emit('atualizar_lista');
            $this->alert('success', 'Deletado com sucesso');

        }catch(Exception $e){
            $this->alert('info', 'Não foi possível concluir a ação!!');
        }
    }

    public function confirmDelete($id)
    {
        $this->onLancamentoDelete = $id;

        $this->alert('info', 'Deseja deletar o registro?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Deletar',
            'onConfirmed' => 'deletar',
            'cancelButtonText' => 'Cancelar',
            'showCancelButton' => true,
            'position' => 'center',
            'toast' => false,
            'timer' => null,
        ]);
    }
}
