<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function acl()
    {
        if (auth()->user()->hasRole(['Super Admin', 'Admin'])) {
            return Inertia::render('Admin/Acl', [
                'back' => ['url' => url()->previous() ?? '', 'method' => Route::current()->methods()[0]],
                'forward' => url()->previous() ?? '',
            ]);
        }
        return Inertia::render('Admin/403');
    }

    public function index()
    {
        $permissions = Permission::all(['id', 'name'])->toArray();

        dd($permissions);
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::permissions.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permission = Permission::create($data);

        $permission->syncRoles($request->input('roles'));

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }

    public function edit(Permission $permission): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permission->update($data);

        $permission->syncRoles($request->input('roles'));

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.edit', 7);
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }
}
