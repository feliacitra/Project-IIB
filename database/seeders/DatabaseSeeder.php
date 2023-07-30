<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Feature;
use App\Models\MasterFakultas;
use App\Models\MasterProgramInkubasi;
use App\Models\MasterPeriode;
use App\Models\MasterMember;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
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
            [
                'name' => 'civitas-tambah',
            ],
            [
                'name' => 'civitas-ubah',
            ],
            [
                'name' => 'civitas-hapus',
            ],
            [
                'name' => 'civitas-lihat',
            ],
            [
                'name' => 'universitas-tambah',
            ],
            [
                'name' => 'universitas-ubah',
            ],
            [
                'name' => 'universitas-hapus',
            ],
            [
                'name' => 'universitas-lihat',
            ],
            [
                'name' => 'fakultas-tambah',
            ],
            [
                'name' => 'fakultas-ubah',
            ],
            [
                'name' => 'fakultas-hapus',
            ],
            [
                'name' => 'fakultas-lihat',
            ],
            [
                'name' => 'program-studi-tambah',
            ],
            [
                'name' => 'program-studi-ubah',
            ],
            [
                'name' => 'program-studi-hapus',
            ],
            [
                'name' => 'program-studi-lihat',
            ],
            [
                'name' => 'periode-pendaftaran-tambah',
            ],
            [
                'name' => 'periode-pendaftaran-ubah',
            ],
            [
                'name' => 'periode-pendaftaran-hapus',
            ],
            [
                'name' => 'periode-pendaftaran-lihat',
            ]
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

        $peserta = [
            'name' => 'peserta',
            'email' => 'peserta@gmail.com',
            'password' => Hash::make('peserta'),
            'role' => '2'
        ];


        User::firstOrCreate(['name' => 'admin'], $admin);
        User::firstOrCreate(['name' => 'peserta'], $peserta);

        $role = Role::find(1);
        $features = Feature::all();

        foreach ($features as $feature) {
            $role->features()->attach($feature->id);
        }

        $periode = [
            'mpe_startdate' => '2023-07-01',
            'mpe_enddate' => '2023-07-31',
            'mpe_name' => '2023/2024 Ganjil',
            'mpe_status' => 1,
            'mpe_description' => 'Deskripsi'
        ];
        MasterPeriode::firstOrCreate(['mpe_name' => '2023/2024 Ganjil'], $periode);

        $programInkubasi = [
            'mpi_name' => 'Upward',
            'mpi_description' => 'Deskripsi',
            'mpi_type' => 'AKTIF'
        ];
        $contoh = [
            'mpi_name' => 'Contoh',
            'mpi_description' => 'Desc',
            'mpi_type' => 'AKTIF'
        ];
        MasterProgramInkubasi::firstOrCreate(['mpi_name' => 'Upward'], $programInkubasi);
        MasterProgramInkubasi::firstOrCreate(['mpi_name' => 'Contoh'], $contoh);

    }
}