<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:55', 'unique:roles,id'],
            'permissions' => ['array'],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Já existe um papel com o nome: \':input\''
        ];
    }
}
