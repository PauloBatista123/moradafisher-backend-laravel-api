<?php

namespace App\Http\Livewire\Usuario;

use App\Models\Papel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Cadastrar extends Component
{
    use LivewireAlert;

    public $perfis;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $perfil;

    public $messages = [
        'name.required' => "Ops! Nome é obrigatório",
        'name.min' => "Insira no mínimo 3 caracteres",
        'name.max' => "Chegamos ao limite de 255 caracteres",
        'email.required' => "Ops! email é obrigatório",
        'email.email' => "Informe um email válido",
        'email.unique' => "O email informado já está cadastrado",
        'password.required' => "Informe a senha",
        'password.min' => "Sua senha deve ter no mínimo 8 caracteres",
        'password.letters' => "Sua senha deve possuir letras",
        'password.mixedCase' => "A senha deve conter pelo menos uma letra maiúscula e uma minúscula",
        "password.numbers" => "Sua senha deve possuir números",
        "password.symbols" => "Sua senha deve possuir caracteres especiais (%,&,@,#, etc)",
        'password.confirmed' => "A confirmação da senha não corresponde",
        'perfil.required' => "Selecione o perfil de acesso.",
        'perfil.exists' => "O perfil não existe."
    ];


    public function render()
    {
        return view('livewire.usuario.cadastrar');
    }

    public function mount()
    {
        $this->perfis = Papel::all();
    }

    public function salvar()
    {
        $validator = Validator::make([
            'name' => $this->name,
            'password' => $this->password,
            'email' => $this->email,
            'password_confirmation' => $this->password_confirmation,
            'perfil' => $this->perfil
        ], [
            'name' => ['required','min:5', 'max:255'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'perfil' => ['required', 'exists:App\Models\Papel,id'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->symbols()]
        ], $this->messages, ['password' => 'campo senha'])->validate();

        try {

            DB::beginTransaction();

            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = bcrypt($this->password);
            $user->save();

            $user->adicionaPapel(Papel::find($this->perfil));

            $this->dispatchBrowserEvent('close-modal');
            $this->emit('atualizar');

            $this->alert('success', 'Usuário cadastrado com sucesso!');

            DB::commit();

        }catch(Exception $e){

            DB::rollBack();

            $this->alert('warning', 'Erro Interno:'.$e->getMessage());
        }



    }
}
