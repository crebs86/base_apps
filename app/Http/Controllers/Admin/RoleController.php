<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    private $protectedPermissions = [
        'Admin Apagar', 'Admin Criar', 'Admin Editar', 'Admin Ver',
        'Cliente Apagar', 'Cliente Criar', 'Cliente Editar', 'Cliente Ver',
        'Usuario Apagar', 'Usuario Criar', 'Usuario Editar', 'Usuario Ver'
    ];
    /**
     * Exibe todas os Papéis com todas as permissões
     */
    public function index()
    {
        dd(auth()->user()->can(['ACL Ver', 'ACL Editar']));
        if (auth()->user()->hasAnyPermission(['ACL Ver', 'ACL Editar'])) {
            //if (auth()->user()->hasAnyPermission(['ACL Ver', 'ACL Editar'])) {
            $roles = Role::with([
                'permissions' => function ($q) {
                    return $q->select('id', 'name');
                }
            ])->select('id', 'name')->get()->toArray();
            return Inertia::render('Admin/Roles', [
                'rolesWithPermissions' => $roles
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Exibe um papél específico para edição
     */
    public function show(Request $request, Role $role)
    {
        if (auth()->user()->hasAnyPermission(['ACL Ver', 'ACL Editar'])) {
            $permissions = Permission::orderBy('name')->get(['id', 'name'])->toArray();

            $roleWithPermissions = $role::with([
                'permissions' => function ($q) {
                    return $q->orderBy('name')->select('id', 'name');
                }
            ])->where('id', $request->id)->select('id', 'name')->get()->toArray();

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
    public function update(Request $request)
    {
        if (!auth()->user()->hasRole(['Super Admin', 'Admin']) || auth()->user()->can('ACL Editar')) {
            $request->validate([
                'name' => ['required', 'string'],
                'permissions' => ['array'],
            ]);

            $role = Role::where('name', $request->name)
                ->select('id', 'name', 'guard_name')
                ->first();
            $role->update(['name' => $request->input('name')]);

            $role->syncPermissions($request->input('permissions'));
        } else {
            return response()->json('Permissões em papéis: Você não possui permissão para acessar este recurso', 403);
        }
    }




    public function create(): View
    {
        $permissions = Permission::pluck('name', 'id');

        return view('PermissionsUI::roles.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        $role->givePermissionTo($request->input('permissions'));

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }
}
