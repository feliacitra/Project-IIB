<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterStartup;

class MasterStartupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'ms_startdate' => '2023-10-08',
            'ms_enddate' => '2023-12-31',
            'ms_pks' => 'PKS12345',
            'ms_link_pks' => 'https://example.com/pks',
            'ms_phone' => '123-456-7890',
            'ms_name' => 'Example Startup',
            'ms_address' => '123 Main Street, City',
            'mc_id' => 1, // Replace with the appropriate mc_id value
            'ms_website' => 'https://example.com',
            'ms_logo' => 'logo.jpg', // Replace with the actual file name
            'ms_socialmedia' => 'https://twitter.com/example',
            'ms_legal' => 'Legal Info',
            'ms_link_legal' => 'https://example.com/legal',
            'ms_riset' => 1,
            'ms_proposal' => 'Proposal Info',
            'ms_pitchdeck' => 'Pitch Deck Info',
            'ms_yearly_income' => 100000, // Replace with the actual income
            'ms_year_founded' => 2015, // Replace with the actual year founded
            'ms_funding_sources' => 'Funding Sources Info',
            'ms_focus_area' => 'Focus Area Info',
            'mm_id' => 1, // Replace with the appropriate mm_id value
            'ms_npwp' => '123-45-67890',
            'user_id' => 1, // Replace with the appropriate user_id value
            'mpd_id' => 1, // Replace with the appropriate mpd_id value
            'ms_status' => 1, // Replace with the appropriate status
        ];

        // Use firstOrCreate to create a single record or find an existing one
        MasterStartup::firstOrCreate(['ms_name' => 'Example Startup'], $data);
    }
}
