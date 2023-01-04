<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ACL;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\PermissionUpdate;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\PermissionRequest;
use App\Traits\Helpers;

class PermissionController extends Controller
{
    use ACL, Helpers;
    /**
     * página inicial do controle de acesso
     */
    public function acl(): Response
    {
        if ($this->can('ACL Ver', 'ACL Criar', 'ACL Editar', 'ACL Apagar')) {
            return Inertia::render('Admin/Acl', [
                'back' => ['url' => url()->previous() ?? '', 'method' => Route::current()->methods()[0]],
                'forward' => url()->previous() ?? '',
            ]);
        }
        return Inertia::render('Admin/403');
    }
    /**
     * página inicial das permissões
     */
    public function index(): Response
    {
        if ($this->can('ACL Ver', 'ACL Editar', 'ACL Apagar', 'ACL Criar')) {

            $permissions = $this->permissions(true);

            return Inertia::render('Admin/Permissions', [
                'permissions' => $permissions,
                'new' => $this->can('ACL Criar')
            ]);
        }
        return Inertia::render('Admin/403');
    }
    /**
     * retorna lista de permissões: id e name
     */
    public function getPermissionsListForm(): JsonResponse
    {
        return response()->json($this->permissions());
    }
    /**
     * retorna permissões do banco de dados
     */
    private function permissions(bool $checkCanEdit = false): array
    {
        $permissions = Permission::all(['id', 'name'])->toArray();

        if ($checkCanEdit) {
            foreach ($permissions as $permission) {
                $p[] = ['id' => $permission['id'], 'name' => $permission['name'], 'can' => !in_array($permission['name'], config('crebs86.protected_permissions'))];
            }
        } else {
            foreach ($permissions as $permission) {
                $p[] = ['id' => $permission['id'], 'name' => $permission['name'], 'has' => false];
            }
        }
        return $p;
    }
    /**
     * cria uma nova permissão
     */
    public function new(PermissionRequest $request): JsonResponse
    {
        if ($this->can('ACL Criar')) {
            $data = $request->validated();

            Permission::create($data);

            return response()->json([
                "message" => "Permissão `{$request->name}` Criada Com Sucesso",
                "permissions" => $this->permissions(true)
            ], 200);
        }
        return response()->json(['message' => 'Nova Permissão: Você não possui permissão para acessar este recurso'], 403);
    }
    /**
     * formulário para edição de permissão
     */
    public function edit(Request $request, Permission $permissions): Response
    {
        if ($this->can('ACL Editar')) {

            $permission = $permissions->select('id', 'name')->find($request->id);

            if (!in_array($permission->name, config('crebs86.protected_permissions'))) {

                return Inertia::render('Admin/PermissionEdit', [
                    'permission' => $permission,
                    '_checker' => setGetKey($request->id, 'edit_permission')
                ]);
            }
        }
        return Inertia::render('Admin/403');
    }
    /**
     * atualiza permissão no banco de dados
     */
    public function update(PermissionRequest $request): JsonResponse|null
    {
        if (
            $this->can('ACL Editar')
            && !in_array($request->name, config('crebs86.protected_permissions')) //é uma permissão protegida?...
        ) {
            if ((int) getKeyValue($request->_checker, 'edit_permission') === (int) $request->id) {
                $permission = Permission::select('id', 'name', 'guard_name', 'updated_at')
                    ->where('id', $request->id)
                    ->first();
                $p = collect($permission)->all();
                if ($permission->name === $request->input('name') || in_array($permission->name, config('crebs86.protected_permissions'))) {
                    return response()->json([
                        'message' => 'Permissões: Nenhuma alteração foi feita',
                        'reload' => in_array($permission->name, config('crebs86.protected_permissions'))
                    ], 418);
                }
                $updated = $permission->update(['name' => $request->input('name')]);
                $this->auditable('permissions') ? $this->saveUpdates($p, $permission, PermissionUpdate::class, ['name', 'guard_name', 'updated_at']) : null;
                return null;
            }
            return response()->json(['message' => 'Payload: erro ao acessar aplicação'], 403);
        }
        return response()->json(['message' => 'Permissões: Você não possui permissão para editar esta permissão'], 403);
    }
    public function listUsers(Request $request): Response
    {
        if ($this->can('ACL Ver', 'ACL Editar', 'ACL Apagar')) {
            $permission = Permission::where('id', $request->id)->select('name')->first();
            if ($permission) {
                return Inertia::render(
                    'Admin/PermissionListUsers',
                    [
                        'users' => User::permission($permission->name)->select('id', 'name', 'cpf')->get()->toArray(),
                        'permission' => $permission
                    ]
                );
            }
        }
        return Inertia::render('Admin/403');
    }
}
