<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ACL;
use Inertia\Inertia;
use App\Models\Setting;
use App\Traits\Helpers;
use App\Models\SettingUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;

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
    public function update(SettingRequest $request, Setting $setting)
    {
        if ($this->isSuperAdmin()) {
            $s = collect($setting)->all();
            $a = json_decode($setting->settings);
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
                'requireCpf' => [
                    $a->requireCpf[0],
                    $request->requireCpf
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
                    'roles' => [
                        $a->saveUpdates->roles[0],
                        $request->saveUpdates_roles
                    ],
                    'userRolesPermissions' => [
                        $a->saveUpdates->userRolesPermissions[0],
                        $request->saveUpdates_userRolesPermissions
                    ],
                    'users' => [
                        $a->saveUpdates->users[0],
                        $request->saveUpdates_users
                    ],
                ]
            ];

            if (!$this->validateRequestSetting($u)) {
                return redirect()->back()->with('error', 'Erro crítico ao salvar configurações!');
            }

            if (
                $setting->update(
                    [
                        'updated_at' => now(),
                        'settings' => json_encode($u)
                    ]
                )
            ) {
                cache()->forget('settings');
                $this->saveUpdates($s, $setting, SettingUpdate::class, ['name', 'settings', 'updated_at']);
                return redirect()->back()->with('success', 'Configurações alteradas com sucesso!');
            }
        }
        return Inertia::render('Admin/403');
    }

    private function validateRequestSetting(array $data)
    {
        return count(array_diff_key(['canRegister' => 0, 'mustVerifyEmail' => 0, 'logoutAfterChangeEmail' => 0, 'requireCpf' => 0, 'saveUpdates' => 0], $data)) === 0 &&
            count(array_diff_key(['title' => 0, 'branches' => 0, 'clients' => 0, 'permissions' => 0, 'roles' => 0, 'userRolesPermissions' => 0, 'users' => 0], $data['saveUpdates'])) === 0;
    }
}
