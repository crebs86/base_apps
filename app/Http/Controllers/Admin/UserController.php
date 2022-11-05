<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Traits\ACL;

class UserController extends Controller
{
    use ACL;
    /**
     * página inicial de controle de acesso de usuários
     */
    public function index(Request $request)
    {
        if ($this->can('ACL Editar', 'ACL Ver', 'ACL Criar', 'ACL Apagar')) {
            return Inertia::render('Admin/AclUsers');
        }
        return Inertia::render('Admin/403');
    }
    /**
     * Paginação do uruário
     */
    public function list(Request $request)
    {
        if ($this->can('ACL Ver', 'ACL Editar')) {
            if (!$request->user) {
                $user = User::paginate(50)->through(
                    function ($user) {
                        return $this->setUsers($user);
                    }
                );
            } else {
                $user = $this->findUsers($request->user);
            }

            return Inertia::render('Admin/AclUsers', [
                'users' => $user,
                'keyword' => $request->user ?? ''
            ]);
        }
        return Inertia::render('Admin/403');
    }
    /**
     * Pesquisa por usuários na base de dados;
     * termos aproximados: name e email;
     * termos exatos: id e CPF.
     */
    private function findUsers(string $keyword)
    {
        $x = [
            'len' => strlen($keyword),
            'is_num' => is_numeric(str_replace('.', '', str_replace('-', '', $keyword)))
        ];
        if (!($x['is_num']) && $x['len'] < 4) {
            return [];
        }
        return User::select('id', 'name', 'email', 'cpf', 'active')
            ->where(
                function ($q) use ($keyword, $x) {
                    if ($x['is_num'] && $x['len'] < 11) {
                        return $q->where('id', str_replace('.', '', str_replace('-', '', $keyword)));
                    } elseif ($x['is_num'] && $x['len'] === 11) {
                        return $q->where('cpf', str_replace('.', '', str_replace('-', '', $keyword)));
                    }
                    return $q;
                }
            )
            ->orWhere(
                function ($q) use ($keyword, $x) {
                    if (!($x['is_num']) && $x['len'] >= 4) {
                        return $q->where('name', 'like', '%' . $keyword . '%');
                    }
                    return $q;
                }
            )
            ->orWhere(
                function ($q) use ($keyword, $x) {
                    if (!$x['is_num'] && $x['len'] >= 4) {
                        return $q->where('email', 'like', '%' . $keyword . '%');
                    }
                    return $q;
                }
            )
            ->paginate(50)->through(
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

    public function listUserAndRoles(Request $request)
    {
        return $this->showUserAndRoles($request);
    }
    /**
     * página exibe dados básicos do usuário e papéis vinculados a este
     */
    public function showUserAndRoles(Request $request)
    {
        if ($this->can('ACL Ver', 'ACL Editar')) {
            $userRoles = $this->getUserRoles($request->id);
            $allRoles = Role::orderBy('name')
                ->where(function ($q) {
                    if (!$this->hasRole(config('crebs86.admin_roles_edit'))) {
                        $a = [];
                        foreach (config('crebs86.admin_roles') as $v) {
                            $a[] = ['name', '<>', $v];
                        }
                        $q->where($a);
                    } else {
                        $q;
                    }
                })
                ->select(['id', 'name'])
                ->get()->toArray();

            $r = $userRoles->toArray();

            if (isset($r['roles'])) {
                $ur = $this->setCurrentRoles($allRoles, $r);
            }
            $edit = true;
            if ($userRoles->hasRole(config('crebs86.admin_roles'))) {
                $edit = $this->hasRole(config('crebs86.admin_roles_edit'));
            }

            return Inertia::render('Admin/UserRoles', [
                'user' => $userRoles,
                'userRoles' => $ur,
                'edit' => $edit,
                '_checker' => setGetKey($request->id, 'edit_user_role')
            ]);
        }
        return Inertia::render('Admin/403');
    }
    /**
     * define a situação de cada papél em relaçao ao usuário
     */
    private function setCurrentRoles($allRoles, $r)
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
    private function getUserRoles($id)
    {
        return User::select('id', 'name', 'cpf', 'email')->where('id', $id)
            ->with(
                [
                    'roles' => function ($q) {
                        $q->select('id', 'name')->orderBy('id');
                    }
                ]
            )
            ->first();
    }
    /**
     * Sincroniza papéis dos usuários
     */
    public function editUserRole(Request $request)
    {
        $r = $request->all();
        $hasNoPrivileges = !$this->hasRole(config('crebs86.admin_roles_edit'));
        if (count(array_intersect($r['roles'], config('crebs86.admin_roles'))) > 0 && $hasNoPrivileges) {
            return response()->json('Papéis de usuário: você não possui permissão para editar papél administrador', 403);
        }
        if ($this->can('ACL Editar')) {
            if (getKeyValue($r['_checker'], 'edit_user_role') === $request->id) {
                $user = User::where('id', $request->id)->first();
                if ($user->hasRole(config('crebs86.admin_roles')) && $hasNoPrivileges) {
                    return response()->json('Papéis de usuário: você não possui permissão para editar usuário administrador', 403);
                }
                return
                    $user->syncRoles($r['roles']);
            }
            return response()->json('Payload: erro ao acessar aplicação', 403);
        }
        return response()->json('Papéis de usuário: você não possui permissão para acessar este recurso', 403);
    }
}
