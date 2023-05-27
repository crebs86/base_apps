<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => Schema::hasTable('users') ? $request->user() : null,
                'roles' => function () use ($request) {
                    if ($request->user()) {
                        return $request->user()->roles->sortBy('name')->pluck('name');
                    }
                },
                'permissions' => function () use ($request) {
                    if ($request->user()) {
                        return $request->user()->getPermissionsViaRoles()->sortBy('name')->pluck('name')->unique()->values()->all();
                    }
                },
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                    'info' => $request->session()->get('info'),
                ];
            },
            'app' => function () {
                return [
                    'version' => config('crebs86.version'),
                    'year' => config('crebs86.year_date'),
                    'released' => config('crebs86.release_date'),
                    'app_version' => 'x.x.x',
                    'settingsStyles' => stylesSettings()
                ];
            },
        ]);
    }
}