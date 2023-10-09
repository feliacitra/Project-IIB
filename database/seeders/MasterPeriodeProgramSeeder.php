<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterPeriodeProgramSeeder extends Seeder
{
    public function run()
    {
        // Insert sample data into the master_periodeprogram table
        DB::table('master_periodeprogram')->insert([
            [
                'mpi_id' => 1, // Replace with an existing mpi_id value
                'mpe_id' => 1, // Replace with an existing mpe_id value
            ]
        ]);
    }
}
