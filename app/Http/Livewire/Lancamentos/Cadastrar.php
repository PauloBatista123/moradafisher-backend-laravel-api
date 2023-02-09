<?php

namespace App\Http\Livewire\Lancamentos;

use App\Models\Funcionario;
use App\Models\Lancamento;
use Exception;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Cadastrar extends Component
{
    use LivewireAlert;

    public $peso = null;
    public $tipo = null;
    public $unidade = null;

    //inputs
    public $selectFuncionario;

    //validate

    protected $rules = [
        'tipo' => 'required',
        'peso' => 'required',
        'selectFuncionario' => 'required',
    ];

    protected $messages = [
        'tipo.required' => "Ops! Tipo é obrigatório",
        'peso.required' => "Ops! Peso é obrigatório",
        'selectFuncionario.required' => "Ops! Funcionário é obrigatório",
    ];

    protected $listeners = [
        'salvar'
    ];

    public function render()
    {
        $funcionarios = Funcionario::orderBy('nome')->get();

        return view('livewire.lancamentos.cadastrar', [
            'funcionarios' => $funcionarios,
        ]);
    }

    public function button($number)
    {
        $this->peso = $this->peso.''.$number;
    }

    public function onFuncionario($id)
    {
        $this->selectFuncionario = $id;
    }

    public function tipoEntrada($onType)
    {
        $this->tipo = $onType;
    }

    public function salvar()
    {
        try{

            Lancamento::create([
                'funcionario_id' => $this->selectFuncionario,
                'usuario_id' => 1,
                'peso' => floatVal(str_replace(',', '.', $this->peso)),
                'tipo' => $this->tipo,
            ]);

            $this->alert('success', 'Lançamento cadastrado com sucesso!');
            $this->emit('atualizar_lista');
            $this->limpar();

        }catch(Exception $e){

            $this->alert('error', 'Erro interno!'.$e->getMessage());
        }
    }

    public function confirmarLancamento()
    {
        $this->validate();

        $this->alert('info', 'Deseja confirmar a '.$this->tipo.' de '.$this->peso.' kg referente ao funcionário #'.$this->selectFuncionario.'?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Confirmar',
            'onConfirmed' => 'salvar',
            'cancelButtonText' => 'Cancelar',
            'showCancelButton' => true,
            'position' => 'center',
            'toast' => false,
            'timer' => null,
        ]);

    }

    public function limpar()
    {
        $this->reset(['peso', 'selectFuncionario', 'tipo']);
    }
}
