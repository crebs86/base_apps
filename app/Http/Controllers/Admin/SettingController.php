<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ACL;
use Inertia\Inertia;
use App\Models\Setting;
use App\Traits\Helpers;
use App\Models\SettingUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Http\Requests\Admin\SettingStylesRequest;

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
            $st = Setting::where('name', 'styles')->first();
            return Inertia::render('Admin/Settings', [
                [
                    'settings' => json_decode($s?->settings),
                    'updated_at' => $s?->updated_at,
                    'id' => $s?->id
                ],
                [
                    'stylesSettings' => $this->buildItemsFormStylesSettings(json_decode($st?->settings)),
                    'updated_at' => $st?->updated_at,
                    'id' => $st?->id
                ]
            ]);
        }
        return Inertia::render(
            'Admin/403',
            [
                'flash.error' => 'Você não possui permissão para usar este recurso'
            ]
        );
    }

    /**
     * @param mixed $stylesSettings
     * 
     * @return array
     */
    private function buildItemsFormStylesSettings($stylesSettings)
    {
        $a = [];
        foreach ($stylesSettings as $key => $values) {
            if (gettype($values) === 'object') {
                foreach ($values as $k => $v) {
                    $a[$key][$k] = explode(" ", str_replace(['dark:hover:', 'hover:', 'dark:text-', 'dark:bg-', 'text-',  'bg-'], '', $v));
                }
            }
        }
        return json_decode(json_encode((object)$a), false);
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
            cache()->forget('settings');
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
                $this->saveUpdates($s, $setting, SettingUpdate::class, ['name', 'settings', 'updated_at']);
                return redirect()->back()->with('success', 'Configurações alteradas com sucesso!');
            }
        }

        return Inertia::render(
            'Admin/403',
            [
                'flash.error' => 'Você não possui permissão para usar este recurso'
            ]
        );
    }

    /**
     * @param array $data
     * 
     * @return bool
     */
    private function validateRequestSetting(array $data)
    {
        return count(array_diff_key(['canRegister' => 0, 'mustVerifyEmail' => 0, 'logoutAfterChangeEmail' => 0, 'requireCpf' => 0, 'saveUpdates' => 0], $data)) === 0 &&
            count(array_diff_key(['title' => 0, 'branches' => 0, 'clients' => 0, 'permissions' => 0, 'roles' => 0, 'userRolesPermissions' => 0, 'users' => 0], $data['saveUpdates'])) === 0;
    }

    public function updateStyles(SettingStylesRequest $settingStyles)
    {
        if ($this->isSuperAdmin()) {
            cache()->forget('stylesSettings');
            $a = Setting::where('name', 'styles')->first();
            $s = json_decode($a?->settings);
            $st = json_decode($a?->settings, true);
            if ($settingStyles->section === 'body') {
                $st['main']['body'] = 'text-' . $settingStyles->text_light . ' dark:text-' . $settingStyles->text_dark . ' bg-' . $settingStyles->bg_light . ' dark:bg-' . $settingStyles->bg_dark;
            }
            if ($settingStyles->section === 'container') {
                $st['main']['container'] = 'text-' . $settingStyles->text_light . ' dark:text-' . $settingStyles->text_dark . ' bg-' . $settingStyles->bg_light . ' dark:bg-' . $settingStyles->bg_dark;
            }
            if ($settingStyles->section === 'subSection') {
                $st['main']['subSection'] = 'text-' . $settingStyles->text_light . ' dark:text-' . $settingStyles->text_dark . ' bg-' . $settingStyles->bg_light . ' dark:bg-' . $settingStyles->bg_dark;
            }
            if ($settingStyles->section === 'formsStyles') {
                $st['main']['formsStyles'] = 'text-' . $settingStyles->text_light . ' dark:text-' . $settingStyles->text_dark . ' bg-' . $settingStyles->bg_light . ' dark:bg-' . $settingStyles->bg_dark;
            }
            if ($settingStyles->section === 'innerSection') {
                $st['main']['innerSection'] = 'text-' . $settingStyles->text_light . ' dark:text-' . $settingStyles->text_dark . ' bg-' . $settingStyles->bg_light . ' dark:bg-' . $settingStyles->bg_dark;
            }
            if ($settingStyles->section === 'innerSectionIcons') {
                $st['main']['innerSectionIcons'] = 'text-' . $settingStyles->link_light . ' dark:text-' . $settingStyles->link_dark . ' hover:text-' . $settingStyles->linkHover_light . ' dark:hover:text-' . $settingStyles->linkHover_dark;
            }
            if ($settingStyles->section === 'footer') {
                $st['main']['footer'] = 'text-' . $settingStyles->text_light . ' dark:text-' . $settingStyles->text_dark . ' bg-' . $settingStyles->bg_light . ' dark:bg-' . $settingStyles->bg_dark;
                $st['main']['footerLinks'] = 'text-' . $settingStyles->link_light . ' dark:text-' . $settingStyles->link_dark . ' hover:text-' . $settingStyles->linkHover_light . ' dark:hover:text-' . $settingStyles->linkHover_dark;
            }
            if ($settingStyles->section === 'mainMenu') {
                $st['mainMenu']['body'] = 'bg-' . $settingStyles->bg_light . ' dark:bg-' . $settingStyles->bg_dark;
                $st['mainMenu']['icons'] = 'text-' . $settingStyles->text_light . ' dark:text-' . $settingStyles->text_dark . ' hover:text-' . $settingStyles->hover_light . ' dark:hover:text-' . $settingStyles->hover_dark;
                $st['mainMenu']['iconsActive'] = 'text-' . $settingStyles->textActive_light . ' dark:text-' . $settingStyles->textActive_dark . ' hover:text-' . $settingStyles->textActive_hover_light . ' dark:hover:text-' . $settingStyles->textActive_hover_dark;
            }
            $t = json_encode($st);
            //dd($settingStyles->all(), $s, $st, $t);
            $a->update(['settings' => $t]);
            if ($a) {
                return redirect()->back()->with('success', 'Estilos da classe ' . $settingStyles->section . ' atualizada com sucesso.');
            } else {
                return redirect()->back()->with('error', 'Erro ao atualizar configurações de classes.');
            }
        }
        return Inertia::render(
            'Admin/403',
            [
                'flash.error' => 'Você não possui permissão para usar este recurso.'
            ]
        );
    }
}
