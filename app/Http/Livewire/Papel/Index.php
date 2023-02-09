<?php

namespace App\Http\Livewire\Papel;

use App\Models\Papel;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $onPerfilDelete = null;

    // chamada de eventos
    protected $listeners = ['atualizar' => 'render', 'deletar'];

    public function render()
    {
        $registros = Papel::orderBy('nome')->paginate(10);

        return view('livewire.papel.index', [
            'registros' => $registros
        ]);
    }

    public function deletar()
    {
        try {

            Papel::find($this->onPerfilDelete)->delete();

            $this->emit('render');
            $this->alert('success', 'Deletado com sucesso');

        }catch(Exception $e){
            $this->alert('info', 'Não foi possível concluir a ação!!');
        }
    }

    public function confirmDelete($id)
    {
        $this->onPerfilDelete = $id;

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
