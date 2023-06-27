<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Feature;

class AccessController extends Controller
{
    public function submit(Request $request) {
        $role = $request->input('role');
        $pengguna = $request->input('pengguna');
        $programInkubasi = $request->input('program-inkubasi');
        $kategoriStartup = $request->input('kategori-startup');

        $roleDb = Role::where('name', $role)->first();
        if ($pengguna) {
            foreach ($pengguna as $feature) {
                $featureDb = Feature::where('name', $feature)->first();
                $roleDb->features()->save($featureDb);
            }
        }

        if ($programInkubasi) {
            foreach ($programInkubasi as $feature) {
                $featureDb = Feature::where('name', $feature)->first();
                $roleDb->features()->save($featureDb);
            }
        }

        if ($kategoriStartup) {
            foreach ($kategoriStartup as $feature) {
                $featureDb = Feature::where('name', $feature)->first();
                $roleDb->features()->save($featureDb);
            }
        }

        return redirect('/access');
    }

    public function index() {
        return view('admin.access');
    }

    public function reset() {
        foreach (Role::all() as $role) {
            $role->features()->detach();
        }

        return redirect('/access');
    }
}
