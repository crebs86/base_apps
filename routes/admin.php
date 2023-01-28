<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PermissionController;
use App\Models\Setting;

Route::prefix('/dashboard')->middleware(
    json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
        return Setting::where('name', 'general')->first();
    })->settings)->mustVerifyEmail[1] ? ['auth', 'verified'] : ['auth']
)->group(function () {
    Route::get('/conta', [UserController::class, 'account'])->name('user.account');
    Route::post('/conta', [UserController::class, 'updateAccount'])->name('user.account.update');
    Route::post('/conta/update-password', [UserController::class, 'updatePassword'])->name('user.account.update.password');

    Route::resource('/unidades', BranchController::class, ['names' => 'branches'])->parameter('unidades', 'branch')->withTrashed(['show', 'edit', 'update', 'restore']);
    Route::put('/unidades/{branch}/restore', [BranchController::class, 'restore'])->name('branches.restore')->withTrashed();

    Route::resource('/clientes', ClientController::class, ['names' => 'clients'])->parameter('clientes', 'client')->withTrashed(['show', 'edit', 'update', 'restore']);
    Route::put('/clientes/{client}/restore', [ClientController::class, 'restore'])->name('clients.restore')->withTrashed();

    Route::resource('/configuracoes', SettingController::class, ['names' => 'settings'])->parameter('configuracoes', 'setting')->except(['destroy', 'create', 'store', 'show', 'edit']);

    Route::get('/auditar', [AuditController::class, 'index'])->name('audit.index');

    Route::get('/auditar/clientes', [AuditController::class, 'client'])->name('audit.clients.index');
    Route::get('/auditar/clientes/{client}', [AuditController::class, 'clientShow'])->name('audit.clients.show');

    Route::get('/auditar/unidades', [AuditController::class, 'branch'])->name('audit.branches.index');
    Route::get('/auditar/unidades/{branch}', [AuditController::class, 'branchShow'])->name('audit.branches.show');

    Route::get('/auditar/usuarios', [AuditController::class, 'user'])->name('audit.users.index');
    Route::get('/auditar/usuarios/{user}', [AuditController::class, 'userShow'])->name('audit.users.show');

    Route::get('/auditar/permissoes', [AuditController::class, 'permission'])->name('audit.permissions.index');
    Route::get('/auditar/permissoes/{permission}', [AuditController::class, 'permissionShow'])->name('audit.permissions.show');

    Route::get('/auditar/papeis', [AuditController::class, 'role'])->name('audit.roles.index');
    Route::get('/auditar/papeis/{role}', [AuditController::class, 'roleShow'])->name('audit.roles.show');

    Route::get('/auditar/controle-de-acesso', [AuditController::class, 'acl'])->name('audit.acl.index');
    Route::get('/auditar/controle-de-acesso/{user}', [AuditController::class, 'aclShow'])->name('audit.acl.show');

    Route::get('/auditar/configuracoes', [AuditController::class, 'setting'])->name('audit.setting.index');
    Route::get('/auditar/configuracoes/{setting}', [AuditController::class, 'settingShow'])->name('audit.setting.show');
});

Route::prefix('admin/controle-de-acessos')->middleware(
    json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
        return Setting::where('name', 'general')->first();
    })->settings)->mustVerifyEmail[1] ? ['auth', 'verified'] : ['auth']
)->name('admin.acl.')->group(function () {
    Route::get('/', [PermissionController::class, 'acl'])->name('acl');

    Route::get('/permissoes', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissoes/list/form', [PermissionController::class, 'getPermissionsListForm'])->name('permissions.list.form');
    Route::get('/permissoes/{id}/editar', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissoes/{id}/update', [PermissionController::class, 'update'])->name('permissions.permission.update');
    Route::post('/permissoes/new', [PermissionController::class, 'new'])->name('permissions.new');
    Route::get('/permissoes/{id}/listar-usuarios', [PermissionController::class, 'listUsers'])->name('permissions.list.users');

    Route::get('papeis', [RoleController::class, 'index'])->name('roles.index');
    Route::get('papeis/{id}/editar', [RoleController::class, 'show'])->name('roles.show');
    Route::post('papeis/{id}/update', [RoleController::class, 'update'])->name('roles.permissions.update');
    Route::post('papeis/new', [RoleController::class, 'new'])->name('roles.new');
    Route::get('papeis/{id}/listar-usuarios', [RoleController::class, 'listUsers'])->name('roles.list.users');

    Route::resource('/usuarios', UserController::class, ['names' => 'users'])->parameter('usuarios', 'user');

    Route::get('/usuarios/{user?}', [UserController::class, 'list'])->name('users.list');
    Route::post('/usuarios/{id}/verifyEmail', [UserController::class, 'userVerifyEmail'])->name('users.verify.email');
    Route::post('/usuarios/{id}/requireEmailVerification', [UserController::class, 'requireEmailVerification'])->name('users.require.email.verification');
    Route::get('/usuarios/{id}/papeis/listar', [UserController::class, 'listUserAndRoles'])->name('users.roles.list');
    Route::get('/usuarios/{id}/papeis/editar', [UserController::class, 'showUserAndRoles'])->name('users.roles.show');
    Route::post('/usuarios/{id}/papeis/editar', [UserController::class, 'editUserRole'])->name('users.roles.edit');
});
