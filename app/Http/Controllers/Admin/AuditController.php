<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ACL;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Branch;
use App\Models\Client;
use App\Traits\Helpers;
use App\Models\AclUpdate;
use App\Models\RoleUpdate;
use App\Models\UserUpdate;
use App\Models\BranchUpdate;
use App\Models\ClientUpdate;
use Illuminate\Http\Request;
use App\Models\PermissionUpdate;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class AuditController extends Controller
{
    use ACL, Helpers;

    public function index(): Response
    {
        if ($this->isSuperAdmin()) {
            return Inertia::render('Admin/Audit', []);
        }
        return Inertia::render('Admin/403');
    }

    public function client(Request $request): Response
    {
        if ($this->isSuperAdmin()) {
            if ($request->client) {
                $client = Client::select('id', 'name', 'email', 'cpf', 'notes', 'updated_at')->withTrashed()->find($request->client);
            }
            return Inertia::render('Admin/AuditClients', [
                'client' => isset($client) ? $client : null,
                'keyword' => $request->client
            ]);
        }
        return Inertia::render('Admin/403');
    }

    public function clientShow(Request $request, ClientUpdate $clientUpdate)
    {
        $client = $clientUpdate->where('id', $request->client)->first();
        $users = User::select('id', 'name')->withTrashed()->find(json_decode($client?->updates)?->user_id)?->toArray();
        $branches = Branch::select('id', 'name')->withTrashed()->find(json_decode($client?->updates)?->branch_id)?->toArray();
        $updates = json_decode($client?->updates);
        if ($this->isSuperAdmin()) {
            return response()->json(
                [
                    'clientData' => $updates,
                    'users' => collect($users)->merge([0 => ['id' => 0, 'name' => 'Cadastro Original']])->keyBy('id')->all(),
                    'branches' => collect($branches)->keyBy('id')->all()
                ],
                $updates ? 200 : 404
            );
        }
        return Inertia::render('Admin/403');
    }

    public function branch(Request $request): Response
    {
        if ($this->isSuperAdmin()) {
            if ($request->branch) {
                $branch = Branch::select('id', 'name', 'email', 'cep', 'cnpj', 'phones', 'address', 'notes', 'deleted_at', 'updated_at')
                    ->withTrashed()->find($request->branch);
            }
            return Inertia::render('Admin/AuditBranches', [
                'branch' => isset($branch) ? $branch : null,
                'keyword' => $request->branch
            ]);
        }
        return Inertia::render('Admin/403');
    }

    public function branchShow(Request $request, BranchUpdate $branchUpdate)
    {
        $branch = $branchUpdate->where('id', $request->branch)->first();
        $users = User::select('id', 'name')->withTrashed()->find(json_decode($branch?->updates)?->user_id)?->toArray();
        $updates = json_decode($branch?->updates);
        if ($this->isSuperAdmin()) {
            return response()->json(
                [
                    'branchData' => $updates,
                    'users' => collect($users)->merge([0 => ['id' => 0, 'name' => 'Cadastro Original']])->keyBy('id')->all(),
                ],
                $updates ? 200 : 404
            );
        }
        return Inertia::render('Admin/403');
    }

    public function user(Request $request): Response
    {
        if ($this->isSuperAdmin()) {
            if ($request->user) {
                $user = User::select('id', 'name', 'email', 'cpf', 'notes', 'updated_at')->withTrashed()->find($request->user);
            }
            return Inertia::render('Admin/AuditUsers', [
                'user' => isset($user) ? $user : null,
                'keyword' => $request->user
            ]);
        }
        return Inertia::render('Admin/403');
    }

    public function userShow(Request $request, UserUpdate $userUpdate)
    {
        $user = $userUpdate->where('id', $request->user)->first();
        $users = User::select('id', 'name')->withTrashed()->find(json_decode($user?->updates)?->user_id)?->toArray();
        $branches = Branch::select('id', 'name')->withTrashed()->find(json_decode($user?->updates)?->branch_id)?->toArray();
        $updates = json_decode($user?->updates);
        if ($this->isSuperAdmin()) {
            return response()->json(
                [
                    'userData' => $updates,
                    'users' => collect($users)->merge([0 => ['id' => 0, 'name' => 'Cadastro Original']])->keyBy('id')->all(),
                    'branches' => collect($branches)->keyBy('id')->all()
                ],
                $updates ? 200 : 404
            );
        }
        return Inertia::render('Admin/403');
    }

    public function permission(Request $request): Response
    {
        if ($this->isSuperAdmin()) {
            if ($request->permission) {
                $permission = Permission::select('id', 'name', 'guard_name', 'updated_at')->find($request->permission);
            }
            return Inertia::render('Admin/AuditPermissions', [
                'permission' => isset($permission) ? $permission : null,
                'keyword' => $request->permission
            ]);
        }
        return Inertia::render('Admin/403');
    }

    public function permissionShow(Request $request, PermissionUpdate $permissionUpdate)
    {
        $permission = $permissionUpdate->where('id', $request->permission)->first();
        $users = User::select('id', 'name')->withTrashed()->find(json_decode($permission?->updates)?->user_id)?->toArray();
        $updates = json_decode($permission?->updates);
        if ($this->isSuperAdmin()) {
            return response()->json(
                [
                    'permissionData' => $updates,
                    'users' => collect($users)->merge([0 => ['id' => 0, 'name' => 'Cadastro Original']])->keyBy('id')->all()
                ],
                $updates ? 200 : 404
            );
        }
        return Inertia::render('Admin/403');
    }

    public function role(Request $request): Response
    {
        if ($this->isSuperAdmin()) {
            if ($request->role) {
                $role = Role::select('id', 'name', 'guard_name', 'updated_at')->find($request->role);
            }
            return Inertia::render('Admin/AuditRoles', [
                'role' => isset($role) ? $role : null,
                'keyword' => $request->role
            ]);
        }
        return Inertia::render('Admin/403');
    }

    public function roleShow(Request $request, RoleUpdate $roleUpdate)
    {
        $role = $roleUpdate->where('id', $request->role)->first();
        $users = User::select('id', 'name')->withTrashed()->find(json_decode($role?->updates)?->user_id)?->toArray();
        $updates = json_decode($role?->updates);

        $a = [];
        if ($updates) {
            foreach ($updates->permissions as $i) {
                foreach ($i as $v) {
                    $a[$v] = $v;
                }
            }
        }

        if ($this->isSuperAdmin()) {
            return response()->json(
                [
                    'roleData' => $updates,
                    'permissions' => collect(Permission::select('id', 'name')->find($a))->keyBy('id')->all(),
                    'users' => collect($users)->merge([0 => ['id' => 0, 'name' => 'Cadastro Original']])->keyBy('id')->all()
                ],
                $updates ? 200 : 404
            );
        }
        return Inertia::render('Admin/403');
    }

    public function acl(Request $request): Response
    {
        if ($this->isSuperAdmin()) {
            if ($request->user) {
                $user = User::select('id', 'name', 'updated_at')
                    ->with(
                        [
                            'roles' => function ($q) {
                                $q->select('id', 'name')->orderBy('id');
                            }
                        ]
                    )
                    ->find($request->user);
            }
            return Inertia::render('Admin/AuditAcl', [
                'user' => isset($user) ? $user : null,
                'keyword' => $request->user
            ]);
        }
        return Inertia::render('Admin/403');
    }

    public function aclShow(Request $request, AclUpdate $aclUpdate)
    {
        $role = $aclUpdate->where('id', $request->user)->first();
        $users = User::select('id', 'name')->withTrashed()->find(json_decode($role?->updates)?->user_id)?->toArray();
        $updates = json_decode($role?->updates);
        $a = [];

        if ($updates) {
            foreach ($updates->roles as $i) {
                foreach ($i as $v) {
                    $a[$v] = $v;
                }
            }
        }

        if ($this->isSuperAdmin()) {
            return response()->json(
                [
                    'aclData' => $updates ? collect($updates)
                        ->prepend(
                            array_merge(
                                ['0000-00-00'],
                                is_array($updates->updated_at) ? $updates->updated_at : [$updates->updated_at]
                            ),
                            'updated_at'
                        )
                        ->all()
                        : null,
                    'roles' => collect(Role::select('id', 'name')->find($a))->keyBy('id')->all(),
                    'users' => collect($users)->merge([0 => ['id' => 0, 'name' => 'Cadastro Original']])->keyBy('id')->all()
                ],
                $updates ? 200 : 404
            );
        }
        return Inertia::render('Admin/403');
    }
}
