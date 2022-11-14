<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Traits\ACL;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    use ACL;
    /**
     * Exibe todas os Papéis com todas as permissões
     */
    public function index(): Response
    {
        if ($this->can('ACL Ver', 'ACL Editar', 'ACL Apagar', 'ACL Criar')) {

            $roles = Role::with([
                'permissions' => function ($q) {
                    return $q->select('id', 'name')->orderBy('name');
                }
            ])
                ->whereNot('name', ['Super Admin'])
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
                ->select('id', 'name')
                ->get()
                ->toArray();
            return Inertia::render('Admin/Roles', [
                'rolesWithPermissions' => $roles,
                'new' => $this->can('ACL Criar')
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Exibe um papél específico para edição
     */
    public function show(Request $request, Role $role): Response
    {
        if ($this->can('ACL Ver', 'ACL Editar', 'ACL Apagar')) {

            $permissions = Permission::orderBy('name')->get(['id', 'name'])->toArray();

            $roleWithPermissions = $role::with([
                'permissions' => function ($q) {
                    return $q->orderBy('name')->select('id', 'name');
                }
            ])
                ->whereNot('name', 'Super Admin')
                ->where('id', $request->id)->select('id', 'name')->get()->toArray();
            /**
             * se papél não existir ou necessitar de privilégios elevados não designados ao usuário
             */
            if (
                !isset($roleWithPermissions[0]) //papél existe
                || !(array_intersect([$roleWithPermissions[0]['name']], config('crebs86.admin_roles')) > 0 //é um papél protegido?...
                    && $this->hasRole(config('crebs86.admin_roles_edit'))) //..e usuário tem privilégio?
            ) {
                return Inertia::render('Admin/403');
            }

            if (count($roleWithPermissions[0]['permissions']) > 0) {
                foreach ($permissions as $p) {
                    $rp[] = [
                        'id' => $p['id'],
                        'name' => $p['name'],
                        'has' => in_array(
                            $p['id'],
                            array_column($roleWithPermissions[0]['permissions'], 'id')
                        ) ? true : false
                    ];
                }
            } else {
                foreach ($permissions as $v) {
                    $rp[] = ['id' => $v['id'], 'name' => $v['name'], 'has' => false];
                }
            }

            return Inertia::render('Admin/RoleEdit', [
                'role' => $roleWithPermissions,
                'permissions' => $rp,
                '_checker' => setGetKey($request->id, 'edit_role_permissions')
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * atualiza nome do papel e suas permissões
     */
    public function update(Request $request): JsonResponse|null
    {

        if (
            $this->can('ACL Editar')
            && array_intersect([$request->name], config('crebs86.admin_roles')) > 0 //é um papél protegido?...
            && $this->hasRole(config('crebs86.admin_roles_edit')) //... e usuário possui privilégios?
        ) {
            $request->validate([
                'name' => ['required', 'string'],
                'permissions' => ['array'],
            ]);

            $role = Role::where('name', $request->name)
                ->select('id', 'name', 'guard_name')
                ->first();
            $role->update(['name' => $request->input('name')]);

            $role->syncPermissions($request->input('permissions'));
            return null;
        } else {
            return response()->json('Permissões em papéis: Você não possui permissão para acessar este recurso', 403);
        }
    }
    /**
     * Cria novo papél
     */
    public function new(RoleRequest $request): JsonResponse
    {
        if ($this->can('ACL Criar')) {
            $request->validated();

            $role = Role::create(['name' => $request->input('name')]);

            $role->givePermissionTo($request->input('permissions'));

            return response()->json([
                "message" => "Papél `{$request->name}` Criado Com Sucesso",
                "rolesWithPermissions" => Role::with([
                    'permissions' => function ($q) {
                        return $q->select('id', 'name')->orderBy('name');
                    }
                ])
                    ->whereNot('name', ['Super Admin'])
                    ->select('id', 'name')->get()->toArray()
            ], 200);
        }
        return response()->json(['message' => 'Novo Papél: Você não possui permissão para acessar este recurso'], 403);
    }
}
