<?php

namespace App\Http\Livewire\Papel;

use App\Models\Papel;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Cadastrar extends Component
{
    use LivewireAlert;

    public $nome;
    public $descricao;

    protected $rules = [
        'nome' => 'required|min:10|max:255',
        'descricao' => 'required|min:2|max:255',
    ];

    protected $messages = [
        'nome.required' => "Ops! Nome é obrigatório",
        'nome.min' => "Insira no mínimo 3 caracteres",
        'nome.max' => "Chegamos ao limite de 255 caracteres",
        'descricao.required' => "Ops! descricao é obrigatório",
        'descricao.min' => "Insira no mínimo 5 caracteres",
        'descricao.max' => "Chegamos ao limite de 255 caracteres",
    ];


    public function render()
    {
        return view('livewire.papel.cadastrar');
    }


    public function salvar()
    {
        $this->validate();

        try{
            Papel::create([
                'nome' => $this->nome,
                'descricao' => $this->descricao,
            ]);

            $this->dispatchBrowserEvent('close-modal');
            $this->emit('atualizar');

            $this->alert('success', 'Funcionário cadastrado com sucesso!');

        }catch(Exception $e){
            $this->alert('warning', 'Erro Interno:'.$e->getMessage());
        }

    }
}
