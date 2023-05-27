<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

Route::get('/instalar/auto', function () {
    if (Schema::hasTable('users')) {
        return view('welcome', ['install' => false]);
    }
    Artisan::call('key:generate');
    $result = Artisan::call('migrate:fresh --seed');
    if ($result === 0) {
        return view('welcome', ['install' => false]);
    } else {
        return '<h3>Um erro inespedado ocorreu.</h3>';
    }
});
Route::get('/instalar/limpar-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:cache');
    if (Schema::hasTable('users')) {
        return view('welcome', ['install' => false]);
    }
    Artisan::call('key:generate');
    $result = Artisan::call('migrate:fresh --seed');
    if ($result === 0) {
        return view('welcome', ['install' => false]);
    } else {
        return '<h3>Um erro inespedado ocorreu.</h3>';
    }
});

Route::get('/{any}', function () { //captura todas as rotas
    if (Schema::hasTable('users') && request()->getPathInfo() !== '/instalar/ok') { //se existir banco de dados e a rota não é a rota de pós instalação, abortar e exibir 403 com orientações
        return view('welcome', ['install' => false]);
    }
    return view('welcome', ['install' => true]); //senão carregar página de instalação
})->where('any', '.*');
