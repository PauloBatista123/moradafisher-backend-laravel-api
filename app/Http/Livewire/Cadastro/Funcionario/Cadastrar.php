<?php

namespace App\Http\Livewire\Cadastro\Funcionario;

use App\Models\Funcionario;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Cadastrar extends Component
{
    use LivewireAlert;

    public $nome = "";
    public $cargo = "";

    protected $rules = [
        'nome' => 'required|min:10|max:255',
        'cargo' => 'required|min:2|max:255',
    ];

    protected $messages = [
        'nome.required' => "Ops! Nome é obrigatório",
        'nome.min' => "Insira no mínimo 10 caracteres",
        'nome.max' => "Chegamos ao limite de 255 caracteres",
        'cargo.required' => "Ops! Cargo é obrigatório",
        'cargo.min' => "Insira no mínimo 10 caracteres",
        'cargo.max' => "Chegamos ao limite de 255 caracteres",
    ];

    public function render()
    {
        return view('livewire.cadastro.funcionario.cadastrar');
    }

    public function salvar()
    {
        $this->validate();

        Funcionario::create([
            'nome' => $this->nome,
            'cargo' => $this->cargo,
            'status' => 'ATIVO',
            'user_id' => auth()->user()->id ?? 1,
        ]);

        $this->dispatchBrowserEvent('close-modal');
        $this->emit('atualizar');

        $this->alert('success', 'Funcionário cadastrado com sucesso!');

    }
}
