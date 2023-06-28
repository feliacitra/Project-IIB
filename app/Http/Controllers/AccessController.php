<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Feature;

class AccessController extends Controller
{
    public function submit(Request $request) {
        $request->validate([
                'role' => ['required']
            ],[
                'role.required' => 'Pilih salah satu role'
            ]
        );

        $role = $request->input('role');
        $pengguna = $request->input('pengguna');
        $programInkubasi = $request->input('program-inkubasi');
        $kategoriStartup = $request->input('kategori-startup');

        $roleDb = Role::find($role);
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
        return redirect('/access')->with('success', 'Berhasil mengubah hak akses');
    }

    public function index() {
        return view('admin.access');
    }

    public function reset() {
        foreach (Role::all() as $role) {
            $role->features()->detach();
        }

        return redirect('/access')->with('success', 'Berhasil mereset hak akses');
    }

    public function role_reset($role) {
        Role::find($role)->features()->detach();

        return redirect('/access')->with('success', 'Berhasil mereset hak akses role');
    }
}
