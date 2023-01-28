<?php

use App\Models\Setting;
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

Route::get('/', [MiscController::class, 'home'])->name('home');

Route::get('/painel', [MiscController::class, 'dashboard'])->middleware(
    json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
        return Setting::where('name', 'general')->first();
    })->settings)->mustVerifyEmail[1] ? ['auth', 'verified'] : ['auth']
)->name('dashboard');

Route::any('pagina-expirada/', [MiscController::class, 'redirect'])->name('redirect');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
