<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255|string',
            'email' => 'email|required|max:255|unique:users,email,' . $this->user,
            'cpf' => 'nullable|cpf|unique:users,cpf,' . $this->user,
            'branch_id' => 'array|nullable|exists:branches,id',
            'notes' => 'nullable|min:3|max:510'
        ];
    }

    public function messages()
    {
        return [
            'cpf.unique' => 'Este CPF já se encontra em uso',
            'branch_id.exists' => 'Uma ou mais unidades informadas não existem. Favor selecionar um item da lista.'
        ];
    }
}
