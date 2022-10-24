<?php

use Illuminate\Support\Facades\Crypt;

/**
 * setGetKey($request->user_id)
 */
if (!function_exists('setGetKey')) {
    function setGetKey($key, $sufix = null)
    {
        return Crypt::encryptString(($sufix ? $sufix . '::' : '') . ($key . '::' . auth()->id()));;
    }
}

/**
 * User::find(getKeyValue($request->id))
 */
if (!function_exists('getKeyValue')) {
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

// /**
//  * checkKey($request->id, $request->_key)
//  */
// if (!function_exists('checkKey')) {
//     function checkKey($requestKey, $key)
//     {
//         return getKeyValue($requestKey) === $key;
//     }
// }