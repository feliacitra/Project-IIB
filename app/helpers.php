<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Feature;

if (!function_exists('get_access')) {
    function get_access() {
        $roleId = Auth::user()->role;
        $role = Role::find($roleId);
        $features = $role->features;
        return $features;
    }
}