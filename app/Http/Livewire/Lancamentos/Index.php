<?php

namespace App\Http\Livewire\Lancamentos;

use App\Models\Lancamento;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    // variaveis
    private $lancamentos = null;
    private $pagination = 12;
    private $filtro_funcionario = null;
    private $filtro_tipo = null;
    private $filtro_produto = null;
    public $onLancamentoDelete = null;

    // chamada de eventos
    protected $listeners = ['atualizar_produto' => 'render', 'deletar'];

    public function render()
    {
        try {
            $lancamentos = Lancamento::
            withOnly(['funcionario', 'usuario', 'produto'])
            ->when($this->filtro_funcionario, function ($query){
                $query->where('funcionario_id', $this->filtro_funcionario);
            })
            ->when($this->filtro_produto, function ($query){
                $query->where('produto_id', $this->filtro_produto);
            })
            ->when($this->filtro_tipo, function ($query){
                $query->where('tipo', $this->filtro_tipo);
            })
            ->orderBy('id')
            ->paginate($this->pagination);

        } catch (\Throwable|\Exception $e) {

        }

        return view('livewire.lancamentos.index', [
            'lancamentos' => $lancamentos
        ]);
    }

    public function deletar()
    {
        try {

            Lancamento::find($this->onLancamentoDelete)->delete();

            $this->emit('render');
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
