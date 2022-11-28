<?php

namespace App\Http\Livewire\Cadastro\Produto;

use App\Models\Produto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Cadastrar extends Component
{
    use LivewireAlert;

    public $nome = "";
    public $unidade = "";

    protected $rules = [
        'nome' => 'required|min:10|max:255',
        'unidade' => 'required|min:2|max:5',
    ];

    protected $messages = [
        'nome.required' => "Ops! Nome é obrigatório",
        'nome.min' => "Insira no mínimo 10 caracteres",
        'nome.max' => "Chegamos ao limite de 255 caracteres",
        'unidade.required' => "Ops! Unidade é obrigatório",
        'unidade.min' => "Insira no mínimo 2 caracteres",
        'unidade.max' => "Chegamos ao limite de 5 caracteres",
    ];

    public function render()
    {
        return view('livewire.cadastro.produto.cadastrar');
    }

    public function salvar()
    {
        $this->validate();

        Produto::create([
            'nome' => $this->nome,
            'unidade' => $this->unidade,
            'status' => 'ATIVO',
            'usuario_id' => auth()->user()->id ?? 1,
        ]);

        $this->dispatchBrowserEvent('close-modal');
        $this->emit('atualizar_produto');

        $this->alert('success', 'Produto cadastrado com sucesso!');

    }
}
