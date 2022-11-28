<?php

namespace App\Http\Livewire\Cadastro\Produto;

use App\Models\Produto;
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
    private $produtos = null;
    public $onProdutoDelete = null;

    // chamada de eventos
    protected $listeners = ['atualizar_produto' => 'render', 'deletar'];

    // funções
    public function render()
    {
        $this->produtos = Produto::paginate(15);

        return view('livewire.cadastro.produto.index', [
            'produtos' => $this->produtos
        ]);
    }

    public function deletar()
    {
        try {

            Produto::find($this->onProdutoDelete)->delete();

            $this->emit('render');
            $this->alert('success', 'Deletado com sucesso');

        }catch(Exception $e){
            $this->alert('info', 'Não foi possível concluir a ação!!');
        }
    }

    public function confirmDelete($id)
    {
        $this->onProdutoDelete = $id;

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
