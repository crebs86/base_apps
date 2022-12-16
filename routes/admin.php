<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;

Route::middleware(!true ? ['auth', 'verified'] : ['auth'])->prefix('/dashboard')->group(function () {
    Route::get('/conta', [UserController::class, 'account'])->name('user.account');
    Route::post('/conta', [UserController::class, 'updateAccount'])->name('user.account.update');
    Route::post('/conta/update-password', [UserController::class, 'updatePassword'])->name('user.account.update.password');

    Route::resource('/unidades', BranchController::class, ['names' => 'branches'])->parameter('unidades', 'branch')->withTrashed(['show', 'edit', 'update', 'restore']);
    Route::put('/unidades/{branch}/restore', [BranchController::class, 'restore'])->name('branches.restore')->withTrashed();

    Route::resource('/clientes', ClientController::class, ['names' => 'clients'])->parameters(['clientes' => 'client'])->withTrashed(['show', 'edit', 'update', 'restore']);
    Route::put('/clientes/{client}/restore', [ClientController::class, 'restore'])->name('clients.restore')->withTrashed();

    Route::resource('/configuracoes', SettingController::class)->parameters(['configuracoes' => 'setting'])->parameter('settings', 'configuracoes')->except(['destroy', 'create', 'store']);
});

Route::middleware(!true ? ['auth', 'verified'] : ['auth'])->prefix('admin/controle-de-acessos')->name('admin.acl.')->group(function () {
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
