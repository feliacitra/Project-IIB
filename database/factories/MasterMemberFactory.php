<?php

namespace Database\Factories;

use App\Models\MasterMember;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = MasterMember::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'mm_name' => $faker->name,
            'mm_nik' => $faker->numberBetween(1000000000000000, 9999999999999999),
            'mm_position' => $faker->jobTitle,
            'mm_phone' => $faker->numberBetween(100000000000000, 999999999999999),
            'mm_email' => $faker->email,
            'mm_nim_nip' => $faker->numberBetween(1000000000000000000000000, 9999999999999999999999999),
            'mm_socialmedia' => $faker->userName,
            'mci_id' => mt_rand(1, 4),
            'mm_npwp' => null,
            'mm_cv' => null,
        ];
    }
}
