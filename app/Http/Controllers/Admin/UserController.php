<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
    }
    /**
     * responde ao formulário de pesqiosa de usuários
     */
    public function search(Request $request)
    {
        return response()->json([
            'users' => $this->findUsers($request->search)
        ]);
    }

    /**
     * Pesquisa por usuários na base de dados;
     * termos aproximados: name e email;
     * termos exatos: id e CPF.
     */
    private function findUsers(string $keyword)
    {
        return User::where('id', $keyword)
            ->orWhere('name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('cpf', $keyword)
            ->paginate(2)->through(
                function ($user) {
                    return $this->setUser($user);
                }
            );
    }
    /**
     * lança dados da pesquisa do usuário em um array
     */
    private function setUser($user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'cpf' => $user->cpf,
            'active' => $user->active
        ];
    }


    public function show(Request $request)
    {
    }

    public function listUserAndRoles(Request $request)
    {
        return $this->showUserAndRoles($request, false);
    }
    /**
     * página exibe dados básicos do usuário e papéis vinculados a este
     */
    public function showUserAndRoles(Request $request, $edit = true)
    {

        $userRoles = $this->getUserRoles($request->id);
        $allRoles = cache()->rememberForever('role_id_name', function () {
            return Role::orderBy('name')->select(['id', 'name'])->get()->toArray();
        });

        $r = $userRoles[0];

        if (isset($r['roles'])) {
            $ur = $this->setCurrentRoles($allRoles, $r);
        }

        return Inertia::render('Admin/UserRoles', [
            'user' => $userRoles,
            'userRoles' => $ur,
            'edit' => $edit,
            '_checker' => setGetKey($request->id, 'edit_role')
        ]);
    }
    /**
     * define a situação de cada papél em relaçao ao usuário
     */
    function setCurrentRoles($allRoles, $r)
    {
        $ur = [];
        foreach ($allRoles as $ar) {
            $ur[] = [
                'id' => $ar['id'],
                'name' => $ar['name'],
                'has' => in_array(
                    $ar['id'],
                    array_column($r['roles'], 'id')
                ) ? true : false
            ];
        }
        return $ur;
    }

    /**
     * busca papeis de usuários
     */
    public function getUserRoles($id)
    {
        return User::select('id', 'name', 'cpf', 'email')->where('id', $id)
            ->with(
                [
                    'roles' => function ($q) {
                        $q->select('id', 'name')->orderBy('id');
                    }
                ]
            )
            ->get()->toArray();
    }
    /**
     * Sincroniza papéis dos usuários
     */
    public function editUserRole(Request $request)
    {
        $r = $request->all();
        if (getKeyValue($r['_checker'], 'edit_role') === $request->id) {
            return User::get('id', $request->id)->first()->syncRoles($r['roles']);
        }
        return false;
    }
}
