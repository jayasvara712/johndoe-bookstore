<?php

namespace Database\Seeders;

use App\Models\Authors;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $dataCount = 100;
        $data = [];

        for ($i = 0; $i < $dataCount; $i++) {
            $data[] = [
                'name' => $faker->name,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $chunks = array_chunk($data, $dataCount);

        foreach ($chunks as $chunk) {
            Authors::insert($chunk);
        }
    }
}
