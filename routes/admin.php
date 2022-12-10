<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PermissionController;

Route::middleware(['auth', 'verified'])->prefix('/dashboard')->group(function () {
    Route::get('/account', [UserController::class, 'account'])->name('user.account');
    Route::post('/account', [UserController::class, 'updateAccount'])->name('user.account.update');
    Route::post('/account/update-password', [UserController::class, 'updatePassword'])->name('user.account.update.password');

    Route::resource('/branches', BranchController::class)->withTrashed();
    Route::put('/branches/{branch}/restore', [BranchController::class, 'restore'])->name('branches.restore')->withTrashed();
    Route::resource('/clients', ClientController::class)->withTrashed(['show', 'edit', 'update']);
    Route::put('/clients/{client}/restore', [ClientController::class, 'restore'])->name('clients.restore')->withTrashed();
});

Route::middleware(['auth', 'verified'])->prefix('admin/acl')->name('admin.acl.')->group(function () {
    Route::get('/', [PermissionController::class, 'acl'])->name('acl');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/list/form', [PermissionController::class, 'getPermissionsListForm'])->name('permissions.list.form');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}/update', [PermissionController::class, 'update'])->name('permissions.permission.update');
    Route::post('/permissions/new', [PermissionController::class, 'new'])->name('permissions.new');
    Route::get('/permissions/{id}/listUsers', [PermissionController::class, 'listUsers'])->name('permissions.list.users');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{id}/edit', [RoleController::class, 'show'])->name('roles.show');
    Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.permissions.update');
    Route::post('/roles/new', [RoleController::class, 'new'])->name('roles.new');
    Route::get('/roles/{id}/listUsers', [RoleController::class, 'listUsers'])->name('roles.list.users');


    Route::resource('/users', UserController::class);
    Route::get('/users/{user?}', [UserController::class, 'list'])->name('users.list');
    Route::post('/users/{id}/verifyEmail', [UserController::class, 'userVerifyEmail'])->name('users.verify.email');
    Route::post('/users/{id}/requireEmailVerification', [UserController::class, 'requireEmailVerification'])->name('users.require.email.verification');
    Route::get('/users/{id}/roles/list', [UserController::class, 'listUserAndRoles'])->name('users.roles.list');
    Route::get('/users/{id}/roles/edit', [UserController::class, 'showUserAndRoles'])->name('users.roles.show');
    Route::post('/users/{id}/roles/edit', [UserController::class, 'editUserRole'])->name('users.roles.edit');
});
