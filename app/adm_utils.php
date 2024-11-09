<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;

/**
 * setGetKey($request->user_id)
 */
if (!function_exists('setGetKey')) {
    /**
     * @param string $key
     * @param string|null $sufix
     * 
     * @return string
     */
    function setGetKey($key, $sufix = null)
    {
        return Crypt::encryptString(($sufix ? $sufix . '::' : '') . ($key . '::' . auth()->id()));;
    }
}

/**
 * User::find(getKeyValue($request->id))
 */
if (!function_exists('getKeyValue')) {
    /**
     * @param string $key
     * @param string|null $sufix
     * 
     * @return mixed
     */
    function getKeyValue($key, $sufix = null)
    {
        $exp = explode('::', Crypt::decryptString($key));
        if (intval($exp[2]) === auth()->id()) {
            return $sufix && $sufix === $exp[0] ? $exp[1] : null;
        } else {
            return null;
        }
    }
}

if (!function_exists('stylesSettings')) {
    /**
     * @return Setting
     */
    function stylesSettings()
    {
        return json_decode(cache()->remember('stylesSettings', 60 * 60 * 2, function () {
            return Setting::where('name', 'styles')->first();
        })->settings);
    }
}

if (!function_exists('getSettingMustVerifyEmail')) {
    /**
     * @return Setting
     */
    function getSettingMustVerifyEmail()
    {
        return json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
            return Setting::where('name', 'general')->first();
        })->settings)->mustVerifyEmail[1];
    }
}

if (!function_exists('verifyPermissionLevel')) {
    /**
     * @return Setting
     */
    function verifyPermissionLevel(array $role, array $admin_role)
    {
        if (count(array_intersect($role, $admin_role)) > 0) {
            //return 'if';
            return auth()->user()->hasRole(config('crebs86.admin_roles_edit'));
        } else {
            //return 'else';
            return true;
        }
    }
}

if (!function_exists('verifyUserLevel')) {
    /**
     * @return Setting
     */
    function verifyUserLevel(bool $role, array $admin_role)
    {
        if ($role) {
            return auth()->user()->hasRole($admin_role);
        } else {
            return true;
        }
    }
}
