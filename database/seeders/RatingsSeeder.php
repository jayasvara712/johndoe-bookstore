<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\Ratings;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $books = collect(Books::all()->modelKeys());
        $dataCount = 50000;
        $initChunk = 1000;
        $data = [];

        for ($i = 0; $i < $dataCount; $i++) {
            $data[] = [
                'book_id' => $books->random(),
                'rating' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $chunks = array_chunk($data, $initChunk);
        foreach ($chunks as $chunks) {
            Ratings::insert($chunks);
        }
    }
}
