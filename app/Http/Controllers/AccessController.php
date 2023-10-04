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
        $civitas = $request->input('civitas');
        $universitas = $request->input('universitas');
        $fakultas = $request->input('fakultas');
        $periodePendaftaran = $request->input('periode-pendaftaran');
        $komponenPenilaian = $request->input('komponen-penilaian');

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

        if ($civitas) {
            foreach ($civitas as $feature) {
                $featureDb = Feature::where('name', $feature)->first();
                $roleDb->features()->save($featureDb);
            }
        }
        
        if ($universitas) {
            foreach ($universitas as $feature) {
                $featureDb = Feature::where('name', $feature)->first();
                $roleDb->features()->save($featureDb);
            }
        }
        
        if ($fakultas) {
            foreach ($fakultas as $feature) {
                $featureDb = Feature::where('name', $feature)->first();
                $roleDb->features()->save($featureDb);
            }
        }
        
        if ($periodePendaftaran) {
            foreach ($periodePendaftaran as $feature) {
                $featureDb = Feature::where('name', $feature)->first();
                $roleDb->features()->save($featureDb);
            }
        }

        if ($komponenPenilaian) {
            foreach ($komponenPenilaian as $feature) {
                $featureDb = Feature::where('name', $feature)->first();
                $roleDb->features()->save($featureDb);
            }
        }
        
        $features = $roleDb->features;
        return redirect('/access')->with([
            'success' => 'Berhasil mengubah hak akses',
            'role' => $role,
            'feature' => $features
        ]);
    }

    public function index() {
        // $role_feature = Role::with('features')->get();
        return view('admin.access');
    }

    public function role_index(Request $request) {
        $role = Role::find($request->role);
        $features = $role->features;
        // dd($features);
        return redirect()->route('access.index')->with([
            'feature' => $features,
            'role' => $role->id
        ]);
    }

    public function reset() {
        foreach (Role::all() as $role) {
            $role->features()->detach();
        }

        return redirect('/access')->with('success', 'Berhasil mereset hak akses');
    }

    public function role_reset($role) {
        Role::find($role)->features()->detach();

        return redirect('/access')->with([
            'success' => 'Berhasil mereset hak akses role',
            'role' => $role
        ]);
    }
}
