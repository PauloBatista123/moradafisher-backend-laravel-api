<?php

namespace App\Http\Livewire\Papel;

use App\Models\GrupoPermissao;
use App\Models\Papel;
use App\Models\Permissao as ModelPermissao;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Permissao extends Component
{

    public $perfil;
    use LivewireAlert;

    public function render()
    {
        $permissao = ModelPermissao::all();
        $grupo = GrupoPermissao::all();

        return view('livewire.papel.permissao', [
            'permissao' => $permissao,
            'grupo' => $grupo
        ]);
    }

    public function mount($papel_id)
    {
        $this->perfil = Papel::find($papel_id);
    }

    public function adicionar($id)
    {
        try{
            $permissao = ModelPermissao::find($id);

            $this->perfil->adicionarPermissao($permissao);

            $this->alert('success', $permissao->nome.' adicionada!');

        }catch(Exception $e){
            $this->alert('warning', 'Erro Interno:'.$e->getMessage());
        }

    }

    public function remover($id)
    {
        try{
            $permissao = ModelPermissao::find($id);

            $this->perfil->removerPermissao($permissao);

            $this->alert('success', $permissao->nome.' removida!');

        }catch(Exception $e){
            $this->alert('warning', 'Erro Interno:'.$e->getMessage());
        }

    }
}
