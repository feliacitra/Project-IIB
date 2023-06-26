<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Feature;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $features = [
            [
                'name' => 'pengguna-tambah',
            ],
            [
                'name' => 'pengguna-ubah',
            ],
            [
                'name' => 'pengguna-hapus',
            ],
            [
                'name' => 'pengguna-lihat',
            ],
            [
                'name' => 'program-inkubasi-tambah',
            ],
            [
                'name' => 'program-inkubasi-ubah',
            ],
            [
                'name' => 'program-inkubasi-hapus',
            ],
            [
                'name' => 'program-inkubasi-lihat',
            ],
            [
                'name' => 'kategori-startup-tambah',
            ],
            [
                'name' => 'kategori-startup-ubah',
            ],
            [
                'name' => 'kategori-startup-hapus',
            ],
            [
                'name' => 'kategori-startup-lihat',
            ],
        ];
        $roles = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'peserta'
            ],
            [
                'name' => 'penilai'
            ],
            [
                'name' => 'pemateri'
            ],
            [
                'name' => 'mentor'
            ],
            [
                'name' => 'dosen'
            ],
            [
                'name' => 'management'
            ],
        ];
        
        foreach ($features as $feature) {
            Feature::firstOrCreate(['name' => $feature], $feature);
        }

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role], $role);
        }

        $role = Role::where('name', 'admin')->first();

        $admin = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => $role->id,
        ];

        User::firstOrCreate(['name' => 'admin'], $admin);
    }
}
