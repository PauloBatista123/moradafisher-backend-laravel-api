<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class PasswordExpireRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (! Hash::check($value, Auth()->user()->password)) {
                        $fail('A senha digitada não é válida');
                    }
                },
            ],
            'password' => ['required', 'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
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
            'current_password.required' => 'A senha atual é necessária',
            'password.required' => 'Digite a nova senha',
            'password.min' => 'Sua senha deve conter no minimo 8 caracteres',
            'password.mixed_case' => 'A senha deve conter pelo menos uma letra maiúscula e uma letra minúscula',
            'password.symbols' => 'A senha deve conter pelo menos um símbolo',
            'password.numbers' => 'A senha deve conter pelo menos um número',
            'password.confirmed' => 'A senha de confirmação não confere com a nova senha',
        ];
    }
}
