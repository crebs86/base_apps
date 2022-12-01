<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'email' => 'required|unique:clients,email,' . $this->id,
            'cpf' => 'nullable|cpf|unique:clients,cpf',
            'cep' => 'nullable|size:8',
            'address' => 'string|nullable|max:510',
            'branch_id' => 'exists:branches,id',
            'phones' => 'max:105',
            'notes' => 'max:255'
        ];
    }
}
