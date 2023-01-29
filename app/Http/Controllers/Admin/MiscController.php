<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Setting;
use App\Traits\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class MiscController extends Controller
{
    use Helpers;
    public function home()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => function () {
                return json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
                    return Setting::where('name', 'general')->first();
                })->settings)->canRegister[1];
            }
        ]);
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function redirect()
    {
        return Inertia::render('Admin/419', [
            'url' => url()->previous()
        ]);
    }
}
