<?php

namespace App\Http\Livewire\Lancamentos;

use App\Models\Funcionario;
use App\Models\Lancamento;
use App\Models\Produto;
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
    public $selectProduto;
    public $selectFuncionario;

    //validate

    protected $rules = [
        'tipo' => 'required',
        'peso' => 'required',
        'selectProduto' => 'required',
        'selectFuncionario' => 'required',
    ];

    protected $messages = [
        'tipo.required' => "Ops! Tipo é obrigatório",
        'peso.required' => "Ops! Peso é obrigatório",
        'selectProduto.required' => "Ops! Produto é obrigatório",
        'selectFuncionario.required' => "Ops! Funcionário é obrigatório",
    ];

    public function render()
    {
        $funcionarios = Funcionario::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();

        return view('livewire.lancamentos.cadastrar', [
            'funcionarios' => $funcionarios,
            'produtos' => $produtos
        ]);
    }

    public function button($number)
    {
        $this->peso = $this->peso.''.$number;
    }

    public function tipoEntrada($onType)
    {
        $this->tipo = $onType;
    }

    public function updatedSelectProduto($produtoId)
    {
        if($produtoId != ''){
            $this->unidade = Produto::find($produtoId)->unidade;
        }else{
            $this->reset('unidade');
        }
    }

    public function salvar()
    {
       $this->validate();

        try{

            Lancamento::create([
                'produto_id' => $this->selectProduto,
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

    public function limpar()
    {
        $this->reset(['peso', 'selectFuncionario', 'selectProduto', 'tipo']);
    }
}
