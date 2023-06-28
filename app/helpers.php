<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Feature;

if (!function_exists('get_access')) {
    function get_access() {
        $role = Auth::user()->roles;
        // $features = $role->feature;
        return $role->features;
    }
}

if (!function_exists('isSubStringInArray')) {
    function isSubstringInArray($substring, $array) {
        foreach ($array as $element) {
            if (strpos($element, $substring) !== false) {
                return true;
            }
        }
        return false;
    }
}