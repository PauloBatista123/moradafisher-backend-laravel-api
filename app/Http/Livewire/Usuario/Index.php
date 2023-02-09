<?php

namespace App\Http\Livewire\Usuario;

use App\Models\User;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $onUserDelete = null;

    // chamada de eventos
    protected $listeners = ['atualizar' => 'render', 'deletar'];

    public function render()
    {
        $registros = User::orderBy('name')->paginate(10);

        return view('livewire.usuario.index', [
            'registros' => $registros
        ]);
    }

    public function deletar()
    {
        try {

            User::find($this->onUserDelete)->delete();

            $this->emit('render');
            $this->alert('success', 'Deletado com sucesso');

        }catch(Exception $e){
            $this->alert('info', 'Não foi possível concluir a ação!!');
        }
    }

    public function confirmDelete($id)
    {
        $this->onUserDelete = $id;

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

    public function editar(int $id)
    {
        $this->emitTo('usuario.alterar', 'atribuir', $id);
        $this->dispatchBrowserEvent('open-modal-editar');
    }
}
