<?php

namespace Database\Seeders;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $authors = collect(Authors::all()->modelKeys());
        $categories = collect(Categories::all()->modelKeys());
        $dataCount = 10000;
        $initChunk = 1000;
        $data = [];

        for ($i = 0; $i < $dataCount; $i++) {
            $data[] = [
                'category_id'   => $categories->random(),
                'author_id'     => $authors->random(),
                'name'          => $faker->name,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($data, $initChunk);

        foreach ($chunks as $chunk) {
            Books::insert($chunk);
        }
    }
}
