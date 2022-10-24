<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;


Route::middleware('auth')->prefix('admin/acl')->name('admin.acl.')->group(function () {
    Route::get('/', [PermissionController::class, 'acl'])->name('acl');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('index');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/role/{id}/edit', [RoleController::class, 'show'])->name('role.show');
    Route::post('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');

    Route::post('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/user/{id}/roles/list', [UserController::class, 'listUserAndRoles'])->name('user.roles.list');
    Route::get('/user/{id}/roles/show', [UserController::class, 'showUserAndRoles'])->name('user.roles.show');
    Route::post('/user/{id}/roles/edit', [UserController::class, 'editUserRole'])->name('user.roles.edit');
});
