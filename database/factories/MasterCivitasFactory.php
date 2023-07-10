<?php

namespace Database\Factories;

use App\Models\MasterCivitas;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterCivitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = MasterCivitas::class;

    public function definition()
    {
        return [
            'mci_name' => $this->faker->unique()->randomElement(['Alumni Tel-U', 'Bukan Alumni', 'Mahasiswa', 'Dosen', 'Staff']),
            'mci_description' => $this->faker->sentence,
        ];
    }
}
