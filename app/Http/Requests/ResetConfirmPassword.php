<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetConfirmPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => ['required', 'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'email' => ['required', 'email'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Confirme seu email',
            'password.required' => 'Digite a nova senha',
            'password.min' => 'Sua senha deve conter no minimo 8 caracteres',
            'password.mixed_case' => 'A senha deve conter pelo menos uma letra maiúscula e uma letra minúscula',
            'password.symbols' => 'A senha deve conter pelo menos um símbolo',
            'password.numbers' => 'A senha deve conter pelo menos um número',
            'password.confirmed' => 'A senha de confirmação não confere com a nova senha',
        ];
    }
}
