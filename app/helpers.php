<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Feature;

if (!function_exists('get_menu')) {
    function get_menu() {
        $features = session('features');
        $menu = array();
        if (isSubStringInArray('pengguna', $features)) {
            $menu[] = "<a href=\"" . route('master.pengguna') . "\" class=\"nav-link\">
                            <i class=\"link-icon\" data-feather=\"box\"></i>
                            <span class=\"link-title\">Master Pengguna</span>
                        </a>";
        }
        if (isSubStringInArray('program-inkubasi', $features)) {
            $menu[] = "<a href=\"" . route('master.inkubasi') . "\" class=\"nav-link\">
                            <i class=\"link-icon\" data-feather=\"box\"></i>
                            <span class=\"link-title\">Master Program Inkubasi</span>
                        </a>";
        }
        if (isSubStringInArray('kategori-startup', $features)) {
            $menu[] = "<a href=\"" . route('master.kategori.startup') . "\" class=\"nav-link\">
                            <i class=\"link-icon\" data-feather=\"box\"></i>
                            <span class=\"link-title\">Master Kategori Startup</span>
                        </a>";
        }
        return $menu;
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

if (!function_exists('isFeatureInclude')) {
    function isFeatureInclude($string, $features) {
        foreach ($features as $feature) {
            if ($string == $feature->name) {
                return true;
            }
        }
        return false;
    }
}
