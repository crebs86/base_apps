<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ACL;
use App\Traits\Helpers;
use Inertia\Inertia;

class SettingController extends Controller
{
    use ACL, Helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->isSuperAdmin()) {
            $s = Setting::where('name', 'general')->first();
            return Inertia::render('Admin/Settings', [
                'settings' => json_decode($s?->settings),
                'updated_at' => $s?->updated_at,
                'id' => $s?->id
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        if ($this->isSuperAdmin()) {
            $s = $setting->first();
            $a = json_decode($s->settings);
            $u = [
                'canRegister' => [
                    $a->canRegister[0],
                    $request->canRegister
                ],
                'mustVerifyEmail' => [
                    $a->mustVerifyEmail[0],
                    $request->mustVerifyEmail
                ],
                'logoutAfterChangeEmail' => [
                    $a->logoutAfterChangeEmail[0],
                    $request->logoutAfterChangeEmail
                ],
                'saveUpdates' => [
                    'title' => $a->saveUpdates->title,
                    'branches' => [
                        $a->saveUpdates->branches[0],
                        $request->saveUpdates_branches
                    ],
                    'clients' => [
                        $a->saveUpdates->clients[0],
                        $request->saveUpdates_clients
                    ],
                    'permissions' => [
                        $a->saveUpdates->permissions[0],
                        $request->saveUpdates_permissions
                    ],
                    'settings' => [
                        $a->saveUpdates->settings[0],
                        $request->saveUpdates_settings
                    ],
                    'users' => [
                        $a->saveUpdates->users[0],
                        $request->saveUpdates_users
                    ],
                ]
            ];

            if (
                $setting->update(
                    [
                        'updated_at' => now(),
                        'settings' => json_encode($u)
                    ]
                )
                && cache()->forget('settings')
            ) {
                //$this->saveUpdates($c, $setting, SettingUpdate::class, ['name', 'email', 'cpf', 'address', 'deleted_at', 'branch_id', 'updated_at', 'cep', 'phones', ' notes']);
                cache()->forget('settings');
                return redirect()->back()->with('success', 'Configurações alteradas com sucesso!');
            }
        }
        return Inertia::render('Admin/403');
    }
}
