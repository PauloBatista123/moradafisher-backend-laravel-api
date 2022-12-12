<?php

namespace App\Http\Livewire\Cadastro\Funcionario;

use App\Models\Funcionario;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    // variaveis
    private $funcionarios = null;
    public $onFuncionarioDelete = null;

    // chamada de eventos
    protected $listeners = ['atualizar' => 'render', 'deletar'];

    // funções
    public function render()
    {
        $this->funcionarios = Funcionario::orderby('nome')->paginate(15);

        return view('livewire.cadastro.funcionario.index', [
            'funcionarios' => $this->funcionarios
        ]);
    }

    public function deletar()
    {
        try {

            Funcionario::find($this->onFuncionarioDelete)->delete();

            $this->emit('render');
            $this->alert('success', 'Deletado com sucesso');

        }catch(Exception $e){
            $this->alert('info', 'Não foi possível concluir a ação!!');
        }
    }

    public function confirmDelete($id)
    {
        $this->onFuncionarioDelete = $id;

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
