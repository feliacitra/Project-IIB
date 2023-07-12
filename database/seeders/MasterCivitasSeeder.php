<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterCivitas;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterCivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use HasFactory;

    public function run()
    {
        $civitas1 = MasterCivitas::factory()->create([
            'mci_name' => 'Alumni Tel-U',
            'mci_description' => 'Alumni Tel-U lorem ipsum',
        ]);

        $civitas2 = MasterCivitas::factory()->create([
            'mci_name' => 'Bukan Alumni',
            'mci_description' => 'Bukan Alumni lorem ipsum',
        ]);

        $civitas3 = MasterCivitas::factory()->create([
            'mci_name' => 'Mahasiswa',
            'mci_description' => 'Mahasiswa lorem ipsum',
        ]);

        $civitas4 = MasterCivitas::factory()->create([
            'mci_name' => 'Dosen',
            'mci_description' => 'Dosen lorem ipsum',
        ]);

        $civitas5 = MasterCivitas::factory()->create([
            'mci_name' => 'Staff',
            'mci_description' => 'Staff (untuk test delete, tidak ada member yg terhubung)',
        ]);
    }
}
