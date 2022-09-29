<?php

namespace App\Http\Requests\Lancamento;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLancamentos extends FormRequest
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
            'peso' => 'required',
            'tipo' => 'required|string',
            'usuario_id' => 'exists:App\Models\User,id|required',
            'produto_id' => 'exists:App\Models\Produto,id|required',
            'funcionario_id' => 'exists:App\Models\Funcionario,id|required',
        ];
    }

    public function messages()
    {
        return [
            'peso.required' => 'Informe o :attribute',
            'tipo.required' => 'Informe o :attribute',
            'tipo.string' => 'O :attribute deve ser do tipo texto',
            'cargo.max' => 'O :attribute deve conter no máximo :max caracteres',
            'cargo.string' => 'O :attribute deve ser do tipo texto',
            'usuario_id.exists' => 'Não foi possível localizar o usuário',
            'usuario_id.required' => 'Informe o usuário',
            'produto_id.exists' => 'Não foi possível localizar o produto',
            'produto_id.required' => 'Informe o produto',
            'funcionario_id.exists' => 'Não foi possível localizar o funcionario',
            'funcionario_id.required' => 'Informe o funcionario',
        ];
    }

    public function withValidator($validator){

        if($validator->fails()){
            throw new HttpResponseException(response()->json([
                'msg' => 'Ops! Algum campo não foi preenchido corretamente!',
                'status' => false,
                'errors' => $validator->errors(),
                'url' => route('lancamentos.store')
            ], 403));
        }

    }
}
