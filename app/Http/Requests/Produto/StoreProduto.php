<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProduto extends FormRequest
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
            'nome' => 'required|max:255|string',
            'unidade' => 'required|max:255|string',
            'usuario_id' => 'exists:App\Models\User,id',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Informe o :attribute do produto',
            'nome.max' => 'O :attribute deve conter no máximo :max caracteres',
            'nome.string' => 'O :attribute deve ser do tipo texto',
            'unidade.required' => 'Informe o :attribute do produto',
            'unidade.max' => 'O :attribute deve conter no máximo :max caracteres',
            'unidade.string' => 'O :attribute deve ser do tipo texto',
            'usuario_id.exists' => 'Não foi possível localizar o usuário'
        ];
    }

    public function withValidator($validator){

        if($validator->fails()){
            throw new HttpResponseException(response()->json([
                'msg' => 'Ops! Algum campo não foi preenchido corretamente!',
                'status' => false,
                'errors' => $validator->errors(),
                'url' => route('produtos.store')
            ], 403));
        }

    }
}
