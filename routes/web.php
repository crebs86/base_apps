<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MiscController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MiscController::class, 'home']);

Route::get('/painel', [MiscController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::any('pagina-expirada/', [MiscController::class, 'redirect'])->name('redirect');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
