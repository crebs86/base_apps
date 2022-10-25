<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Exibe todas os Papéis com todas as permissões
     */
    public function index()
    {
        $roles = cache()->rememberForever('roles_with_permissions', function () {
            return Role::with([
                'permissions' => function ($q) {
                    return $q->select('id', 'name');
                }
            ])->select('id', 'name')->get()->toArray();
        });
        return Inertia::render('Admin/Roles', [
            'rolesWithPermissions' => $roles
        ]);
    }

    /**
     * Exibe um papél específico para edição
     */
    public function show(Request $request, Role $role)
    {
        $permissions = cache()->rememberForever('permissions_id_name', function () {
            return Permission::orderBy('name')->get(['id', 'name'])->toArray();
        });

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

    /**
     * atualiza nome do papel e suas permissões
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role = Role::where('name', $request->name)
            ->select('id', 'name', 'guard_name')
            ->first();
        $role->update(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permissions'));
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
