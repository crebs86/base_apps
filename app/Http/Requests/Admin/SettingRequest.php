<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'canRegister' => 'required|boolean',
            'logoutAfterChangeEmail' => 'required|boolean',
            'mustVerifyEmail' => 'required|boolean',
            'saveUpdates_branches' => 'required|boolean',
            'saveUpdates_clients' => 'required|boolean',
            'saveUpdates_permissions' => 'required|boolean',
            'saveUpdates_roles' => 'required|boolean',
            'saveUpdates_userRolesPermissions' => 'required|boolean',
            'saveUpdates_users' => 'required|boolean'
        ];
    }
    public function messages()
    {
        return [
            'canRegister.required' => 'Informe sobre `Registro`',
            'canRegister.boolean' => 'Erro no tipo de dado enviado',

            'logoutAfterChangeEmail.required' => 'Informe sobre `Alteração de e-mail`',
            'logoutAfterChangeEmail.boolean' => 'Erro no tipo de dado enviado',

            'mustVerifyEmail.required' => 'Informe sobre `Validação de e-mail`',
            'mustVerifyEmail.boolean' => 'Erro no tipo de dado enviado',

            'saveUpdates_branches.required' => 'Informe sobre `Usuários`',
            'saveUpdates_branches.boolean' => 'Erro no tipo de dado enviado',

            'saveUpdates_clients.required' => 'Informe sobre `Clientes`',
            'saveUpdates_clients.boolean' => 'Erro no tipo de dado enviado',

            'saveUpdates_permissions.required' => 'Informe sobre `Permissões`',
            'saveUpdates_permissions.boolean' => 'Erro no tipo de dado enviado',

            'saveUpdates_roles.required' => 'Informe sobre `Papéis`',
            'saveUpdates_roles.boolean' => 'Erro no tipo de dado enviado',

            'saveUpdates_userRolesPermissions.required' => 'Informe sobre `Controle de Acesso`',
            'saveUpdates_userRolesPermissions.boolean' => 'Erro no tipo de dado enviado',

            'saveUpdates_users.required' => 'Informe sobre `Usuários`',
            'saveUpdates_users.boolean' => 'Erro no tipo de dado enviado'
        ];
    }
}
