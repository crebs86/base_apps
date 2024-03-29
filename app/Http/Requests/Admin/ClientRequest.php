<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
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
            'email' => 'nullable|string|email|max:155',
            'cpf' => 'nullable|cpf|unique:clients,cpf,' . $this->id,
            'cep' => 'nullable|size:8',
            'address' => 'nullable|string|max:510',
            'branch_id' => 'nullable|exists:branches,id',
            'phones' => 'max:105',
            'notes' => 'max:255'
        ];
    }

    public function messages()
    {
        return [
            'branch_id.exists' => 'Selecione uma unidade válida',
            'cpf.unique' => 'CPF já está em uso'
        ];
    }
}
