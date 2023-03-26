<?php

namespace Database\Seeders;

use App\Models\Categories;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $dataCount = 300;
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
            Categories::insert($chunk);
        }
    }
}
